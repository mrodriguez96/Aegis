<!--
Webpage Name:sendmessage.php
Main Developer: CJ Conti
Primary Function:This page is when a user sends a message.
-->
<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id='content'>
<?php
require("userauth.php");
include("header.php");
?>
<form action="confirmmessagesent.php" method="post">
<p>Receiver:<input type="text" name="receiver"></p>
<p>Subject:<input type="text" name="subject"></p>
<p>Message</p>
<p><textarea rows="15" cols="60" name="message" placeholder="Write your message here."></textarea></p>
<p><button class='submitbutton' type="submit">Send</button></p>
</form>
</div>
</body>
</html>
