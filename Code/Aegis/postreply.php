<!--
Webpage Name:postreply.php
Main Developer: CJ Conti
Primary Function:This page is used when a user makes a reply in a topic on the forum.
-->
<?php
require("sessionstart.php");
require("db.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Post Reply</title>
</head>
<body>
<?php
include("header.php");
?>
<h2>Post Reply</h2>
<?php
if(isset($_POST["posttext"]))
{
  print("<p>Reply Created!</p>");
  $username=$_SESSION["Username"];
  $posttext=sanitize($_POST["posttext"],$conn);
  $TopicID=$_GET["TopicID"];
  $query=sprintf("INSERT INTO Posts(TopicID,Username,PostText)
  VALUES('%s','%s','%s')",
  $TopicID,$username,$posttext);
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
}
if(isset($_GET["TopicID"]))
{
  $TopicID=$_GET["TopicID"];
  $topicname=$_GET["topicname"];
  print("<form method='post'>");
  print("<h3>Create Reply for the Topic $topicname</h3>");
  print("<p>");
  print("<textarea name='posttext' cols='50' rows='10'></textarea>");
  print("</p>");
  print("<p><button>Post Reply</button></p>");
  print("</form>");
  print("<form method='get' action='viewtopic.php'>");
  print("<input type='hidden' name='TopicID' value='$TopicID'");
  print("<p><button>Go Back to $topicname</button>");
  print("</form>");
}
function sanitize($text,$conn)
{
  $text=trim($text);
  $text=stripslashes($text);
  $text=htmlspecialchars($text);
  $text=mysqli_real_escape_string($conn,$text);
  return $text;
}
?>
</body>
</html>
