<?php
require("db.php");
require("adminauth.php");
for($i=0;$i<100;$i++)
{
  $val=$i+1;
  $query = "INSERT INTO Posts (TopicID,Username,PostText)"
  ."VALUES ('0', 'cjcuser', 'Post Number $val')";
  $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
}
print("<p>Done</p>");
 ?>
