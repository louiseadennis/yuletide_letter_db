$filename ="Yuletide Letters 2015 - Fandom listing.csv";

open FILE, $filename or die $!;

$init = 0;
while (<FILE>) {
    if ($init < 3) {
        $line = $_;
        $init++;
    } else {
        $line = $_;
        chomp($line);
        $rline = reverse $line;
        @line_array = split(",", $rline, 26);
        $fandom = reverse $line_array[25];
        $fandom =~ s/^\"//;
        $fandom =~ s/\"\"/ppppp/g;
        $fandom =~ s/\"//;
        $fandom =~ s/ppppp/\\\"/g;
        $fandom =~ s/\-\-/\-/;
        $ao3_name = reverse $line_array[24];
        $url1 = reverse $line_array[23];
        $url1 =~ s/^\"//;
        $url1 =~ s/\"//;
        $url2 = reverse $line_array[22];
         print "INSERT INTO letters (fandom, ao3_name, url1, url2) VALUES (\"$fandom\", \"$ao3_name\", \"$url1\", \"$url2\");";
        print "\n";
    }
}