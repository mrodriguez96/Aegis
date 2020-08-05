<!--
Webpage Name:addcourse.php
Main Developer: CJ Conti
Primary Function:Form for editing goals where upon submission, goal is updated in the database
with the entered info.
-->

<?php require("sessionstart.php");
require("auth.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Edit Goal</title>
</head>
<body>
<?php
include("header.php");
include("db.php");
$date = new DateTime("now", new DateTimeZone('America/New_York') );
#Checks if the user filled out the form
$username=$_SESSION["Username"];
$goalname="";
$goaltext="";
$startdate="";
$enddate="";
if(isset($_GET["ID"]))
{
  $ID=$_GET["ID"];
  $query="SELECT * FROM Goals WHERE ID='$ID'";
  $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
  while($row=mysqli_fetch_assoc($result))
  {
    $goalname=$row["GoalName"];
    $goaltext=$row["GoalText"];
    $startdate=$row["StartDate"];
    $enddate=$row["EndDate"];
  }
}
if(isset($_POST["GoalName"]))
{
  $username=$_SESSION["Username"];
  $goalname=sanitize($_POST["GoalName"],$conn);
  $goaltext=sanitize($_POST["GoalText"],$conn);
  $startdate=sanitize($_POST["StartDate"],$conn);
  $enddate=sanitize($_POST["EndDate"],$conn);
  $query=sprintf("UPDATE Goals SET Username='%s',GoalName='%s',GoalText='%s',
  StartDate='%s',EndDate='%s'"."WHERE ID='%d'",
  $username,$goalname,$goaltext,$startdate,$enddate,$ID);
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

  print("<p>Goal updated");
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
<h2>Add Goal</h2>
<h3>Enter Goal info</h3>
<form method="post">
<p>
Enter Goal Name:
<input name="GoalName" value="<?php print($goalname);?>"required></input>
</p>
<p>
Enter Goal Text:
<br>
<textarea name="GoalText" cols="50" rows="10" required>
<?php
print($goaltext);
?>
</textarea>
</p>
<p>
Enter Goal Start Date:
<p>
<input name="StartDate" type="date" value="<?php print($startdate);?>" required></input>
</p>
Enter Goal End Date:
<p>
<input name="EndDate" type="date" value="<?php print($enddate)?>" required></input>
</p>
<button type="submit">Submit</button>
</form>
</body>
</html>
