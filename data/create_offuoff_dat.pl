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
        print "INSERT INTO letters (fandom, ao3_name, url) VALUES ($line_array[3], $line_array[1], $line_array[2]);";
        print "\n";
    }
}