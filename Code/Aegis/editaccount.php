<!--
Webpage Name:editaccount.php
Main Developer: CJ Conti
Primary Function:Admins use this page to edit a specific account and set what type it is.
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
<h2>Edit Account</h2>
<p><a href='viewaccounts.php'>View Accounts</a></p>
<?php
#Updates account
if(isset($_POST["Usertype"]))
{
  $usertype=$_POST["Usertype"];
  $selecteduser=$_POST["Selecteduser"];
  $query="UPDATE Accounts SET Usertype='$usertype' WHERE Username='$selecteduser'";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  print("<p>".$selecteduser." set as ".$usertype);
}
#Gets info on a specific user.
if(isset($_GET["Username"]))
{
  $username=$_GET["Username"];
  $query="SELECT * FROM Accounts WHERE Username='$username'";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  while($row=mysqli_fetch_assoc($result))
  {
    $usertype=$row["Usertype"];
    if($usertype=="Admin")
    {
      print("<p>An admin account type cannot directly be edited.</p>");
    }
    else
    {
      print("<p>".$row["Username"]."</p>");
      print("<form method='post'>");
      print("<input type='hidden' name='Selecteduser' value='".$row["Username"]."'>");
      print("<select name='Usertype'>");
      print("
      <option value='Participant'>Participant</option>
      <option value='JobCoach'>Job Coach</option>
      <option value='PartnerEmployee'>PartnerEmployee</option>
      ");
      print("</select>");
      print("<p><button type='submit'>Update</button>");
      print("</form>");

      print("<p>Ban User</p>");
      print("<h3>Warning a user will be unable to access their account if they are banned</h3>");
      print("<h3>Be certain that you want to ban them before doing so</h3>");
      print("<form method='post'>");
      print("<input type='hidden' name='Selecteduser' value='".$row["Username"]."'>");
      print("<input type='hidden' name='Usertype' value='Banned'>");
      print("<p><button type='submit'>Ban ".$row["Username"]."</button>");
      print("</form>");
    }
  }
}
?>
</body>
</html>
