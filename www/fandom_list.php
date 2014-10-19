<?php

require_once('./config/config.php');

$fandomppp = $_GET["fandom"];
$fandomqqq = preg_replace('/pppppq/', ' $1', $fandomppp);
$fandom1 = preg_replace('/qqqqqp/', '#', $fandomqqq);
$fandom = preg_replace('/\'/', '\\\'', $fandom1);

function showerror() 
{
  die("Error " . mysql_errno() . " : " . mysql_error());
}
?>
<html>
<head>
<?php
	print ("<title=\"Yuletide Letters for $fandom1\">");
?>

<link rel="stylesheet" href="styles/default.css" type="text/css">
</head>
<body>
<div class=main>
<?php
	print ("<h2>Yuletide Letters for $fandom1</h2>");
?>

<p><a href=index.html>Front Page</a>, <a href=byfandom.php>Letters by Fandom</a>, <a href=byusername.php>Letters by Username</a></p>

<table border>
<?php
   $mysql = mysql_connect($mysql_host, $mysql_user, $mysql_password);
   if (!mysql_select_db($mysql_database))
      showerror();

   $sql = "SELECT ao3_name, url FROM letters WHERE fandom='$fandom'";
   if (!$result = mysql_query($sql, $mysql))
       showerror();
   
   while ($row=mysql_fetch_array($result)) {
   	 $ao3_name = $row["ao3_name"];
         $url = $row["url"];
   	 print("<tr><td>$ao3_name</td><td><a href=$url>$url</a></td>");
     	$sql2 = "SELECT url FROM extra_link WHERE ao3_name='$ao3_name'";
		if ($result2 = mysql_query($sql2, $mysql)) {
		   $found = 0;
		   while ($row2=mysql_fetch_array($result2)) {
		            $extra_url = $row2["url"];
			    print "<td><a href=$extra_url>$extra_url</a></td>";
			    $found = 1;
	           }
		   if ($found == 0) {
		      print "<td>&nbsp;</td>";
		   }
		}
        print("</tr>");
   }
?>
</table>
</div>
</body>
</html>