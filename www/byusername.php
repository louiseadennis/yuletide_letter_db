<?php

require_once('./config/config.php');

function showerror() 
{
  die("Error " . mysql_errno() . " : " . mysql_error());
}
?>
<html>
<head>
<title="Yuletide Letters Organised by Fandom">

<link rel="stylesheet" href="styles/default.css" type="text/css">
</head>
<body>
<div class=main>
<h2>Yuletide Letters Organised by Fandom</h2>

<p>Click on the fandom to see a list of letters for that fandom</p>
<?
   $sql = "SELECT ao3_name, fandom, url FROM letters ORDER BY ao3_name";
   if (!$result = mysql_query($sql, $connection))
       showerror();
   
   $init = 0;
   while ($row=mysql_fetch_array($result)) {
   	 $ao3_name = $row["ao3_name"];
         $fandom = $row["fandom"];
         $url = $row["url"];

	 if ($init == 0) {
	    $old_ao3_name = $ao3_name;
	    $init = 1;
	    print("<tr><td>$ao3_name</td><td><a href="$url">$url</a></td><td>"($fandom");
	 } else {
	  if ($old_ao3_name == $ao3_name) {
	     print(", $fandom");
	  } else {
	     print(")</td></tr><tr><td>$ao3_name</td><td><a href="$url">$url</a></td><td>"($fandom");
	 }

	 print(")</td></tr>");
   }
?>
</table>

</div>
</body>
</html>
