<?php

require_once('./config/config.php');

function showerror() 
{
  die("Error " . mysql_errno() . " : " . mysql_error());
}

// Stolen from stackoverflor (user Niet the Dark Absol)
function handleArticles($str) {
    list($first,$rest) = explode(" ",$str." ",2);
       // the extra space is to prevent "undefined offset" notices
       // on single-word titles
    $validarticles = array("a","an","the");
    if( in_array(strtolower($first),$validarticles)) return $rest.", ".$first;
    return $str;
}

function mycomp($a, $b) {
   		  return strnatcasecmp(handleArticles($a), handleArticles($b));
}
?>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<html>
<head>
<title="Yuletide Letters Organised by Fandom">

<link rel="stylesheet" href="styles/default.css" type="text/css">
</head>
<body>
<div class=main>
<h2>Yuletide Letters Organised by Fandom</h2>

<p><a href=index.html>Front Page</a><br>
<a href=byusername.php>Letters by Username</a><br>
<a href=byfandom.php>Letters by Fandom</a><br>
</p>

<p>Click on the fandom to see a list of letters for that fandom:</p>

<?php
   $mysql = mysql_connect($mysql_host, $mysql_user, $mysql_password);
   mysql_set_charset('utf8', $mysql);
   if (!mysql_select_db($mysql_database))
      showerror();

   $sql = "SELECT fandom FROM letters ORDER BY fandom";
   if (!$result = mysql_query($sql, $mysql))
       showerror();
   
   $init = 0;
   $fandoms = array();
   while ($row=mysql_fetch_array($result)) {
         $fandom = $row["fandom"];
	 array_push($fandoms, $fandom);
   }

   usort($fandoms, "mycomp");

   foreach ($fandoms as $fandom) {
   	   $fandom_noamp = preg_replace('/\&/', 'aaaaap', $fandom);
	   $fandom_nohash = preg_replace('/\#/', 'qqqqqp', $fandom_noamp);
	   $fandom_nospace = preg_replace('/ /', 'pppppq', $fandom_nohash);
   	   if ($init == 0) {
	      $old_fandom_name = strtoupper($fandom);
	      $init = 1;
 	      print("<p><a href=fandom_list.php?fandom=$fandom_nospace>$fandom</a><br>");
	   } else {
	     if ($old_fandom_name == strtoupper($fandom)) {
	   } else {
	     $old_fandom_name = strtoupper($fandom);
	     print("<a href=fandom_list.php?fandom=$fandom_nospace>$fandom</a><br>");
	 }}
}
	
?>
</p>

</div>
</body>
</html>
