<?php

require_once('./config/config.php');

$fandom = $_GET["fandom"];

function showerror() 
{
  die("Error " . mysql_errno() . " : " . mysql_error());
}
?>
<html>
<head>
<title="Yuletide Letters for $fandom">

<link rel="stylesheet" href="styles/default.css" type="text/css">
</head>
<body>
<div class=main>
<h2>Yuletide Letters for $fandom</h2>

<table>
<?php
   $sql = "SELECT ao3_name, url FROM letters WHERE fandom=$fandom";
   if (!$result = mysql_query($sql, $connection))
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