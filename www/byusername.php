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

<p><a href=index.html>Front Page</a>, <a href=byfandom.php>Letters by Fandom</a></p>

<p>Click on the fandom to see a list of letters for that fandom</p>
<table border>
<?php
   $mysql = mysql_connect($mysql_host, $mysql_user, $mysql_password);
   if (!mysql_select_db($mysql_database))
      showerror();

   $sql = "SELECT ao3_name, fandom, url FROM letters ORDER BY ao3_name";
   if (!$result = mysql_query($sql, $mysql))
       showerror();
   
   $init = 0;
   $old_ao3_name = "none";
   while ($row=mysql_fetch_array($result)) {
   	 $ao3_name = $row["ao3_name"];
         $fandom = $row["fandom"];
         $url = $row["url"];

	 $extra_url = "no_url";
	 if ($init == 0) {
	    $old_ao3_name = $ao3_name;
	    $init = 1;
	    print "<tr><td>$ao3_name</td><td><a href=$url>$url</a></td><td>$fandom";
	 } else {
	   if ($old_ao3_name == $ao3_name) {
	      print("<br> $fandom");
	   } else {
	     	$sql2 = "SELECT url FROM extra_link WHERE ao3_name='$old_ao3_name'";
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
      		
	        $old_ao3_name = $ao3_name;
		print("</td></tr><tr><td>$ao3_name</td><td><a href=$url>$url</a></td><td>$fandom");
	   }
	 }
   }

   $sql2 = "SELECT url FROM extra_link WHERE ao3_name='$old_ao3_name'";
   if ($result2 = mysql_query($sql2, $mysql)) {
      while ($row2=mysql_fetch_array($result2)) {
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
		
    }

    print("</td></tr>");
?>
</table>

</div>
</body>
</html>
