<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automate Attendance</title>
</head>

<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once("Class/DB.class.php");
require_once("Class/Student.class.php");
require_once("Shared.php");
//echo $_SERVER['SCRIPT_FILENAME'];
$Cur_Meeting = isset($_SESSION['CUR_MEETING'])?$_SESSION['CUR_MEETING']:NULL;
if (!isset($_SESSION['is_auth'])  || !$_SESSION['is_auth']) {
    PrintMessage("Not Authorized In " . $Cur_Meeting,"Danger");
    exit(0);

}

//echo $Cur_Meeting;

if (isset($_COOKIE["$Cur_Meeting"])) {
    PrintMessage("Aleady Attended For Meeting : " . $Cur_Meeting,"Danger");
    exit(0);
}

if (isset($_POST['add_attendance'])) {
    $student_name = $_POST['student_name'];
    $student_id = $_POST['student_id'];
    $student = new Student();
    $CheckError = $student->AddAttendance($student_name, $student_id, $_SESSION['MeetingID'], date("Y-m-d H:i:s"));
    if (!$CheckError) {
        setcookie($Cur_Meeting, 1, time() + 2 * 60 * 60);
        $_SESSION['done_attendance'] = 1;
        header("Location:index.php");
    } else {
        echo "Something went wrong, please try again";
    }
}
?>

<body>

<h1 style="text-align:center"> You Are Now Attending : <span style="color:aquamarine"><?php echo $Cur_Meeting ?></span></h1>

    <div class="col-6 mx-auto my-auto align-items-center">
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Your Name</label>
                <input required type="text" name="student_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Your ID</label>
                <input required type="number" name="student_id" class="form-control" id="exampleInputtext1">
            </div>
            <button type="submit" class="btn btn-primary" name="add_attendance">Attend</button>
        </form>
    </div>
</body>

</html>
