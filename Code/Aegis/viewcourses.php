<!--
Webpage Name:viewcourses.php
Main Developer: CJ Conti
Primary Function:
Users use this page to view all courses.
Admins can use this page to delete a specific course.
-->
<?php
require("memberauth.php");
require("sessionstart.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>View Accounts</title>
</head>
<body>
<?php
include("header.php");
require("db.php");
?>
<h2>View Courses</h2>
<?php
$query="";
include("pagenumber.php");
$query="SELECT * FROM Courses";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
$numcourses=mysqli_num_rows($result);
if($offset>$numcourses)
{
  $page=1;
  $offset=0;
}
if(isset($_GET["order"]))
{
  if($_GET["order"]=="O-N")
  {
    $query="SELECT * FROM Courses ORDER BY ID ASC LIMIT 10 OFFSET $offset";
  }
  else if($_GET["order"]=="N-O")
  {
    $query="SELECT * FROM Courses ORDER BY ID DESC LIMIT 10 OFFSET $offset";
  }
  else if($_GET["order"]=="A-Z")
  {
    $query="SELECT * FROM Courses ORDER BY CourseName ASC LIMIT 10 OFFSET $offset";
  }
  else if($_GET["order"]=="Z-A")
  {
    $query="SELECT * FROM Courses ORDER BY CourseName DESC LIMIT 10 OFFSET $offset";
  }
}
else
{
  $query="SELECT * FROM Courses LIMIT 10 OFFSET $offset";
}
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
$rowon=1;
#Prints all course info
while($row=mysqli_fetch_assoc($result))
{
  $coursename=$row["CourseName"];
  print("<table><tbody>");
  print("<tr><td> Course: ".$rowon."</td></tr>");
  print("<tr><td><b>".$coursename."</b></td></tr>");
  print("<tr><td>");
  print("<form method='get' action='viewspecificcourse.php'>");
  print("<input type='hidden' name='coursename' value='$coursename'>");
  print("<button type='submit'>Enter ".$coursename."</button>");
  print("</form>");
  print("</td></tr>");
  if($_SESSION["Usertype"]=="Admin")
  {
    print("<tr><td>");
    print("<form method='post' action='deletecourse.php'>");
    print("<input type='hidden' name='coursename' value='$coursename'>");
    print("<button type='submit'>Delete ".$coursename."</button>");
    print("</td></tr>");
    print("</form>");
  }
  print("</tbody></table>");
  print("<br>");
  $rowon+=1;
}
?>
<form method="get">
<input type="hidden" name="order" value="O-N">
<button>Order by Oldest First</button>
</form>
<form method="get">
<input type="hidden" name="order" value="N-O">
<button>Order by Newest First</button>
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
if(isset($_GET["page"]))
{
  $page=$_GET["page"];
}
showpages($page,$numcourses);
?>
</body>
</html>
