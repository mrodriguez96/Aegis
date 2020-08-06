<!--
Webpage Name:surveycomplete.php
Main Developer: CJ Conti
Primary Function:Saves the result of the survey to the survey database.
-->
<?php
require("sessionstart.php");
require("partnerauth.php");
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
<h2>Survey</h2>
<?php
if(isset($_POST["satisfaction"]))
{
  $partnername=sanitize($_POST["partnername"],$conn);
  $participantname=sanitize($_POST["participantname"],$conn);
  $satisfaction=$_POST["satisfaction"];
  $hardworking=$_POST["hardworking"];
  $focus=$_POST["focus"];
  $improvement=$_POST["improvement"];
  $positive=sanitize($_POST["positive"],$conn);
  $wheretoimprove=sanitize($_POST["wheretoimprove"],$conn);
  $other="";
  if(isset($_POST["other"]))
  {
    $other=sanitize($_POST["other"],$conn);
  }
  $query=sprintf("INSERT INTO Surveys(PartnerName,ParticipantName,Satisfaction,HardWorking,Focus,Improvement,Positive,WhereToImprove,Other)
  VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s')",
  $partnername,$participantname,$satisfaction,$hardworking,$focus,$improvement,$positive,$wheretoimprove,$other);
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
}
print("<h3>Survey Complete</h3>");
print("<p><a href='survey.php'>Fill out another survey</a></p>");
print("<p><a href='index.php'>Return to home page</a></p>");
print("<p><a href='viewsurveys.php'>View surveys</a></p>");
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
