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
        @line_array = split(",", $line, 4);
        $fandom = $line_array[3];
        $fandom =~ s/^\"//;
        $fandom =~ s/\"\"/ppppp/g;
        $fandom =~ s/\"//;
        $fandom =~ s/ppppp/\\\"/g;
         print "INSERT INTO letters (fandom, ao3_name, url) VALUES (\"$fandom\", \"$line_array[1]\", \"$line_array[2]\");";
        print "\n";
    }
}