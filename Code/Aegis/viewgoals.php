<!--
Webpage Name:viewgoals.php
Main Developer: CJ Conti
Primary Function:
Users use this page to view all goals.
Users can use this page to delete a specific goal.
-->
<?php
require("memberauth.php");
require("sessionstart.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>View Goals</title>
</head>
<body>
<?php
include("header.php");
require("db.php");
?>
<h2>View Courses</h2>
<?php
$username=$_SESSION["Username"];
include("pagenumber.php");
$query="SELECT * FROM Goals WHERE Username='$username'";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
$numgoals=mysqli_num_rows($result);
if($offset>$numgoals)
{
  $offset=0;
  $page=1;
}
$query="";
if(isset($_GET["order"]))
{
  if($_GET["order"]=="O-N-Start")
  {
    $query="SELECT * FROM Goals WHERE Username='$username' ORDER BY StartDate ASC LIMIT 10 OFFSET $offset";
  }
  else if($_GET["order"]=="N-O-Start")
  {
    $query="SELECT * FROM Goals WHERE Username='$username' ORDER BY StartDate DESC LIMIT 10 OFFSET $offset";
  }
  else if($_GET["order"]=="O-N-End")
  {
    $query="SELECT * FROM Goals WHERE Username='$username' ORDER BY EndDate ASC LIMIT 10 OFFSET $offset";
  }
  else if($_GET["order"]=="N-O-End")
  {
    $query="SELECT * FROM Goals WHERE Username='$username' ORDER BY EndDate DESC LIMIT 10 OFFSET $offset";
  }
  else if($_GET["order"]=="A-Z")
  {
    $query="SELECT * FROM Goals WHERE Username='$username' ORDER BY GoalName ASC LIMIT 10 OFFSET $offset";
  }
  else if($_GET["order"]=="Z-A")
  {
    $query="SELECT * FROM Goals WHERE Username='$username' ORDER BY GoalName DESC LIMIT 10 OFFSET $offset";
  }
}
else
{
  $query="SELECT * FROM Goals WHERE Username='$username' LIMIT 10 OFFSET $offset";
}
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
$rowon=1;
#Prints all course info
while($row=mysqli_fetch_assoc($result))
{
  $goalname=$row["GoalName"];
  $ID=$row["ID"];
  print("<table><tbody>");
  print("<tr><td> Goal: ".$rowon."</td></tr>");
  print("<tr><td>Goal Name:<br>".$row["GoalName"]."</td></tr>");
  print("<tr><td>Goal Text:<br>".$row["GoalText"]."</td></tr>");
  print("<tr><td>Start Date: ".$row["StartDate"]."</td></tr>");
  print("<tr><td>End Date: ".$row["EndDate"]."</td></tr>");
  print("<tr><td>");
  print("<form method='get' action='editgoal.php'>");
  print("<input type='hidden' name='ID' value='$ID'>");
  print("<button type='submit'>Edit ".$goalname."</button>");
  print("</form>");
  print("</td></tr>");
  print("<tr><td>");
  print("<form method='get' action='deletegoal.php'>");
  print("<input type='hidden' name='ID' value='$ID'>");
  print("<button type='submit'>Delete ".$goalname."</button>");
  print("</form>");
  print("</td></tr>");
  print("</tbody></table>");
  print("<br>");
  $rowon+=1;
}
?>
<form method="get">
<input type="hidden" name="order" value="O-N-Start">
<button>Order by Oldest StartDate</button>
</form>
<form method="get">
<input type="hidden" name="order" value="N-O-Start">
<button>Order by Newest StartDate</button>
</form>
<form method="get">
<input type="hidden" name="order" value="O-N-End">
<button>Order by Oldest EndDate</button>
</form>
<form method="get">
<input type="hidden" name="order" value="N-O-End">
<button>Order by Newest EndDate</button>
</form>
<form method="get">
<input type="hidden" name="order" value="A-Z">
<button>Order by A to Z</button>
</form>
<form method="get">
<input type="hidden" name="order" value="Z-A">
<button>Order by Z to A</button>
</form>
<?php
showpages($page,$numgoals);
?>
</body>
</html>
