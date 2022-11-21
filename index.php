<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>CIC '22</title>
</head>

<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once("Class/DB.class.php");
require_once("Shared.php");
//echo $_SERVER['SCRIPT_FILENAME'];
$Cur_Meeting = Current_Meeting($meeting);
//$Cur_Meeting = "SUN_IS_2";
if (isset($_SESSION['done_attendance']) && $_SESSION['done_attendance']) {
    PrintMessage("Congrats, You're An Attendee Now :)","Green");
}
$_SESSION['done_attendance'] = 0;
if ($Cur_Meeting == -1) {
    PrintMessage("No Lab/Tutorial With Ahmed Arafat At This Time, Mtsthbl4","Danger");
    exit(0);
}
$_SESSION['is_auth'] = 0;
//$_SESSION['cnt'] = 0;
$_SESSION['CUR_MEETING'] = $Cur_Meeting;
$username = "arafat";
$MeetingData = GetCurmeetingData($Cur_Meeting);
$_SESSION['MeetingID'] = $MeetingData[0];
$Password = $MeetingData[1];
//echo $Password;
//echo $MeetingData[0];
//echo $Cur_Meeting;
//$Database = new DB();
//$Database->CheckDB_Connection();
$username_input = NULL;
$password_input = NULL;
if (isset($_POST['check_btn'])) {
    $username_input = $_POST['username'];
    $password_input = $_POST['password'];
    if ($username == $username_input && $password_input == $Password) {
        $_SESSION['is_auth'] = 1;
        header("Location:Attendance.php");
        exit(0);
    } else if ($username_input != $username) {
    PrintMessage("Username Is Wrong","Danger");
    } else if($password_input != $Password) PrintMessage("Password Is Wrong","Danger");
}
?>

<body>
    <h1 style="text-align:center;color:red">CIC '22 Attendance Automation</h1>
    <h2 style="text-align:center"><?php echo $Cur_Meeting ?></h2>
    <div class="col-6 mx-auto my-auto align-items-center">
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input required type="text" name="username" placeholder="Enter The Username" value="<?php echo $username_input ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input required type="password" placeholder="Enter The Password" value="<?php echo $password_input ?>"  name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary" name="check_btn">LogIn</button>
        </form>
    </div>
</body>

</html>
