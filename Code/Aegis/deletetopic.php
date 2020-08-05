<!--
Webpage Name:deletegoal.php
Main Developer: CJ Conti
Primary Function:Lets a user delete a specific topic
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
if(isset($_POST['TopicID']))
{
  $TopicID=$_POST['TopicID'];
  $query = "DELETE FROM Topics WHERE ID=$TopicID";
  $result = mysqli_query($conn,$query) or die ( mysqli_error());
  $query = "DELETE FROM Posts WHERE TopicID=$TopicID";
  $result = mysqli_query($conn,$query) or die ( mysqli_error());
  print("<p>Deleted Topic Successfully</p>");
}
else if(isset($_GET['TopicID']))
{
  $TopicID=$_GET['TopicID'];
  $forumname=$_GET["forumname"];
  $query = "SELECT * FROM Topics WHERE ID=$TopicID";
  $result = mysqli_query($conn,$query) or die ( mysqli_error());
  $posttext="";
  while($row=mysqli_fetch_assoc($result))
  {
    $topicname=$row["TopicName"];
  }
  print("<p>Confirm that you would like to delete topic with name</p><p>$topicname</p>");
  print("<form method='post'>");
  print("<input type='hidden' value='$TopicID' name='TopicID'");
  print("<p><button>Confirm Delete</button></p>");
  print("</form>");
}
if(isset($_GET["forumname"]))
{
  $forumname=$_GET["forumname"];
  print("<form method='get' action='viewspecificforum.php'>");
  print("<input type='hidden' name='forumname' value='$forumname'");
  print("<p><button>Go Back</button>");
  print("</form>");
}
?>
</body>
</html>
