<!--
Webpage Name:auth.php
Main Developer: CJ Conti
Primary Function:Used to check if a user is logged in and if not returns them to the home page.
-->
<?php
require("sessionstart.php");
if(!isset($_SESSION["Username"]))
{
  header("Location: index.php");
}
?>
