package EntryFileRemover::CMS;

use strict;

sub remove {
    my ($cb, %args) = @_;
    return if $args{archive_type} ne 'Individual';
    if ($args{file} =~ /^.*-1\..*$/) {
        (my $file = $args{file}) =~ s/^(.*)-1(\..*)$/$1$2/; 
        my $fmgr = $args{blog}->file_mgr;
        $fmgr->delete($file) if $fmgr->exists($file);
    }
}

1;
