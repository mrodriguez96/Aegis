<!--
Webpage Name:userauth.php
Main Developer: CJ Conti
Primary Function:Used to check if a user is logged in
and if not returns them to the home page.
-->
<?php
require("sessionstart.php");
//Requires user to be logged in and to have their usertype be participant, job coach or admin.
if(isset($_SESSION["Username"])&&isset($_SESSION["Usertype"])&&
($_SESSION["Usertype"]!="Banned"))
{

}
else
{
  header("Location: index.php");
}
?>
