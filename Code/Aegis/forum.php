<!--
Webpage Name:forum.php
Main Developer: CJ Conti
Primary Function:The page that acts as the starting point for the forum.
-->
<?php
require("sessionstart.php");
require("userauth.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Aegis Home Page</title>
</head>
<body>
<?php
include("header.php");
require("db.php");
?>
<h2>Aegis Forum</h2>
<?php
$query="SELECT * FROM Forums";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
print("<table><thead>");
print("<td>Forums</td>");
print("</thead><tbody>");
while($row=mysqli_fetch_assoc($result))
{
  print("<tr><td>");
  print("<form method='get' action='viewspecificforum.php'>");
  $forumname=$row["ForumName"];
  print("<input type='hidden' name='forumname' value='$forumname'>");
  print("<button>".$forumname."</button>");
  print("</form>");
  print("</td>");
  print("<td>");
  print($row["ForumDescription"]);
  print("</td>");
  print("</tr>");
}
print("</tbody></table>");
?>
<p></p>
</body>
</html>
