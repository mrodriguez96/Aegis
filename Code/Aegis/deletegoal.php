<!--
Webpage Name:deletegoal.php
Main Developer: CJ Conti
Primary Function:Lets a user delete a specific goal
-->
<?php
require("memberauth.php");
?>
<html>
<head>
<script type="text/javascript" src="removewatermark.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Delete Goal</title>
</head>
<body>
<?php
include("header.php");
include("db.php");
#Deletes an goal with a specific ID.
if(isset($_GET["ID"]))
{
  $ID=$_GET["ID"];
  $query=sprintf("DELETE FROM Goals WHERE ID='%s'",$ID);
  $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
  print("<p>Deleted Goal</p>");
}
function sanitize($text)
{
  $text=trim($text);
  $text=stripslashes($text);
  $text=htmlspecialchars($text);
  return $text;
}
?>
</body>
</html>
