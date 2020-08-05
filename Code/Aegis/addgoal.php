<!--
Webpage Name: addgoal.php
Main Developer: CJ Conti
Primary Function:Form for adding goals where upon submission, goal is added to the database
with the entered info.
-->

<?php require("sessionstart.php");
require("userauth.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Add Goal</title>
</head>
<body>
<?php
include("header.php");
include("db.php");
$date = new DateTime("now", new DateTimeZone('America/New_York') );
#Checks if the user filled out the form
if(isset($_POST["GoalName"]))
{
  $username=$_SESSION["Username"];
  $goalname=sanitize($_POST["GoalName"],$conn);
  $goaltext=sanitize($_POST["GoalText"],$conn);
  $startdate=sanitize($_POST["StartDate"],$conn);
  $enddate=sanitize($_POST["EndDate"],$conn);
  $diff =(strtotime($startdate) - strtotime($enddate));
  if($diff<=0)
  {
    $query=sprintf("INSERT INTO Goals(Username,GoalName,GoalText,StartDate,EndDate)
    VALUES('%s','%s','%s','%s','%s')",
    $username,$goalname,$goaltext,$startdate,$enddate);
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    print("<p>Goal with name $goalname has been created</p>");
  }
  else
  {
    print("<p>The Goal's end date must be before its start date.</p>");
    print("<p>$startdate</p>");
    print("<p>$enddate</p>");
  }
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
Enter Goal Name:<input name="GoalName"  required></input>
</p>
<p>
Enter Goal Text:
<br>
<textarea name="GoalText" cols="50" rows="10" required>
</textarea>
</p>
<p>
Enter Goal Start Date:
<input name="StartDate" type="date" value="<?php echo date_format($date, 'Y-m-d');?>" required></input>
</p>
<p>
Enter Goal End Date:
<input name="EndDate" type="date" value="<?php echo date_format($date, 'Y-m-d');?>" required></input>
</p>
<button type="submit">Submit</button>
</form>
</body>
</html>
