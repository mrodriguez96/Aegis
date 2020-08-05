<!--
Webpage Name:fileuploadform.php
Main Developer: CJ Conti
Primary Function:An admin can use this page to upload a file to a specific course.
-->
<!DOCTYPE html>
<?php
require("adminauth.php");
require("sessionstart.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>File Upload Form</title>
</head>
<body>
<?php
include("header.php");
include("db.php");

$query="SELECT * FROM Courses";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
$rowcount=mysqli_num_rows($result);
$coursenames=[];
$foldernames=[];
while($row=mysqli_fetch_assoc($result))
{
  array_push($coursenames,$row["CourseName"]);
  array_push($foldernames,$row["FolderName"]);
}
?>
<h3>Upload Image</h3>
<form action="uploadimage.php" method="post" enctype="multipart/form-data">
    <p>Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"></p>
    <?php
    print("<select name='coursename' required>");
    for($i=0;$i<$rowcount;$i++)
    {
      $curcoursename=$coursenames[$i];
      $curfoldername=$foldernames[$i];
      print("<option value='$curfoldername'>$curcoursename</option>");
    }
    print("</select>");
    ?>
    <p><input type="submit" value="Upload Image" name="submit"></p>
</form>
<br>
<h3>Upload Text File</h3>
<form action="uploadtextfile.php" method="post" enctype="multipart/form-data">
    <p>Select text file to upload(pdf,doc,docx):
    <input type="file" name="fileToUpload" id="fileToUpload"></p>
    <?php
    print("<select name='coursename' required>");
    for($i=0;$i<$rowcount;$i++)
    {
      $curcoursename=$coursenames[$i];
      $curfoldername=$foldernames[$i];
      print("<option value='$curfoldername'>$curcoursename</option>");
    }
    print("</select>");
    ?>
    <p><input type="submit" value="Upload Text File" name="submit"></p>
</form>
</body>
</html>
