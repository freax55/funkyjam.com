package MT::Plugin::ResizeImage;

use strict;
use MT::Template::Context;
use MT::Log;
use MT::Blog;
use MT::Image;
use MT::Util qw( encode_url );
use Image::Size;
use File::Basename;
use base qw(MT::Plugin);

my $plugin = new MT::Plugin::ResizeImage({
    name        => 'ResizeImage',
    version     => '0.043',
    description => 'Resize image on Publishing.',
    author_name => 'morisitaya',
    author_link => 'http://www.morisitaya.com/',
    doc_link    => 'http://www.morisitaya.com/mtplugins/resizeimage/',

    registry => {
        tags => {
            block => {
                ResizeImage => \&resize_image_main,
            },
        },
    },
    system_config_template => 'system_config.tmpl',
    settings => new MT::PluginSettings([
	[ 'outlog', { Default => 'false', Scope => 'system' }],
				       ]),
});

MT->add_plugin($plugin);

sub instance
{
	$plugin;
}

sub outlog
{
    if($plugin->get_config_value('outlog') eq "true"){
	my ($message) = @_;
	my $log = MT::Log->new;
	$log->message($message);
	$log->save
	    or die $log->errstr;		
    }
}

sub outerror
{
    my ($message) = @_;
    my $log = MT::Log->new;
    $log->message($message);
    $log->save
	or die $log->errstr;		
}

sub resize_image_main
{
    my ($ctx, $args, $cond) = @_;

    my $builder = $ctx->stash('builder');
    my $tokens  = $ctx->stash('tokens');

    my $out = $builder->build ($ctx, $tokens, $cond);
    return $ctx->error ($builder->errstr) if !defined $out;
    
    my $blog_id = $ctx->{__stash}{blog_id};
    my $blog = MT::Blog->load($blog_id);
    my $site_path = $blog->site_path;
    my $site_url = $blog->site_url;

    if (!defined($args->{maxheight}) || !defined($args->{maxwidth})) {
	outerror("Not setting MTResizeImage attributes maxwidth or maxheight : maxwidth=" . $args->{maxwidth} . " maxheight=" . $args->{maxheight});	
	return $out;
    }    

    outlog($out);
    return _resize_image_main($out,$site_path,$site_url,$args);
}

sub _resize_image_main
{
    my ($in,$site_path,$site_url,$settings) = @_;
    my @img_tags = get_image_tags($in);
    foreach my $img_tag(@img_tags){
	outlog("start:" . $img_tag);
	my $attrs = get_attributes($img_tag);
	my ($convert_flg,$width,$height,$new_image_url) 
	    = convert_image_file($attrs,$site_path,$site_url,$settings);
	if (!defined($convert_flg)){
	    outlog("next:" . $img_tag);
	    next;
	}
	convert_attribute_value(\$attrs,$settings,$width,$height,$new_image_url);
	
	my $new_img_tag = replace_image_tag($img_tag,$attrs);
	outlog("replace_image_tag|" . $new_img_tag . "|");
	$new_img_tag = add_anchor_link($new_img_tag,$attrs,$settings);
	outlog("add_anchor_link|" . $new_img_tag . "|");
	$in = reflection_image_tag($in,$img_tag,$new_img_tag);
	outlog("out:" . $in);       
    }    
    return $in;
}

sub get_image_tags
{
    my ($in) = @_;
    my @imgs = ();
    while($in =~ /(<img\s[^>]*?>)/gi){
	push(@imgs, $1);    
    }
    return @imgs;
}

sub get_attributes
{
    my ($img_tag) = @_;
    my @target_attr_names = ("src","height","width","style");
    my $attrs;
    while($img_tag =~ m/((\w*)\s*=\s*([\'\"]?)([^\'\"]*)([\'\"]?))/gms){	
	foreach my $target_attr_name (@target_attr_names){
	    if ($target_attr_name eq lc($2)){
		$attrs->{$target_attr_name}{string} = $1;
		$attrs->{$target_attr_name}{name} = $2;
		$attrs->{$target_attr_name}{quart} = $3;
		$attrs->{$target_attr_name}{value} = $4;
		$attrs->{$target_attr_name}{value} =~ s/>$//;
		$attrs->{$target_attr_name}{value} =~ s/\/$//;
		$attrs->{$target_attr_name}{value_org}
		= $attrs->{$target_attr_name}{value}; 
		outlog($attrs->{$target_attr_name}{string} . "|" . 
		       $attrs->{$target_attr_name}{name} . "|" . 
		       $attrs->{$target_attr_name}{quart} . "|" . 		
		       $attrs->{$target_attr_name}{value});
	    }
	}	
    }
    return $attrs;     
}

sub convert_image_file
{
    my ($attrs,$site_path,$site_url,$settings) = @_;
    my $image_url = $attrs->{src}{value};
    my $image_path = $image_url;
    $image_path =~ s/$site_url//;
    $image_path = $site_path . "/" . $image_path;
    
    my $maxheight = $settings->{maxheight};
    my $maxwidth = $settings->{maxwidth};	
    if(!( -f $image_path ) && !( -f url_decode($image_path) )) {
	outerror("File Not Found: " . $image_path);
	return undef;
    }

    if(!( -f $image_path ) && ( -f url_decode($image_path) )) {
	$image_path = url_decode($image_path);
    }
    
    my $scale = 1;
    my ($width, $height) = imgsize($image_path);
    my $image = new MT::Image( Filename => $image_path );
    if (!defined($image)){
	my $errorMessage = MT::Image->errstr;
	outerror($errorMessage);
	return undef;
    }
    
    if (($maxwidth > 0 && $width < $maxwidth) &&
	($maxheight > 0 &&  $height < $maxheight)){
	return undef;
    }
    
    if ($maxwidth / $width < $maxheight / $height){
	$scale = $maxwidth / $width;
    } else {
	$scale = $maxheight / $height
    }
    
    my($blob, $w, $h) = $image->scale( Scale => $scale*100 );
    
    $width  = $w;
    $height = $h;
    
    my $_file_name = getFileName($image_path);
    my $_suffix = getSuffix($image_path);
    $_file_name =~ s/\.$_suffix$//;
    my $new_image_path = getDirName($image_path)
	. $_file_name . "_" . $w . "x" . $h . "."
	. $_suffix;
    my $new_image_path_for_url = getDirName($image_path)
	. MT::Util::encode_url($_file_name) . "_" . $w . "x" . $h . "."
	. $_suffix;
    
    open FH, ">$new_image_path";
    binmode FH;
    print FH $blob;
    close FH;
    
    my $new_image_url = $new_image_path_for_url;
    $new_image_url =~ s/$site_path\///;
    $new_image_url = $site_url . $new_image_url;
    return (1,$width,$height,$new_image_url);	    
}

sub convert_attribute_value
{
    my ($attrs,$settings,$width,$height,$new_image_url) = @_;
    my @target_attr_names = ("src","height","width","style");
    $$attrs->{src}{value} = $new_image_url;
    $$attrs->{height}{value} = $height;
    $$attrs->{width}{value} = $width;
    my @styles = style_parse($$attrs->{style}{value});
    foreach my $style (@styles){
	if (lc($style->{name}) eq "height"){
	    if ($style->{value} =~ /px$/i){
		$style->{value} = $height . "px";
		$$attrs->{style}{value} =~ s/$style->{string}/$style->{name}: $style->{value}/;
	    }
	}
	elsif (lc($style->{name}) eq "width"){
	    if ($style->{value} =~ /px$/i){
		$style->{value} = $width . "px";
		$$attrs->{style}{value} =~ s/$style->{string}/$style->{name}: $style->{value}/;
	    }
	}
    }    
}

sub style_parse
{
    my ($style_value) = @_;
    my @styles = ();
    while($style_value =~ m/(\s*(\w*)\s*:\s*([^;]*))/gms){
	my $style;
	$style->{string} = $1;
	$style->{name} = $2;
	$style->{value} = $3;
	push(@styles,$style);
	outlog($1 . ":" . $2 . "=" . $3);
    }
    return @styles;
}

sub replace_image_tag
{
    my ($img_tag,$attrs) = @_;
    my @target_attr_names = ("src","height","width","style");
    foreach my $target_attr_name (@target_attr_names){    	
	outlog("replace_image_tag___|" . $target_attr_name 
	       . "|" . $attrs->{$target_attr_name}{string}
	       . "|" . $attrs->{$target_attr_name}{name}
	       . "|" . $attrs->{$target_attr_name}{quart}
	       . "|" . $attrs->{$target_attr_name}{value});
	if ($attrs->{$target_attr_name}{string} ne ""){
	    $img_tag =~ s/$attrs->{$target_attr_name}{string}/$attrs->{$target_attr_name}{name}=$attrs->{$target_attr_name}{quart}$attrs->{$target_attr_name}{value}$attrs->{$target_attr_name}{quart}/;
	}
	outlog("replace_image_tag___|" . $img_tag . "|");
    }
    return $img_tag;
}

sub add_anchor_link{
    my ($img_tag,$attrs,$settings) = @_;
    my $notlink = $settings->{notlink};
    my $link_target = $settings->{link_target};
    if (!defined($notlink) || length($notlink)==0){
	my $target="";
	if (defined($link_target) && length($link_target)>0){
	    $target =" target=\"" . $link_target . "\" ";
	}	
	$img_tag = "<a href=\"" . $attrs->{src}{value_org} . "\"" . $target .">" . $img_tag . "</a>";
    }
    return $img_tag;
}

sub reflection_image_tag
{
    my ($in,$img_tag,$new_img_tag) = @_;
    $in =~ s/$img_tag/$new_img_tag/;
    return $in;
}

sub getFileName{
    my $fullpath = shift;
    my ($name, $path, $suffix) = fileparse($fullpath, ());
    
    return ( $name );
}

sub getDirName{
    my $fullpath = shift;
    my ($name, $path, $suffix) = fileparse($fullpath, ());
    
    return ( $path );
}

sub getSuffix{
    my $fullpath       = shift;
    my @suffixlist = @_;
    my ($name, $path, $suffix) = fileparse($fullpath, @suffixlist);
    
    if( scalar(@suffixlist) ){
	return($suffix);
    }
    else{
	my $suffix2 = '';
	
	if( index($name, '.',  0) != -1){
	    $suffix2 = (split(/\./, $name))[-1];
	}
	
	return($suffix2);
    }
}

sub url_decode
{
    my ($str) = @_;
    $str =~ tr/+/ /;
    $str =~ s/%([0-9A-Fa-f][0-9A-Fa-f])/pack('H2', $1)/eg;
    return $str;
}   

1;
