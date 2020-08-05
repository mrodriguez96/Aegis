<!--
Webpage Name:login.php
Main Developer: CJ Conti
Primary Function:Lets users log into their accounts.
-->
<?php
require("sessionstart.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="removewatermark.js"></script>
<title>Open Captioning Login</title>
</head>
<body>
<?php
include("header.php");
require("db.php");
if(isset($_POST["Username"])&&isset($_POST["Password"]))
{
  #Gets username and password
  $username=$_POST["Username"];
  $password=$_POST["Password"];
  $hashedpassword=md5($password);

  #Checks if username and password match with a specific username and password
  $query=sprintf("SELECT * FROM Accounts WHERE Username='%s'",$username);
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  $userexists=false;
  $rows = mysqli_num_rows($result);
  #Sets username and password session variables if there is a match
  if($rows==1)
  {
    $userexists=true;
  }
  #Checks if username and password match with a specific username and password
  $query=sprintf("SELECT * FROM Accounts WHERE Username='%s' AND Password='%s'",$username,$hashedpassword);
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  $usertype="";
  while($row=mysqli_fetch_assoc($result))
  {
    $usertype=$row["Usertype"];
  }
  $rows = mysqli_num_rows($result);
  #Sets username and password session variables if there is a match
  if($rows==1)
  {
    $_SESSION["Username"]=$username;
    $_SESSION["Password"]=$password;
    $_SESSION["Usertype"]=$usertype;
    header("Location: index.php");
  }
  else if($userexists)
  {
    print("<p>Incorrect Password</p>");
  }
  else
  {
    print("<p>Incorrect Username</p>");
  }
}
function sanitize($text)
{
  $text=trim($text);
  $text=stripslashes($text);
  $text=htmlspecialchars($text);
  return $text;
}
?>
<h2>Login</h2>
<form method="post">
<p>Username:<input name="Username" type="text"></p>
<p>Password:<input name="Password" type="password"></p>
<p><button onclick="submit">Log In</button></p>
<p><a href="createaccount.php">Create Account</a></p>
</form>
</body>
</html>
