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
   $sql = "SELECT fandom FROM letters ORDER BY fandom";
   if (!$result = mysql_query($sql, $connection))
       showerror();
   
   $init = 0;
   while ($row=mysql_fetch_array($result)) {
         $fandom = $row["fandom"];

	 if ($init == 0) {
	    $old_fandom_name = $fandom;
	    $init = 1;
	    print("<p><a href="fandom_list.php?fandom=$fandom">$fandom</a></p>");
	 } else {
	  if ($old_ao3_name == $ao3_name) {
	  } else {
	    print("<p><a href="fandom_list.php?fandom=$fandom">$fandom</a></p>");
	 }
   }
?>
</table>

</div>
</body>
</html>
