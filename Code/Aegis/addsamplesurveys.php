<?php
require("db.php");
require("adminauth.php");
for($i=0;$i<100;$i++)
{
  $satisfaction=rand(1,10);
  $hardworking=rand(1,10);
  $focus=rand(1,10);
  $improvement=rand(1,10);
  $query="INSERT INTO Surveys(PartnerName,ParticipantName,Satisfaction,HardWorking,Focus,Improvement,Positive,WhereToImprove,Other)"
  ."VALUES('Sample Partner','Sample Participant',$satisfaction,$hardworking,$focus,$improvement,'Positive','WhereToImprove','Other')";
  $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
}
print("<p>Done</p>");
 ?>
