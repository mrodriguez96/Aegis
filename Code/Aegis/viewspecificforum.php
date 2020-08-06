<!--
Webpage Name:viewspecificforum.php
Main Developer: CJ Conti
Primary Function:This page lets users view a specific subforum within the main forum.
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
if(isset($_GET["forumname"]))
{
  include("pagenumber.php");
  $forumname=sanitize($_GET["forumname"],$conn);
  print("<p><a href='forum.php'>Go back to forum</a></p>");
  print("<form action='createtopic.php' method='get'>");
  print("<input type='hidden' name='forumname' value='$forumname'>");
  print("<p><button>Create Topic</button></p>");
  print("</form>");
  $query="SELECT * FROM Topics WHERE ForumName='$forumname' LIMIT 10 OFFSET $offset";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  print("<table><thead>");
  print("<td>Topics</td>");
  print("</thead><tbody>");
  while($row=mysqli_fetch_assoc($result))
  {
    print("<tr><td>");
    print("<form method='get' action='viewtopic.php'>");
    $topicname=$row["TopicName"];
    $TopicID=$row["ID"];
    print("<input type='hidden' name='TopicID' value='$TopicID'>");
    print("<button>".$topicname."</button>");
    print("</form>");
    print("</td>");
    if(isset($_SESSION["Username"])&&isset($_SESSION["Usertype"])&&$_SESSION["Usertype"]=="Admin")
    {
      print("<form action='deletetopic.php' method='get'>");
      print("<td>");
      print("<input type='hidden' name='TopicID' value='$TopicID'>");
      print("<input type='hidden' name='forumname' value='$forumname'>");
      print("<button>Remove Topic</button>");
      print("</td>");
      print("</form>");
    }
    print("</tr>");
  }
  print("<tr><td>");
  print("</td></tr>");
  print("</tbody></table>");
  $query="SELECT * FROM Topics WHERE ForumName='$forumname'";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  $numtopics=mysqli_num_rows($result);
  showpages($page,$numtopics,'forumname',$forumname);
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
