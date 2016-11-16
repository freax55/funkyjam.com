package MT::Plugin::entry2mobile;

use MT::Template::Context;
MT::Template::Context->add_global_filter (entry2mobile => \&entry2mobile);
MT::Template::Context->add_global_filter (entry2pc => \&entry2pc);
MT::Template::Context->add_global_filter (entry2sp => \&entry2sp);


sub entry2mobile {
	my ($data, $deftext, $ctx) = @_;
	my $str = '';
	
	#br to nl
	$data =~ s!<br(.*?)>!\n!gi;
	
	#only pc tag remove
	$data =~ s!<(\w+?)([^>]*?)rel="pcOnly"(.*?)</\1>!!gsi;

	#only sp tag remove
	$data =~ s!<(\w+?)([^>]*?)rel="spOnly"(.*?)</\1>!!gsi;

	
	#only mobile tag escape
	$data =~ s!<([^>]*?)rel="mbOnly"(.*?)>!<$1rel="entry2mobile_no_remove_tag"$2>!gi;
	
	#change to no_remove_tag
	while($data =~ /<(\w+)([^>]*?)rel="entry2mobile_no_remove_tag"(.*?>.*?<.*?<\/)\1>|<(\w+)([^>]*?)rel="entry2mobile_no_remove_tag"(.*?>.*?>.*?<\/)\1>/gs){
		$str = '<'.$1.$2.$3.$1.'>';
		
		$str =~ s/</NonRemoveTagEntryToMobileLT/gs;
		$str =~ s/>/NonRemoveTagEntryToMobileGT/gs;
		
		$data =~ s/<(\w+)([^>]*?rel="entry2mobile_no_remove_tag".*?>.*?<.*?<\/)\1>|<(\w+)([^>]*?rel="entry2mobile_no_remove_tag".*?>.*?>.*?<\/)\1>/$str/s;
	}
	
	#Image to link(tag escape)
	
	$data =~ s!<img[^>]*?src="/([^>]*?)"[^>]*?>!\n¥NonRemoveTagEntryToMobileLTa href="/image/image_test.php?path=$1&cr=100"NonRemoveTagEntryToMobileGT $deftext NonRemoveTagEntryToMobileLT/aNonRemoveTagEntryToMobileGT\n!g;
	
	#remove tags
	$data =~ s!<[^>]*?>!!g;
	
	#return non_remove_tag
	#$data =~ s!NonRemoveTagEntryToMobileLT(.*?)NonRemoveTagEntryToMobileGT!<$1>!gs;
	$data =~ s!NonRemoveTagEntryToMobileLT!<!g;
	$data =~ s!NonRemoveTagEntryToMobileGT!>!g;
	
	#nl to br
	$data =~ s!\n!<br>\n!g;
	
	#tab delete
	$data =~ s!\t!!g;
	
	$data;
}

1;

sub entry2pc {
	my ($data, $deftext, $ctx) = @_;
	my $str = '';
	
	#only mobile tag remove
	$data =~ s!<(\w+?)([^>]*?)rel="mbOnly"(.*?)</\1>!!gs;
	
	#only sp tag remove
	$data =~ s!<(\w+?)([^>]*?)rel="spOnly"(.*?)</\1>!!gsi;
	
	$data;
}
1;

sub entry2sp {
	my ($data, $deftext, $ctx) = @_;
	my $str = '';
	
	#only mobile tag remove
	$data =~ s!<(\w+?)([^>]*?)rel="mbOnly"(.*?)</\1>!!gs;

	#only pc tag remove
	$data =~ s!<(\w+?)([^>]*?)rel="pcOnly"(.*?)</\1>!!gsi;
	
	$data;
}


1;