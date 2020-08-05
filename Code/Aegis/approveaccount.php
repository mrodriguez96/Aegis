<!--
Webpage Name:approveaccount.php
Main Developer: CJ Conti
Primary Function:Admins use this page to approve accounts and set what type they are.
-->
<?php
require("adminauth.php");
require("sessionstart.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Approve Account</title>
</head>
<body>
<?php
include("header.php");
require("db.php");
?>
<h2>Approve Accounts</h2>
<p>Note: In order to approve an account to be an admin account, you need to do so directly througb the server controls.</p>
<?php
#Updates the user type of the selected user
if(isset($_POST["Usertype"]))
{
  $usertype=$_POST["Usertype"];
  $selecteduser=$_POST["Selecteduser"];
  $query="UPDATE Accounts SET Usertype='$usertype' WHERE Username='$selecteduser'";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  print("<p>".$selecteduser." set as ".$usertype);
}
#Gets all users who are basic, which is the default user type
$query="SELECT * FROM Accounts WHERE Usertype='Basic'";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
while($row=mysqli_fetch_assoc($result))
{
  print("<form method='post'>");
  print("<p>".$row["Username"]."</p>");
  print("<input type='hidden' name='Selecteduser' value='".$row["Username"]."'>");
  print("<select name='Usertype'>");
  print("
  <option value='Participant'>Participant</option>
  <option value='JobCoach'>Job Coach</option>
  <option value='PartnerEmployee'>PartnerEmployee</option>
  ");
  print("</select>");
  print("<p><button type='submit'>Submit</button>");
  print("</form>");
}
?>
</body>
</html>
