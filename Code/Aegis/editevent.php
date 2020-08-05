<!--
Webpage Name:editevent.php
Main Developer: CJ Conti
Primary Function:Lets a user edit a specific event
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
require("memberauth.php");
include("header.php");
?>
<?php
$ID=$_GET["ID"];
$query="SELECT * FROM Events WHERE ID='$ID'";
$result=mysqli_query($conn,$query) or die(mysqli_error($conn));
$name;
$date;
$time;
$repeatrate;
$repeatcount;
while($row=mysqli_fetch_assoc($result))
{
  $name=$row["Name"];
  $date=$row["EventDate"];
  $time=$row["EventTime"];
  $repeatrate=$row["RepeatRate"];
  $repeatcount=$row["RepeatCount"];
}
if(isset($_POST["date"]))
{
  $username=$_SESSION["Username"];
  $name=sanitize($_POST["name"],$conn);
  $date=sanitize($_POST["date"],$conn);
  $time=sanitize($_POST["time"],$conn);
  $repeatrate=sanitize($_POST["repeatrate"],$conn);
  $repititioncount=sanitize($_POST["repeatcount"],$conn);
  $query=sprintf("UPDATE Events SET Username='%s',Name='%s',EventDate='%s',
EventTime='%s',RepeatRate='%s',RepeatCount='%s'"."WHERE ID='%d'",
  $username,$name,$date,$time,$repeatrate,$repititioncount,$ID);
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  print("<h3>Event Updated</h3>");
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
<h2>Edit Event</h2>
<h3>Enter event info</h3>
<form method="post">
<p>
Enter Event Name:
<input name="name" value="<?php print($name);?>" required></input>
</p>
<p>
Enter Event Date:
<input name="date" type="date" value="<?php print($date);?>" required></input>
</p>
Enter Event Time:
<input name="time" type="time" value="<?php print($time);?>"required></input>
</p>
<p>
Enter Repitition Rate:
<select option name="repeatrate">
<option value='0'
<?php
if($repeatrate==0)
{
  print("selected");
}
?>
>Never</option>
<option value='1'
<?php
if($repeatrate==1)
{
  print("selected");
}
?>
>Daily</option>
<option value='7'
<?php
if($repeatrate==7)
{
  print("selected");
}
?>
>Weekly</option>
<option value='14'
<?php
if($repeatrate==14)
{
  print("selected");
}
?>
>Every two weeks</option>
<option value='28'
<?php
if($repeatrate==28)
{
  print("selected");
}
?>
>Every four weeks</option>
</select>
</p>
<p>
Enter Repeat Count(0-52):
<input type="number" value="<?php print($repeatcount)?>" min="0" max="52" name="repeatcount" required></input>
</p>
<button type="submit">Submit</button>
</form>
</body>
</html>
