<!--
Webpage Name:sessionstart.php
Main Developer: CJ Conti
Primary Function:Lets session variables be accessed.
-->
<?php
if(session_status()!=PHP_SESSION_ACTIVE)
{
  session_start();
}
?>

style.css
body
{
  background-color: #e2ffff;
  font: sans-serif;
}
table
{
  background-color:#3F96BE;
  border: black solid 1px;
}
td
{
  background-color:#3F96BE;
  border: black solid 1px;
}
.messagetable
{
  width:600px;
}
