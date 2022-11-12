<?php

$Admin = "nen";
$Pass = "Zodiac123";

if(isset($_POST['add_attendance']))
{
    $student_name = $_POST['student_name'];
    $student_password = $_POST['student_id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form method="post">
<label for="">username</label>
<input type="text" name="student_name">
<input type="password" name="student_id">
<input type="submit" value="" name="add_attendance">
</form>
</body>
</html>