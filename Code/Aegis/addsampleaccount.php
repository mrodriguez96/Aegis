<?php
require("db.php");
require("adminauth.php");
for($i=0;$i<25;$i++)
{
  $val=$i+7;
  $query = "INSERT INTO Accounts (ID,FirstName,MiddleName,LastName,Street,City,State,ZipCode,Username,Password,Usertype)"
  ."VALUES ($val,'TestBan','TestBan','TestBan','Ban Street','Ban City','NJ','66666','banuser$i','password','Basic')";
  $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
}
print("<p>Done</p>");
 ?>
