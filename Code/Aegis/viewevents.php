<!--
Webpage Name:viewevents.php
Main Developer: CJ Conti
Primary Function: Users use this page to view and edit their events.
-->
<?php
require("memberauth.php");
require("sessionstart.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>View Accounts</title>
</head>
<body>
<?php
include("header.php");
require("db.php");
?>
<h2>View Events</h2>
<?php
require("pagenumber.php");
$username=$_SESSION["Username"];
$query=sprintf("SELECT * FROM Events WHERE Username='$username'");
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
$numevents=mysqli_num_rows($result);
if($offset>$numevents)
{
  $offset=0;
  $page=1;
}
$query="";
if(isset($_GET["order"]))
{
  if($_GET["order"]=="O-N")
  {
    $query="SELECT * FROM Events WHERE Username='$username' ORDER BY EventDate ASC, EeventTime ASC LIMIT 10 OFFSET $offset";
  }
  else if($_GET["order"]=="N-O")
  {
    $query="SELECT * FROM Events WHERE Username='$username' ORDER BY EventDate DESC, EventTime DESC LIMIT 10 OFFSET $offset";
  }
  else if($_GET["order"]=="A-Z")
  {
    $query="SELECT * FROM Events WHERE Username='$username' ORDER BY Name ASC LIMIT 10 OFFSET $offset";
  }
  else if($_GET["order"]=="Z-A")
  {
    $query="SELECT * FROM Events WHERE Username='$username' ORDER BY Name DESC LIMIT 10 OFFSET $offset";
  }
}
else
{
  $query="SELECT * FROM Events WHERE Username='$username' ORDER BY EventDate ASC LIMIT 10 OFFSET $offset";
}
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
while($row=mysqli_fetch_assoc($result))
{
  $ID=$row["ID"];
  $eventdate=$row["EventDate"];
  $date=new DateTime($eventdate);
  $currentdate=date("Y-m-d");
  $repeatrate=$row["RepeatRate"];
  $repeatcount=$row["RepeatCount"];
  $diff =(strtotime($currentdate) - strtotime($eventdate));
  $years = floor($diff / (365*60*60*24));
  $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
  $daydiff=floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
  $printeddate=date_format($date,"Y-m-d");
  while($daydiff>$repeatrate)
  {
    date_add($date, date_interval_create_from_date_string($repeatrate.' days'));
    $printeddate=date_format($date,"Y-m-d");
    $daydiff-=$repeatrate;
    $repeatcount-=1;
    if($repeatcount<0)
    {
      break;
    }
  }
  $eventdate=$printeddate;
  print("<table><tbody>");
  print("<tr><td> Username: ".$row["Username"]."</td></tr>");
  print("<tr><td> Name:".$row["Name"]." </td></tr>");
  print("<tr><td> EventDate: ".$row["EventDate"]."</td></tr>");
  print("<tr><td> EventTIme:".$row["EventTime"]." </td></tr>");
  print("<tr><td> RepeatRate: ");
  if($repeatrate==0)
  {
    print("Never");
  }
  else if($repeatrate==1)
  {
    print("Daily");
  }
  else if($repeatrate==7)
  {
    print("Weekly");
  }
  else if($repeatrate==14)
  {
    print("Every Two Weeks");
  }
  else if($repeatrate==28)
  {
    print("Every Four Weeks");
  }
  print(" </td></tr>");
  print("<tr><td> RepeatCount: ");
  if($repeatcount==-1)
  {
    print("Finished");
  }
  else if($repeatcount==0)
  {
    print("Never");
  }
  else
  {
    print($repeatcount);
  }
  print(" </td></tr>");
  print("<tr><td>");
  print("<form method='get' action='editevent.php'>");
  print("<input type='hidden' name='ID' value='$ID'>");
  print("<button>Edit Event</button>");
  print("</form>");
  print("</td></tr>");
  print("<tr><td>");
  print("<form method='get' action='deleteevent.php'>");
  print("<input type='hidden' name='ID' value='$ID'>");
  print("<button>Delete Event</button>");
  print("</form>");
  print("</td></tr>");
  $nextdate=$eventdate;
  for($i=0;$i<$repeatcount;$i++)
  {
    $nextdate=date('Y-m-d', strtotime($nextdate.' +'. $repeatrate.' days'));
    print("<tr><td>");
    print("Repeats on ".$nextdate);
    print("</td></tr>");
  }
  print("</tbody></table>");
  print("<br>");
}
print("<p><a href='addevent.php'>Add Event</a></p>");
?>
<form method="get">
<input type="hidden" name="order" value="O-N">
<button>Order Events by Oldest First</button>
</form>
<form method="get">
<input type="hidden" name="order" value="N-O">
<button>Order Events by Newest First</button>
</form>
<form method="get">
<input type="hidden" name="order" value="A-Z">
<button>Order Events by A to Z</button>
</form>
<form method="get">
<input type="hidden" name="order" value="Z-A">
<button>Order Events by Z to A</button>
</form>
<?php
showpages($page,$numevents);
?>
</body>
</html>
