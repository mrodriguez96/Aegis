<!--
Webpage Name:survey.php
Main Developer: CJ Conti
Primary Function:TThis page is used by partner company employees, job coaches and admins to provide feedback
on participants.
-->
<?php
require("sessionstart.php");
require("partnerauth.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Aegis Home Page</title>
</head>
<body>
<?php
require("db.php");
include("header.php");
?>
<h2>Survey</h2>
<p>This survey is for reviewing a participant's progress.</p>
<p>*=required</p>
<form method='post' action='surveycomplete.php'>
<p>Your Name:* <input name="partnername" required></p>
<p>Name of participant:* <input name='participantname' required></p>
<p>How satisfied are you with the participant?*</p>
<p>
<select name='satisfaction' required>
  <option value='10'>10 Completely Satisfied</option>
  <option value='9'>9</option>
  <option value='8'>8</option>
  <option value='7'>7</option>
  <option value='6'>6</option>
  <option value='5'>5 Somewhat Content</option>
  <option value='4'>4</option>
  <option value='3'>3</option>
  <option value='2'>2</option>
  <option value='1'>1 Completely Unsatisfied</option>
</select>
</p>
<p>How hard working is the participant?*</p>
<p>
<select name='hardworking' required>
  <option value='10'>10 Extremely Hard Working</option>
  <option value='9'>9</option>
  <option value='8'>8</option>
  <option value='7'>7</option>
  <option value='6'>6</option>
  <option value='5'>5 Somewhat Hard Working</option>
  <option value='4'>4</option>
  <option value='3'>3</option>
  <option value='2'>2</option>
  <option value='1'>1 Not Hard Working</option>
</select>
</p>
<p>How focused is the participant?*</p>
<p>
<select name='focus' required>
  <option value='10'>10 Extremely Focused</option>
  <option value='9'>9</option>
  <option value='8'>8</option>
  <option value='7'>7</option>
  <option value='6'>6</option>
  <option value='5'>5 Somewhat Focused</option>
  <option value='4'>4</option>
  <option value='3'>3</option>
  <option value='2'>2</option>
  <option value='1'>1 Not Focused</option>
</select>
</p>
<p>How much has the participant improved?*</p>
<p>
<select name='improvement' required>
  <option value='10'>10 Incredible Improvement</option>
  <option value='9'>9</option>
  <option value='8'>8</option>
  <option value='7'>7</option>
  <option value='6'>6</option>
  <option value='5'>5 Some Improvement</option>
  <option value='4'>4</option>
  <option value='3'>3</option>
  <option value='2'>2</option>
  <option value='1'>1 No Improvement</option>
</select>
</p>
<p>What do you like about the participant and how they work?*</p>
<p><textarea name='positive' rows='10' cols='50' required></textarea></p>
<p>Where do you feel the participant can improve?*</p>
<p><textarea name='wheretoimprove' rows='10' cols='50' required></textarea></p>
<p>Write any other comments you have</p>
<p><textarea name='other' rows='10' cols='50'></textarea></p>
<p><button type='submit'>Submit</button></p>
</form>
</body>
</html>
