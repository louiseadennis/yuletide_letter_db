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

<table>
<?php
   $mysql = mysql_connect($mysql_host, $mysql_user, $mysql_password);
   if (!mysql_select_db($mysql_database))
      showerror();

   $sql = "SELECT fandom FROM letters ORDER BY fandom";
   if (!$result = mysql_query($sql, $mysql))
       showerror();
   
   $init = 0;
   while ($row=mysql_fetch_array($result)) {
         $fandom = $row["fandom"];
	 $fandom_nohash = preg_replace('/\#/', 'qqqqq', $fandom);
	 $fandom_nospace = preg_replace('/ /', 'ppppp', $fandom_nohash);

	 if ($init == 0) {
	    $old_fandom_name = $fandom;
	    $init = 1;
	    print("<p><a href=fandom_list.php?fandom=$fandom_nospace>$fandom</a></p>");
	 } else {
	  if ($old_fandom_name == $fandom) {
	  } else {
	    $old_fandom_name = $fandom;
	    print("<p><a href=fandom_list.php?fandom=$fandom_nospace>$fandom</a></p>");
	 }}
}
	
?>
</table>

</div>
</body>
</html>
