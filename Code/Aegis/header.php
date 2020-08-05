<!--
Webpage Name:header.php
Main Developer: CJ Conti
Primary Function:Contains links to other commonly used pages.
-->
<?php require("sessionstart.php");?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Header</title>
</head>
<body>
<h1>Aegis</h1>
<?php
//Only shows admin functions if usertype is admin
if(isset($_SESSION["Usertype"])&&$_SESSION["Usertype"]=="Admin")
{
  print("
  <table><tbody>
  <tr><h3>Admin Functions</h3></tr>
  <tr>
  <td><a href='approveaccount.php'>Approve Account</a></td>
  <td><a href='viewaccounts.php'>View Accounts</a></td>
  <td><a href='fileuploadform.php'>Upload File</a></td>
  <td><a href='addcourse.php'>Add Course</a></td>
  </tr></tbody></table>
    ");
  print("<br>");
}
else if(isset($_SESSION["Usertype"])&&$_SESSION["Usertype"]=="Banned")
{
  print("<h3>This account is currently banned</h3>");
  print("<p>This has been done at the discretion of the administrators, likely due to misuse of this account.</p>");
  print("<p>Your account has been banned from the website.</p>");
  print("<p>You will be unable to use it for many of the website's functions.</p>");
  print("<br>");
}
?>
<h3>User Functions</h3>
<table><tbody>
<tr>
<?php
if(isset($_SESSION["Username"]))
{
  print("<td colspan='7'><h3>General and Educational Functions</h3></td>");
}
else
{
  print("<td colspan='8'><h3>General and Educational Functions</h3></td>");
}
?>
</tr>
<tr>
<td><a href="index.php">Home</a></td>
<td><a href="addevent.php">Add Event</a></td>
<td><a href="viewevents.php">View Events</a></td>
<td><a href="addgoal.php">Add Goal</a></td>
<td><a href="viewgoals.php">View Goals</a></td>
<td><a href="viewcourses.php">View Courses</a></td>
<?php
if(isset($_SESSION["Username"]))
{
  print("<td><a href='logout.php'>Logout</a></td>");
}
else
{
  print("<td><a href='createaccount.php'>Create Account</a></td>");
  print("<td><a href='login.php'>Login</a></td>");
}
?>
</tr>
</tbody></table>
<br>
<table><tbody>
<tr>
<td colspan="4"><h3>Forum and Communication Features</h3></td>
<?php
if(isset($_SESSION["Username"])&&isset($_SESSION["Usertype"]))
{
  if($_SESSION["Usertype"]=="PartnerEmployee"||$_SESSION["Usertype"]=="Jobcoach"||$_SESSION["Usertype"]=="Admin")
  {
    print("<td colspan='2'><h3>Partner Surveys</h3></td>");
  }
}
?>
</tr>
<tr>
<td><a href="forum.php">View Forum</a></td>
<td><a href="viewsentmessages.php">View Sent Messages</a></td>
<td><a href="viewreceivedmessages.php">View Received Messages</a></td>
<td><a href="sendmessage.php">Send Message</a></td>
<?php
if(isset($_SESSION["Username"])&&isset($_SESSION["Usertype"]))
{
  if($_SESSION["Usertype"]=="PartnerEmployee"||$_SESSION["Usertype"]=="Jobcoach"||$_SESSION["Usertype"]=="Admin")
  {
    print("<td><a href='survey.php'>Fill out Survey</a></td>
    <td><a href='viewsurveys.php'>View Surveys</a></td>");
  }
}
?>
</tbody></table>
<?php
//Greets user by username if logged in. Otherwise, welcomes guest.
if(isset($_SESSION["Username"]))
{
  print("<h3>Hello ".$_SESSION["Username"].".</h3>");
  print("<p>Account Type: ".$_SESSION["Usertype"]."</p>");
}
else
{
  print("<h3>Hello Guest.</h3>");
  print("<h3>Log In to access all features.</h3>");
}
?>
</body>
</html>
