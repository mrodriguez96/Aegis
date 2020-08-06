<!--
Webpage Name:viewspecificcourse.php
Main Developer: CJ Conti
Primary Function:
Membbers use this page to view a specific course and its files.
Admins can use this page to add and delete files in a specific course.
--><?php
require("memberauth.php");
require("sessionstart.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>View Specific Course</title>
</head>
<body>
<?php
include("header.php");
require("db.php");
?>
<h2>View Course Material</h2>
<?php
require("pagenumber.php");
$coursename=$_GET["coursename"];
$foldername=strtolower($coursename);
$foldername=str_replace("+","_",$foldername);
$foldername=str_replace(" ","_",$foldername);
$truecoursename=str_replace("+"," ",$coursename);
print("<h2>$truecoursename</h2>");
if(isset($_POST["filename"]))
{
  #Gets filename and then donwloads file
  $file = "courses/".$foldername."/".$_POST["filename"];
  $downloadfilename=str_replace("+"," ",$file);
  if (file_exists($file))
  {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Content-Type: application/force-download");
    header('Content-Disposition: attachment; filename=' . urlencode(basename($downloadfilename)));
    // header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
  }
}
#Gets course name
$query=sprintf("SELECT * FROM CourseMaterial WHERE CourseName='%s' LIMIT 10 OFFSET $offset",$foldername);
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
$rowon=1;
while($row=mysqli_fetch_assoc($result))
{
  #Prints course files and download links to them
  print("<table><tbody>");
  $filename=$row["FileName"];
  print("<tr><td>");
  print("<h3>$filename</h3>");
  print("</td></tr>");
  print("<tr><td>");
  print("<form method='post'>");
  print("<input type='hidden' name='filename' value='$filename'>");
  print("<button>Download $filename</button>");
  print("</form>");
  print("</td></tr>");
  #Lets admins delete files from the course.
  if($_SESSION["Usertype"]=="Admin")
  {
    print("<tr><td>");
    print("<form method='post' action='deletefile.php'>");
    print("<input type='hidden' name='filename' value='$filename'>");
    print("<input type='hidden' name='foldername' value='$foldername'>");
    print("<input type='hidden' name='foldername' value='$coursename'>");
    print("<button>Delete $filename</button>");
    print("</form>");
    print("</td></tr>");
  }
  print("</tbody></table>");
  print("<br>");
  $rowon+=1;
}
$query=sprintf("SELECT * FROM CourseMaterial WHERE CourseName='%s'",$foldername);
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
$numcoursefiles=mysqli_num_rows($result);
showpages($page,$numcoursefiles,'CourseName',$foldername);
?>
</body>
</html>
