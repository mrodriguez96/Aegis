<!--
Webpage Name:createtopic.php
Main Developer: CJ Conti
Primary Function:This page is used for a user to create a topic.
-->
<?php
require("sessionstart.php");
require("db.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Aegis Home Page</title>
</head>
<body>
<?php
include("header.php");
?>
<h2>Create Topic</h2>
<?php
if(isset($_POST["forumname"])&&isset($_POST["posttext"]))
{
  print("<p>Topic Created!</p>");
  $username=$_SESSION["Username"];
  $forumname=sanitize($_POST["forumname"],$conn);
  $topicname=sanitize($_POST["topicname"],$conn);
  $posttext=sanitize($_POST["posttext"],$conn);

  $nextID=0;
  $query="SELECT * FROM Topics";
  $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
  $IDs=[];
  while($row=mysqli_fetch_assoc($result))
  {
    array_push($IDs,$row["ID"]);
  }
  $done=false;
  for($i=0;$i<65536;$i++)
  {
    $matching=false;
    for($j=0;$j<sizeof($IDs);$j++)
    {
      if($i==$IDs[$j])
      {
        $matching=true;
        break;
      }
    }
    if(!$matching)
    {
      $nextID=$i;
      break;
    }
  }
  $query=sprintf("INSERT INTO Topics(ID,TopicName,ForumName,Username)
  VALUES('%s','%s','%s','%s')",
  $nextID,$topicname,$forumname,$username);
  $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
  $query=sprintf("INSERT INTO Posts(TopicID,Username,PostText)
  VALUES('%s','%s','%s')",$nextID,$username,$posttext);
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  print("<form method='get' action='viewtopic.php'>");
  print("<input type='hidden' name='TopicID' value='$nextID'");
  print("<p><button>View Topic</button></p>");
  print("</form>");
}
if(isset($_GET["forumname"]))
{
  $forumname=$_GET["forumname"];
  print("<form method='get' action='viewspecificforum.php'>");
  print("<input type='hidden' name='forumname' value='$forumname'>");
  print("<button>Go back to $forumname</button>");
  print("</form>");
  print("<h3>Topic will be in $forumname</h3>");
  print("<form method='post'>");
  print("<input type='hidden' name='forumname' value='$forumname'>");
  print("<p>Set Topic Name</p>");
  print("<p><input name='topicname'></p>");
  print("<p>Create Initial Post for the topic</p>");
  print("<p>");
  print("<textarea name='posttext' cols='50' rows='10'></textarea>");
  print("</p>");
  print("<p><button>Create Topic</button></p>");
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
