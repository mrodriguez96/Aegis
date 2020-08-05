<!--
Webpage Name:deletegoal.php
Main Developer: CJ Conti
Primary Function:Lets a user delete a specific message
-->
<?php
$servername = "localhost";
$username = "cjcuser";
$password = "computing";
$dbname = "SocialNetwork";
require("userauth.php");

// Create connection
include("db.php");
include("header.php");
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['ID']))
{
  $ID=$_POST['ID'];
  $query = "DELETE FROM ReceivedMessages WHERE ID=$ID";
  $result = mysqli_query($conn,$query) or die ( mysqli_error());
  header("Location: viewreceivedmessages.php");
}
?>
