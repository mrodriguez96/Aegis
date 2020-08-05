<!--
Webpage Name:deletegoal.php
Main Developer: CJ Conti
Primary Function:Lets a user delete a specific post
-->
<?php
require("userauth.php");
require("sessionstart.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
// Create connection
include("header.php");
include("db.php");
if(isset($_POST['ID']))
{
  $ID=$_POST['ID'];
  $query = "DELETE FROM Posts WHERE ID=$ID";
  $result = mysqli_query($conn,$query) or die ( mysqli_error());
  print("<p>Deleted Post Successfully</p>");
}
else if(isset($_GET['ID']))
{
  $ID=$_GET['ID'];
  $TopicID=$_GET["TopicID"];
  $query = "SELECT * FROM Posts WHERE ID=$ID";
  $result = mysqli_query($conn,$query) or die ( mysqli_error());
  $posttext="";
  while($row=mysqli_fetch_assoc($result))
  {
    $posttext=$row["PostText"];
  }
  print("<p>Confirm that you would like to delete post with text</p><p>$posttext</p>");
  print("<form method='post'>");
  print("<input type='hidden' value='$ID' name='ID'");
  print("<p><button>Confirm Delete</button></p>");
  print("</form>");
}
if(isset($_GET["TopicID"]))
{
  $TopicID=$_GET["TopicID"];
  print("<form method='get' action='viewtopic.php'>");
  print("<input type='hidden' name='TopicID' value='$TopicID'");
  print("<p><button>Go Back</button>");
  print("</form>");
}
?>
</body>
</html>
