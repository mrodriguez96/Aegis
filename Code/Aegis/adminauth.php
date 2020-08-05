<!--
Webpage Name:adminauth.php
Main Developer: CJ Conti
Primary Function:Used to check if a user is an admin and if not returns them to the home page.
-->
<?php
require("sessionstart.php");
//Requires user to be logged in and to have their usertype be admin
if(isset($_SESSION["Username"])&&isset($_SESSION["Usertype"])&&$_SESSION["Usertype"]=="Admin")
{

}
else
{
  header("Location: index.php");
}
?>
