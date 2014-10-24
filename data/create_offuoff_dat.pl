$filename ="YuleLetters 2014 - Letter\ By\ Fandom.csv";

open FILE, $filename or die $!;

$init = 0;
while (<FILE>) {
    if ($init == 0) {
        $line = $_;
        $init = 1;
    } else {
        $line = $_;
        chomp($line);
        @line_array = split(",", $line, 5);
        $fandom = $line_array[4];
        $fandom =~ s/^\"//;
        $fandom =~ s/\"\"/ppppp/g;
        $fandom =~ s/\"//;
        $fandom =~ s/ppppp/\\\"/g;
        $fandom =~ s/\-\-/\-/;
         print "INSERT INTO letters (fandom, ao3_name, url1, url2) VALUES (\"$fandom\", \"$line_array[1]\", \"$line_array[2]\", \"$line_array[3]\");";
        print "\n";
    }
}