<!--
Webpage Name:viewsentmessages.php
Main Developer: CJ Conti
Primary Function:This page is used to let a user view messages they have sent.
-->
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div id="content">
  <?php
  require("userauth.php");
  include("header.php");
  ?>
  <?php
  $sender=$_SESSION['Username'];
  include("db.php");
  require("pagenumber.php");
  $query="SELECT * FROM `SentMessages` WHERE Sender='$sender'";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  $nummessages=mysqli_num_rows($result);
  if($offset>$nummessages)
  {
    $offset=0;
    $page=1;
  }
  $sel_query = "SELECT * FROM `SentMessages` WHERE Sender='$sender' ORDER BY ID DESC LIMIT 10 OFFSET $offset";
  $result = mysqli_query($conn,$sel_query);
  $index=0;
  while($row = mysqli_fetch_assoc($result))
  {
    print("<table class='messagetable'><tbody>");
    print("<tr><td>Message ".($index+1)."</td></tr><tr><td>Subject:".$row['Subject']."</td></tr>");
    print("<tr><td>To: ".$row['Receiver']." at ".$row['MessageDate']." ".$row['MessageTime']."</td></tr>");
    print("<tr><td>".$row['MessageText']."</td></tr>");
    print("<tr><td><form action='deletesentmessage.php' method='post'>");
    print("<button class='submitbutton' name='ID' style='width:100%; height:100%;' value=".$row['ID'].">Delete</button>");
    print("</form></td></tr>");
    print("</tbody></table>");
    print("<br><br><br>");
    $index++;
  }
  showpages($page,$nummessages);
  ?>
</div>
</body>
</html>
