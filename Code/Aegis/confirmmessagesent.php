<!--
Webpage Name:confirmmessagesent.php
Main Developer: CJ Conti
Primary Function:Used to confirm that a message is successfully sent to another user.
-->
<html>
<head>
<?php
include("db.php");
include("userauth.php");
include("header.php");
?>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $sender=sanitize($_SESSION["Username"],$conn);
  $receiver=sanitize($_POST["receiver"],$conn);
  $subject=sanitize($_POST["subject"],$conn);
  $message=sanitize($_POST["message"],$conn);
  $date=date("Y/m/d");
  $time=date("h:i:s");

  // Check connection
  if ($conn->connect_error)
  {
      die("Connection failed: " . $conn->connect_error);
  }
  $query=sprintf("INSERT INTO ReceivedMessages(Sender,Receiver,Subject,MessageText,MessageDate,MessageTime)
  VALUES('%s','%s','%s','%s','%s','%s')",
  $sender,$receiver,$subject,$message,$date,$time);
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

  print ("<p>Message sent</p>");
  print("<p><a href='sendmessage.php'>Send Another Message</a></p>");
  print("<p><a href='viewsentmessages.php'>View Sent Messages</a></p>");
  print("<p><a href='viewreceivedmessages.php'>View Received Messages</a></p>");

  $query=sprintf("INSERT INTO SentMessages(Sender,Receiver,Subject,MessageText,MessageDate,MessageTime)
  VALUES('%s','%s','%s','%s','%s','%s')",
  $sender,$receiver,$subject,$message,$date,$time);
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
}
function sanitize($text,$conn)
{
  $text=trim($text);
  $text=stripslashes($text);
  $text=htmlspecialchars($text);
  $text=mysqli_real_escape_string($conn,$text);
  return $text;
}
?>
</body>
</html>
