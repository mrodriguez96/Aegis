<!--
Webpage Name:addcourse.php
Main Developer: CJ Conti
Primary Function:Form for adding course where upon submission, course is added to the database
with the entered info.
-->

<?php require("sessionstart.php");
require("adminauth.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Aegis Home Page</title>
</head>
<body>
<?php
include("header.php");
include("db.php");
#Checks if the user filled out the form
if(isset($_POST["coursename"]))
{
  $coursename=sanitize($_POST["coursename"],$conn);
  $foldername=strtolower($coursename);
  $foldername=str_replace(" ","_",$foldername);

  #Gets the number of courses
  $query="SELECT * FROM Courses";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  $rowcount=mysqli_num_rows($result);

  #Creates a new course with the entered info and the ID of the number of rows plus one.


  $query=sprintf("INSERT INTO Courses(CourseName,Foldername)
  VALUES('%s','%s')",$coursename,$foldername);
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

  #Creates a folder in courses with the name coursename
  mkdir("courses/".$foldername,0777);
  print("<p>Course with name $coursename has been created with folder $foldername");
  print("<p><a href='viewcourses.php'>View Courses</a></p>");
  print("<p><a href='fileuploadform.php'>Upload File</a></p>");
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
<h2>Add Course</h2>
<h3>Enter Course info</h3>
<form method="post">
<p>
Enter Course Name:
<input name="coursename" value="New Course" required></input>
</p>
<button type="submit">Submit</button>
</form>
</body>
</html>
