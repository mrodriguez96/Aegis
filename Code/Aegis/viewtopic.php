viewtopic.php
<!--
Webpage Name:viewtopic.php
Main Developer: CJ Conti
Primary Function:This page lets users view a specific topic.
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
if(isset($_GET["TopicID"]))
{
  include("pagenumber.php");
  $TopicID=sanitize($_GET["TopicID"],$conn);
  $query="SELECT * FROM Topics WHERE ID='$TopicID'";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  while($row=mysqli_fetch_assoc($result))
  {
    $topicname=sanitize($row["TopicName"],$conn);
    $forumname=$row["ForumName"];
  }
  print("<form method='get' action='viewspecificforum.php'>");
  print("<input type='hidden' name='forumname' value='$forumname'>");
  print("<button>Go back to $forumname</button>");
  print("</form>");
  $query="SELECT * FROM Posts WHERE TopicID='$TopicID' LIMIT 10 OFFSET $offset";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  print("<table><thead>");
  print("<td colspan='2' style='text-align: center;'><h2>$topicname</h2></td>");
  print("</thead><tbody>");
  while($row=mysqli_fetch_assoc($result))
  {
    $posttext=$row["PostText"];
    $username=$row["Username"];
    print("<tr><td>");
    print($posttext);
    print("</td>");
    print("<td>");
    print("Post by: ".$username."<br><br><br><br>");
    print("</td>");
    if(isset($_SESSION["Username"])&&isset($_SESSION["Usertype"])&&$_SESSION["Usertype"]=="Admin")
    {
      $ID=$row["ID"];
      print("<form action='deletepost.php' method='get'>");
      print("<td>");
      print("<input type='hidden' name='TopicID' value='$TopicID'>");
      print("<input type='hidden' name='ID' value='$ID'>");
      print("<button>Remove Post</button>");
      print("</td>");
      print("</form>");
    }
    print("</tr>");
  }
  print("<tr><td>");
  print("</td></tr>");
  print("</tbody></table>");
  print("<form action='postreply.php' method='get'>");
  print("<input type='hidden' name='topicname' value='$topicname'>");
  print("<input type='hidden' name='TopicID' value='$TopicID'>");
  print("<p><button>Post Reply</button></p>");
  print("</form>");
  $query="SELECT * FROM Posts WHERE TopicID='$TopicID'";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  $numposts=mysqli_num_rows($result);
  showpages($page,$numposts,'TopicID',$TopicID);
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
