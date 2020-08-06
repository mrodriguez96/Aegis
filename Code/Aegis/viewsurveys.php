<!--
Webpage Name:viewsurveys.php
Main Developer: CJ Conti
Primary Function: Job Coaches, Partner Company Employees and Admins can view the result of surveys.
-->
<?php
require("partnerauth.php");
require("sessionstart.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>View Goals</title>
</head>
<body>
<?php
include("header.php");
require("db.php");
?>
<h2>View Surveys</h2>
<?php
if(isset($_POST["ID"]))
{
  $ID=$_POST["ID"];
  $query = "DELETE FROM Surveys WHERE ID=$ID";
  $result = mysqli_query($conn,$query) or die ( mysqli_error());
}
include("pagenumber.php");
$query="SELECT * FROM Surveys";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
$numsurveys=mysqli_num_rows($result);
if($offset>$numsurveys)
{
  $offset=0;
  $page=1;
}
$username=$_SESSION["Username"];
$query="SELECT * FROM Surveys";
$query="";
if(isset($_GET["order"]))
{
  if($_GET["order"]=="O-N")
  {
    $query="SELECT * FROM Surveys ORDER BY ID ASC LIMIT 10 OFFSET $offset";
  }
  else if($_GET["order"]=="N-O")
  {
    $query="SELECT * FROM Surveys ORDER BY ID DESC LIMIT 10 OFFSET $offset";
  }
  else if($_GET["order"]=="A-Z")
  {
    $query="SELECT * FROM Surveys ORDER BY ParticipantName ASC LIMIT 10 OFFSET $offset";
  }
  else if($_GET["order"]=="Z-A")
  {
    $query="SELECT * FROM Surveys ORDER BY ParticipantName DESC LIMIT 10 OFFSET $offset";
  }
}
else
{
  $query="SELECT * FROM Surveys LIMIT 10 OFFSET $offset";
}
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
$rowon=1;
#Prints all course info
while($row=mysqli_fetch_assoc($result))
{
  $ID=$row["ID"];
  print("<table><tbody>");
  print("<tr><td> Survey: ".($rowon+$offset)."</td></tr>");
  print("<tr><td>Name of Parter who completed Survey: ".$row["PartnerName"]."</td></tr>");
  print("<tr><td>Name of Participant being Surveyed: ".$row["ParticipantName"]."</td></tr>");
  print("<tr><td>Satisfaction Rating (1-10): ".$row["Satisfaction"]."</td></tr>");
  print("<tr><td>Hardworking Rating(1-10): ".$row["HardWorking"]."</td></tr>");
  print("<tr><td>Focus Rating(1-10): ".$row["Focus"]."</td></tr>");
  print("<tr><td>Improvement Rating(1-10): ".$row["Improvement"]."</td></tr>");
  print("<tr><td>Positive Comments:<br>".$row["Positive"]."</td></tr>");
  print("<tr><td>Comments about where to Improve:<br>".$row["WhereToImprove"]."</td></tr>");
  print("<tr><td>Other Comments:<br>".$row["Other"]."</td></tr>");
  if(isset($_SESSION["Username"])&&isset($_SESSION["Usertype"])&&$_SESSION["Usertype"]=="Admin")
  {
    print("<form method='post'>");
    print("<tr><td>");
    print("<input type='hidden' name='ID' value='$ID'>");
    print("<button>Remove Survey</button>");
    print("</td></tr>");
    print("</form>");
  }
  print("</tbody></table>");
  print("<br>");
  $rowon+=1;
}
?>
<?php
$ratingcounts=array_fill(0, 10, 0);
for($i=0;$i<10;$i++)
{
  $nextrating=$i+1;
  $query="SELECT Satisfaction FROM Surveys WHERE Satisfaction='$nextrating'";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  $ratingcounts[$i]=mysqli_num_rows($result);
}
$dataPoints = array(
	array("y" => $ratingcounts[0], "label" => "1" ),
	array("y" => $ratingcounts[1], "label" => "2" ),
	array("y" => $ratingcounts[2], "label" => "3" ),
	array("y" => $ratingcounts[3], "label" => "4" ),
	array("y" => $ratingcounts[4], "label" => "5" ),
	array("y" => $ratingcounts[5], "label" => "6" ),
  array("y" => $ratingcounts[6], "label" => "7" ),
  array("y" => $ratingcounts[7], "label" => "8" ),
  array("y" => $ratingcounts[8], "label" => "9" ),
	array("y" => $ratingcounts[9], "label" => "10" )
);

$ratingcounts2=array_fill(0, 10, 0);
for($i=0;$i<10;$i++)
{
  $nextrating=$i+1;
  $query="SELECT HardWorking FROM Surveys WHERE Hardworking='$nextrating'";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  $ratingcounts2[$i]=mysqli_num_rows($result);
}
$dataPoints2 = array(
	array("y" => $ratingcounts2[0], "label" => "1" ),
	array("y" => $ratingcounts2[1], "label" => "2" ),
	array("y" => $ratingcounts2[2], "label" => "3" ),
	array("y" => $ratingcounts2[3], "label" => "4" ),
	array("y" => $ratingcounts2[4], "label" => "5" ),
	array("y" => $ratingcounts2[5], "label" => "6" ),
  array("y" => $ratingcounts2[6], "label" => "7" ),
  array("y" => $ratingcounts2[7], "label" => "8" ),
  array("y" => $ratingcounts2[8], "label" => "9" ),
	array("y" => $ratingcounts2[9], "label" => "10" )
);

$ratingcounts3=array_fill(0, 10, 0);
for($i=0;$i<10;$i++)
{
  $nextrating=$i+1;
  $query="SELECT Focus FROM Surveys WHERE Focus='$nextrating'";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  $ratingcounts3[$i]=mysqli_num_rows($result);
}
$dataPoints3 = array(
	array("y" => $ratingcounts3[0], "label" => "1" ),
	array("y" => $ratingcounts3[1], "label" => "2" ),
	array("y" => $ratingcounts3[2], "label" => "3" ),
	array("y" => $ratingcounts3[3], "label" => "4" ),
	array("y" => $ratingcounts3[4], "label" => "5" ),
	array("y" => $ratingcounts3[5], "label" => "6" ),
  array("y" => $ratingcounts3[6], "label" => "7" ),
  array("y" => $ratingcounts3[7], "label" => "8" ),
  array("y" => $ratingcounts3[8], "label" => "9" ),
	array("y" => $ratingcounts3[9], "label" => "10" )
);

$ratingcounts4=array_fill(0, 10, 0);
for($i=0;$i<10;$i++)
{
  $nextrating=$i+1;
  $query="SELECT Improvement FROM Surveys WHERE Improvement='$nextrating'";
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  $ratingcounts4[$i]=mysqli_num_rows($result);
}
$dataPoints4 = array(
	array("y" => $ratingcounts4[0], "label" => "1" ),
	array("y" => $ratingcounts4[1], "label" => "2" ),
	array("y" => $ratingcounts4[2], "label" => "3" ),
	array("y" => $ratingcounts4[3], "label" => "4" ),
	array("y" => $ratingcounts4[4], "label" => "5" ),
	array("y" => $ratingcounts4[5], "label" => "6" ),
  array("y" => $ratingcounts4[6], "label" => "7" ),
  array("y" => $ratingcounts4[7], "label" => "8" ),
  array("y" => $ratingcounts4[8], "label" => "9" ),
	array("y" => $ratingcounts4[9], "label" => "10" )
);
?>
<script>
window.onload = function()
{

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Satisfaction Rating"
	},
	axisY: {
		title: "Number of Times that rating occurred"
	},
	data: [{
		type: "column",
		//yValueFormatString: "#,##0.## tonnes",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Hardworking Rating"
	},
	axisY: {
		title: "Number of Times that rating occurred"
	},
	data: [{
		type: "column",
		//yValueFormatString: "#,##0.## tonnes",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
var chart3 = new CanvasJS.Chart("chartContainer3", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Focus Rating"
	},
	axisY: {
		title: "Number of Times that rating occurred"
	},
	data: [{
		type: "column",
		//yValueFormatString: "#,##0.## tonnes",
		dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
	}]
});
var chart4 = new CanvasJS.Chart("chartContainer4", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Improvement Rating"
	},
	axisY: {
		title: "Number of Times that rating occurred"
	},
	data: [{
		type: "column",
		//yValueFormatString: "#,##0.## tonnes",
		dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
chart2.render();
chart3.render();
chart4.render();

}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<br><br>
<div id="chartContainer2" style="height: 370px; width: 100%;"></div>
<br><br>
<div id="chartContainer3" style="height: 370px; width: 100%;"></div>
<br><br>
<div id="chartContainer4" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<form method="get">
<input type="hidden" name="order" value="O-N">
<button>Order by Oldest</button>
</form>
<form method="get">
<input type="hidden" name="order" value="N-O">
<button>Order by Newest</button>
</form>
<form method="get">
<input type="hidden" name="order" value="A-Z">
<button>Order by A to Z</button>
</form>
<form method="get">
<input type="hidden" name="order" value="Z-A">
<button>Order by Z to A</button>
</form>
<?php
showpages($page,$numsurveys);
?>
</body>
</html>
