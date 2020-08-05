<!--
Webpage Name:memberauth.php
Main Developer: CJ Conti
Primary Function:Used to check if a user is a participant, job coach or adminauth
and if not returns them to the home page.
-->
<?php
require("sessionstart.php");
//Requires user to be logged in and to have their usertype be participant, job coach or admin.
if(isset($_SESSION["Username"])&&isset($_SESSION["Usertype"])&&
($_SESSION["Usertype"]=="PartnerEmployee"||$_SESSION["Usertype"]=="Participant"||
$_SESSION["Usertype"]=="Jobcoach"||$_SESSION["Usertype"]=="Admin"))
{

}
else
{
  header("Location: index.php");
}
?>
