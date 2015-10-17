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
        @line_array = split(",", $line, 5);
        $fandom = $line_array[0];
        $fandom =~ s/^\"//;
        $fandom =~ s/\"\"/ppppp/g;
        $fandom =~ s/\"//;
        $fandom =~ s/ppppp/\\\"/g;
        $fandom =~ s/\-\-/\-/;
         print "INSERT INTO letters (fandom, ao3_name, url1, url2) VALUES (\"$fandom\", \"$line_array[1]\", \"$line_array[2]\", \"$line_array[3]\");";
        print "\n";
    }
}