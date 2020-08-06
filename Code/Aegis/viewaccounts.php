<!--
Webpage Name:viewaccounts.php
Main Developer: CJ Conti
Primary Function:Admins use this page to view all accounts and then
edit or delete a specific account.
-->
<?php
require("adminauth.php");
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
<h2>View Accounts</h2>
<?php
include("pagenumber.php");
if(isset($_POST["Usertype"]))
{
  $usertype=$_POST["Usertype"];
  $selecteduser=$_POST["Selecteduser"];
  $query="UPDATE Accounts SET Usertype='$usertype' WHERE Username='$selecteduser'";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  print("<p>".$selecteduser." set as ".$usertype);
}
$query="SELECT * FROM Accounts";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
$accounts=mysqli_num_rows($result);
if($offset>$accounts)
{
  $page=1;
  $offset=0;
}
$query="SELECT * FROM Accounts LIMIT 10 OFFSET $offset";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
while($row=mysqli_fetch_assoc($result))
{
  $username=$row["Username"];
  print("<table><tbody>");
  print("<tr><td> User: ".$username."</td></tr>");
  print("<tr><td> Usertype:".$row["Usertype"]." </td></tr>");
  print("<tr><td>");
  print("<form method='get' action='editaccount.php'>");
  print("<input type='hidden' name='Username' value='$username'>");
  print("<button>Edit</button>");
  print("</form>");
  print("</td></tr>");
  print("<tr><td>Ban User</td><tr>");
  print("<tr><td>");
  print("<form method='post'>");
  print("<input type='hidden' name='Selecteduser' value='".$row["Username"]."'>");
  print("<input type='hidden' name='Usertype' value='Banned'>");
  print("<button type='submit'>Ban ".$row["Username"]."</button>");
  print("</form>");
  print("</td></tr>");
  print("</tbody></table>");
  print("<br>");
}
showpages($page,$accounts);
?>
</body>
</html>
