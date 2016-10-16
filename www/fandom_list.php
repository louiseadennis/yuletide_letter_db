<?php

require_once('./config/config.php');

$fandomaaa = $_GET["fandom"];
$fandomppp = preg_replace('/aaaaap/', '\&', $fandomaaa);
$fandomqqq = preg_replace('/pppppq/', ' $1', $fandomppp);
$fandom1 = preg_replace('/qqqqqp/', '#', $fandomqqq);
$fandom = urldecode(str_replace("\\","",$fandom1));
$fandomt = preg_replace('/([^(\\\\)])\'/', '$1\\\'', $fandom);

function showerror() 
{
  die("Error " . mysql_errno() . " : " . mysql_error());
}
?>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<html>
<head>
<?php
	print ("<title=\"Yuletide Letters for $fandom\">");
?>

<link rel="stylesheet" href="styles/default.css" type="text/css">
</head>
<body>
<div class=main>
<?php
	print ("<h2>Yuletide Letters for $fandom</h2>");
?>

<p><a href=index.html>Front Page</a><br>
<a href=byusername.php>Letters by Username</a><br>
<a href=byfandom.php>Letters by Fandom</a><br>
<a href=byfandom_noarticles.php>Letters by Fandom (sorted ignoring English articles)</a><br>
</p>

<table border>
<?php
   $mysql = mysql_connect($mysql_host, $mysql_user, $mysql_password);
   mysql_set_charset('utf8', $mysql);
   if (!mysql_select_db($mysql_database))
      showerror();

   $sql = "SELECT ao3_name, url1, url2 FROM letters WHERE fandom='$fandomt'";
   if (!$result = mysql_query($sql, $mysql))
       showerror();
   
   while ($row=mysql_fetch_array($result)) {
   	 $ao3_name = $row["ao3_name"];
         $url = $row["url1"];
         $extra_url = $row["url2"];
	 if (substr($url, 0, 4) != "http") {
		$url = "http://" . $url;
	 }
     	 if ($extra_url != "" && substr($extra_url, 0, 4) != "http") {
		$extra_url = "http://" . $extra_url;
	 }
   	 print("<tr><td>$ao3_name</td><td><a href=$url>$url</a></td>");
         print "<td><a href=$extra_url>$extra_url</a></td>";
         print("</tr>");
   }
?>
</table>
</div>
</body>
</html>
