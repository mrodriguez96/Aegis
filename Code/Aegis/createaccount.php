<!--
Webpage Name:createaccount.php
Main Developer: CJ Conti
Primary Function:People can create an account using this page.
-->
<?php
require("sessionstart.php");
include("db.php");
?>
<html>
<head>
<title>Create Account</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="removewatermark.js"></script>
</head>
<body>
<?php
include("header.php");
if(isset($_POST["username"]))
{
  #hashes password using md5 for security purposes
  $firstname=sanitize($_POST["firstname"],$conn);
  $middlename=sanitize($_POST["middlename"],$conn);
  $lastname=sanitize($_POST["lastname"],$conn);
  $street=sanitize($_POST["street"],$conn);
  $city=sanitize($_POST["city"],$conn);
  $state=sanitize($_POST["state"],$conn);
  $zipcode=sanitize($_POST["zipcode"],$conn);
  $username=sanitize($_POST["username"],$conn);
  $password=sanitize($_POST["password"],$conn);
  $hashedpassword=md5($password);

  #Gets number of accounts and all usernames
  $query="SELECT * FROM Accounts";
  $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
  $usernames=[];
  while($row=mysqli_fetch_assoc($result))
  {
    array_push($usernames,$row["Username"]);
  }
  $rowcount=mysqli_num_rows($result);

  #Checks if selected username is different from all other usernames
  $unique=true;
  for($i=0;$i<$rowcount;$i++)
  {
    if($username==$usernames[$i])
    {
      $unique=false;
      break;
    }
  }
  if($unique)
  {
    #Creates account with the previously entered info and usertype Basic.
    $nextID=0;
    $query="SELECT * FROM Accounts";
    $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
    $IDs=[];
    while($row=mysqli_fetch_assoc($result))
    {
      array_push($IDs,$row["ID"]);
    }
    $done=false;
    for($i=0;$i<65536;$i++)
    {
      $matching=false;
      for($j=0;$j<sizeof($IDs);$j++)
      {
        if($i==$IDs[$j])
        {
          $matching=true;
          break;
        }
      }
      if(!$matching)
      {
        $nextID=$i;
        break;
      }
    }
    $query=sprintf("INSERT INTO Accounts(ID,FirstName,MiddleName,LastName,Street,City,State,ZipCode,Username,Password,Usertype)
    VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
    $nextID,$firstname,$middlename,$lastname,$street,$city,$state,$zipcode,$username,$hashedpassword,'Basic');
    $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
    $_SESSION["Username"]=$username;
    $_SESSION["Usertype"]='Basic';
    header("Location: index.php");
  }
  else
  {
    print("<h3>The selected username is already taken. Use a different username.");
  }
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
<h2>Create Account</h2>
<form method="post">
<table><tbody>
<tr><td>First Name:</td><td><input name="firstname" required></td></tr>
<tr><td>Middle Name:</td><td><input name="middlename" required></td></tr>
<tr><td>Last Name:</td><td><input name="lastname" required></td></tr>
<tr><td>Street Address:</td><td><input name="street" required></td></tr>
<tr><td>City Address:</td><td><input name="city" required></td></tr>
<tr><td>State:</td><td><select name="state" required>
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District Of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select></td></tr>
<tr><td>Zip Code:</td><td><input name="zipcode" type="text" pattern="[0-9]*"></td></tr>
<tr><td>Username:</td><td><input name="username" required></td></tr>
<tr><td>Password:</td><td><input name="password" required></td></tr>
</tbody></table>
<p><button type="submit">Create Account</button></p>
<p><a href="login.php">Return to Login</a></p>
</form>
</body>
</html>
