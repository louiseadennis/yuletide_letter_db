<?php

require_once('./config/config.php');

$fandomppp = $_GET["fandom"];
$fandomqqq = preg_replace('/ppppp/', ' ', $fandomppp);
$fandom1 = preg_replace('/qqqqq/', '#', $fandomqqq);
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

<table>
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
   	 print("<tr><td>$ao3_name</td><td><a href=$url>$url</a></td></tr>");
   }
?>
</table>
</div>
</body>
</html>