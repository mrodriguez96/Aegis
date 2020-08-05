<!--
Webpage Name:partnerauth.php
Main Developer: CJ Conti
Primary Function:Used to check if a user is an admin, partner employee, or job coach and if not returns them to the home page.
-->
<?php
require("sessionstart.php");
//Requires user to be logged in and to have their usertype be admin
if(isset($_SESSION["Username"])&&isset($_SESSION["Usertype"])&&
($_SESSION["Usertype"]=="PartnerEmployee")||($_SESSION["Usertype"]=="Jobcoach")||($_SESSION["Usertype"]=="Admin"))
{

}
else
{
  header("Location: index.php");
}
?>
