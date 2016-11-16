use strict;
package MT::Plugin::PageBute;

use vars qw( $MYNAME $VERSION );
$MYNAME = 'PageBute';
$VERSION = '3.4.4';

use MT::Plugin;
use POSIX qw( ceil );
use File::Basename;
use File::Spec;

my $plugin = MT::Plugin->new({
	name => $MYNAME,
    author_name => 'SKYARC System Co.,Ltd.',
    author_link => 'http://www.skyarc.co.jp/',
    doc_link => 'http://www.skyarc.co.jp/engineerblog/entry/2642.html',
	description => <<HTMLHEREDOC,
This plugin for Pagenate. Please read documentation if you use this plugin first. <br />It is possible to use it only once a page.
HTMLHEREDOC
	version => $VERSION,
    registry => {
         callbacks => {
            build_page => \&_page_bute,
            build_file => \&_repage_bute,
         },
         tags => {
            block => {
                  PageContents => \&_page_contents,
                  IfPageNext   => \&_if_page_,
                  IfPageBefore => \&_if_page_,
                  IfPageFirst  => \&_if_page_,
                  IfPageLast   => \&_if_page_,
            },
            function => {
                  PageNext      => \&_page_,
                  PageBefore    => \&_page_,
                  PageFirst     => \&_page_,
                  PageLast      => \&_page_,
                  PageCount     => \&_page_,
                  PageMaxCount  => \&_page_,
                  PageSeparator => \&_separator,
                  PageLists     => \&_page_lists,
            },
         },
     },
});
MT->add_plugin( $plugin );

my %garbage = (
		PAGENEXT         => '<!-- NextLink for PageBute -->',
		PAGEBEFORE       => '<!-- BeforeLink for PageBute -->',
		PAGEFIRST        => '<!-- FirstLink for PageBute -->',
		PAGELAST         => '<!-- LastLink for PageBute -->',
		Separator        => '<!-- Separator for PageBute -->',
		PageLists        => '<!-- PageLists for PageBute -->',
		Contents         => '<!-- Contents for PageBute -->',
		PAGECOUNT        => '<!--  PageCount for PageBute-->',
		PAGEMAXCOUNT     => '<!--  PageMaxCount for PageBute-->',
		IFPAGENEXT       => '<!-- PageIfNext for PageBute -->',
		IFPAGENEXT_END   => '<!-- PageIfNext_end for PageBute -->',
		IFPAGEBEFORE     => '<!-- PageIfBefore for PageBute -->',
		IFPAGEBEFORE_END => '<!-- PageIfBefore_end for PageBute -->',
		IFPAGEFIRST      => '<!-- PageIfFirst for PageBute -->',
		IFPAGEFIRST_END  => '<!-- PageIfFirst_end for PageBute -->',
		IFPAGELAST       => '<!-- PageIfLast for PageBute -->',
		IFPAGELAST_END   => '<!-- PageIfLast_end for PageBute -->',
);

my %delimitor = (
        PAGENEXT   => '&gt;',
        PAGEBEFORE => '&lt;',
        PAGEFIRST  => '&lt;&lt;',
        PAGELAST   => '&gt;&gt;',
);

sub _if_page_ {
	my ($ctx, $args, $cond) = @_;

	my $tokens = $ctx->stash('tokens');
	my $builder = $ctx->stash('builder');
	my $result = $builder->build( $ctx, $tokens, $cond )
        or return $ctx->error( $builder->errstr );

    my $tag = uc $ctx->stash('tag');
    $garbage{$tag}. $result. $garbage{$tag. '_END'};
}

sub _page_ {
	my ($ctx,$args,$cond) = @_;

    my $tag = uc $ctx->stash('tag');
	my $delim = $args->{delim} || $delimitor{$tag} || undef;
	my $pb = $ctx->stash('PageBute');
	if(!$pb) {
		my %pagebute = ();
		$pb = \%pagebute;
		$ctx->stash('PageBute',$pb);
	}
	$pb->{$tag. '_delim'} = $delim;
	$garbage{$tag} || '';
}

sub _separator {
	$garbage{Separator} || '';
}

sub _page_lists {
	my ($ctx,$args,$cond) = @_;
	my $pb = $ctx->stash('PageBute');
	if(!$pb) {
		my %pagebute = ();
		$pb = \%pagebute;
		$ctx->stash('PageBute',$pb);
	}
	$pb->{page_delim} = defined $args->{delim} ? $args->{delim} : "&nbsp;\n";
	$pb->{link_start} = $args->{link_start} || q{};
	$pb->{link_close} = $args->{link_close} || q{};
	$pb->{show_always} = defined $args->{show_always} ? $args->{show_always} : 1;

	$garbage{PageLists};
}

sub _page_contents {
	my ($ctx,$args,$cond) = @_;
	my $tokens = $ctx->stash('tokens');
	my $builder = $ctx->stash('builder');
	my $pb = $ctx->stash('PageBute');
	if(!$pb) {
		my %pagebute = ();
		$pb = \%pagebute;
		$ctx->stash('PageBute',$pb);
	}

	return $ctx->error( 'This plugin can be applied only once in a page.') if ($pb->{loaded});
	$pb->{loaded} = 1;
	$pb->{contents} = $builder->build($ctx,$tokens,$cond);
	$pb->{count} = $args->{count} || 10;
	$pb->{navi_count} = $args->{navi_count} || '11';
	$pb->{nav_separator} = $args->{nav_separator} || '_';

	$garbage{Contents};
}

sub _page_bute {
	my ( $cb , %opt ) = @_;

	# PageBute was used?
	my $ctx = $opt{Context};
	my $pb  = $ctx->stash('PageBute');
	return 1 unless($pb);

	# Set url and path
	my $blog = $ctx->stash('blog');
	my $site_url  = $blog->site_url;
	my $site_path = $blog->site_path;

	$site_path =~ s!/$!! if $site_path =~ m{/$};
	my $d_sep = '/';
	$d_sep = '\\' if $site_path =~ m{\\};
	$site_path .= $d_sep unless $site_path =~ m{[\\\/]$};

	# Set target path.
	my $file     = $opt{File};

    # Split path.
	my $relative_path = $file;
	$relative_path =~ s!^\Q$site_path\E!!;
	my $file_name = basename( $file );
	$relative_path =~ s!\Q$file_name\E$!!;

    # Set file suffix
	my $suffix = '';
	$suffix = $1 if $file_name =~ /\.([^\.]+)$/;
	$file_name =~ s!\.\Q$suffix\E$!! if $suffix;
	$suffix = $suffix ? ".$suffix" : "";

	# Make URL
	my $base_url  = $site_url . $relative_path . $file_name;
	my $base_path = File::Spec->catdir( dirname( $file )  , $file_name );
	
	# initialize
	my $contents    = $opt{Content};
	my $split_count = $pb->{count};
	my $delim       = $pb->{page_delim};
	my @entries     = split(/$garbage{Separator}/, $pb->{contents});
	my $page_limit  = ceil( $#entries / $split_count );
	my $page_count  = 1;

	my $page_link_format  = '<a href="%%URL%%" class="%%CLASS_NAME%%">%%LINK_NAME%%</a>';
	my $page_static_fromat = '<span class="current_page">%%LINK_NAME%%</span>';

	my $output_page_contents = '';
	my $fmgr = $blog->file_mgr;

	my $debug = '';

	for (my $i=0; $i < $#entries; $i++) {
		$output_page_contents .= $entries[$i];
		if( ($i + 1) % $split_count == 0 || $i == $#entries - 1) {
			$file = $page_count == 1 ? $file : $base_path . "_$page_count$suffix";
			my $output = $$contents;
			$output =~ s/$garbage{Contents}/$output_page_contents/g;

			## Make configuration page.
			my $lists  = _create_lists($page_count, $page_limit , $pb->{navi_count} );

			my ( $page_lists , $first , $before , $next , $last ) = ( '', '' , '' , '' , '' );
			## page lists
			for ( my $i = $lists->{min_page}; $i <= $lists->{max_page}; $i++ ) {
				$page_lists .= $i == $lists->{min_page} ? '' : $delim;
				$page_lists .= $pb->{link_start};
				if( $i == $page_count ){
					$page_lists .= _create_page_link( $page_static_fromat , $i , $base_url , $suffix , $i , 'current_page' );
				}else{
					$page_lists .= _create_page_link( $page_link_format , $i , $base_url , $suffix , $i , 'link_page' );
				}
				$page_lists .= $pb->{link_close};
			}
			
			#replace first link
			if ($lists->{first}) {
			    $first  = _create_page_link( $page_link_format, 1, $base_url, $suffix, $pb->{PAGEFIRST_delim}, 'link_first' );
				$first  = $pb->{link_start}. $first. $pb->{link_close};
				$output =~ s/\Q$garbage{IFPAGEFIRST}\E//g;
				$output =~ s/\Q$garbage{IFPAGEFIRST_END}\E//g;
				$output =~ s/\Q$garbage{PAGEFIRST}\E/$first/g;
			} else {
				$output =~ s/\Q$garbage{IFPAGEFIRST}\E[\s\S]*?\Q$garbage{IFPAGEFIRST_END}\E//g;
			}
			#replace before link
			if ($lists->{before}) {
				$before = _create_page_link( $page_link_format, $page_count - 1, $base_url, $suffix, $pb->{PAGEBEFORE_delim}, 'link_before' );
				$before = $pb->{link_start}. $before. $pb->{link_close};
				$output =~ s/\Q$garbage{IFPAGEBEFORE}\E//g;
				$output =~ s/\Q$garbage{IFPAGEBEFORE_END}\E//g;
				$output =~ s/\Q$garbage{PAGEBEFORE}\E/$before/g;
			} else {
				$output =~ s/\Q$garbage{IFPAGEBEFORE}\E[\s\S]*?\Q$garbage{IFPAGEBEFORE_END}\E//g;
			}
			#replace next link
			if ($lists->{next}) {
				$next = _create_page_link( $page_link_format, $page_count + 1, $base_url, $suffix, $pb->{PAGENEXT_delim}, 'link_next' );
				$next = $pb->{link_start}. $next. $pb->{link_close};
				$output =~ s/\Q$garbage{IFPAGENEXT}\E//g;
				$output =~ s/\Q$garbage{IFPAGENEXT_END}\E//g;
				$output =~ s/\Q$garbage{PAGENEXT}\E/$next/g;
			} else {
				$output =~ s/\Q$garbage{IFPAGENEXT}\E[\s\S]*?\Q$garbage{IFPAGENEXT_END}\E//g;
			}
			#replace last link
			if ($lists->{next}) {
				$last   = _create_page_link( $page_link_format, $lists->{last}, $base_url, $suffix, $pb->{PAGELAST_delim}, 'link_last' );
				$last   = $pb->{link_start}. $last. $pb->{link_close};
				$output =~ s/\Q$garbage{IFPAGELAST}\E//g;
				$output =~ s/\Q$garbage{IFPAGELAST_END}\E//g;
				$output =~ s/\Q$garbage{PAGELAST}\E/$last/g;
			} else {
				$output =~ s/\Q$garbage{IFPAGELAST}\E[\s\S]*?\Q$garbage{IFPAGELAST_END}\E//g;
			}

			# Page Count
			$output =~ s/\Q$garbage{PAGECOUNT}\E/$page_count/g;
			$output =~ s/\Q$garbage{PAGEMAXCOUNT}\E/$lists->{max_page}/g;

			#replace page lists
			if (!$next && !$before && $pb->{show_always} == 0) {
			    $output =~ s/\Q$garbage{PageLists}\E//g;
			}
			else {
			    $output =~ s/\Q$garbage{PageLists}\E/$page_lists/g;
			}
			$fmgr->put_data($output,"${file}.new");
			$fmgr->rename("${file}.new",$file);

			if($page_count == 1) {
				$ctx->stash('FirstContents', $output);
				$ctx->stash('FirstFileName', $file);
			}
			
			$output_page_contents = '';
			$page_count++;
		}
	}
	$ctx->stash('PageBute', 0);
	1;
}

sub _repage_bute {
	my ($cb, %opt) = @_;

	my $ctx = $opt{Context};
	my $file = $ctx->stash('FirstFileName');
	my $contents = $ctx->stash('FirstContents');

	return 1 unless($file);

	my $blog = $ctx->stash('blog');
	my $fmgr = $blog->file_mgr;
	$fmgr->put_data($contents,"${file}.new");
	$fmgr->rename("${file}.new",$file);

	$ctx->stash('FirstFileName',0);
}

sub _create_lists {
	my ($page, $max , $navi_count ) = @_;

    my ($min_page , $max_page , $navi_side_count) = (0,0,0);
    $navi_count = $navi_count || '11';
    if ( $navi_count =~ /^\d+$/ ){
      if($navi_count == 1 || $max == 1){
        $min_page = $page;
        $max_page = $page;
      }else{
        $navi_count = $max if $navi_count > $max;
        $navi_side_count  = $navi_count > 1 ? int ($navi_count/2) : 0;
        $min_page = $page - ($navi_side_count);
        $min_page = 1 if $min_page < 1;
        $max_page = $min_page + ($navi_count - 1);
        $max_page = $max if $max_page > $max;
        $min_page = $max_page - ($navi_count - 1) if ($max_page - $min_page) < ($navi_count - 1);
      }
    }else{
       $max_page = $max;
       $min_page = 1;
    }
	my %pages = (
		first    => $page - 1 > 0 ? 1 : 0,
		before   => $page - 1 > 0 ? $page - 1 : 0,
		next     => $page + 1 <= $max ? $page + 1 : 0,
		last     => $page + 1 <= $max ? $max : 0,
		max_page => $max_page,
		min_page => $min_page
	);
	return \%pages;
}

sub _create_page_link {
	my ($format , $page , $base_url , $suffix , $link_name , $class_name ) = @_;
	my $url = $base_url . ( $page == 1 ? '' : "_$page" ) . $suffix;
	$url =~ s|\\|\/|g; # for windows
    $format =~ s!%%URL%%!$url!;
    $format =~ s!%%CLASS_NAME%%!$class_name!;
    $format =~ s!%%PAGE_NUMBER%%!$page!;
    $format =~ s!%%LINK_NAME%%!$link_name?$link_name:""!e;
	return $format;
}

1;
