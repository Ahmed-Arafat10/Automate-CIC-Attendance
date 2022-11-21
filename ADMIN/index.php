<?php
require_once("../Shared.php");
require_once(".Pass.php");
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$Cur_Meeting = Current_Meeting($meeting);
//$Cur_Meeting = "SUN_IS_2";
$_SESSION['CUR_MEETING'] = $Cur_Meeting;

$MeetingData = GetCurmeetingData($Cur_Meeting);


if (isset($_SESSION['is_auth_admin'])  && $_SESSION['is_auth_admin']) {
    header("Location:ViewStudents.php");
    exit(0);
}

if (isset($_POST['login_adimn_btn'])) {
    $admin_name_input = $_POST['admin_name'];
    $admin_pass_input = $_POST['admin_password'];
    if ($admin_name_input == $AdminName && $admin_pass_input == $Password) {
        $_SESSION['is_auth_admin'] = 1;
        header("location:ViewStudents.php");
        exit(0);
    } else if($admin_name_input != $AdminName) echo PrintMessage("Admin Name Is Wrong", "Danger");
      else if ($admin_pass_input != $Password) echo PrintMessage("Password Is Wrong", "Danger");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<body>
    <h1 style="text-align:center"><?php echo $Cur_Meeting ?></h1>
    <div class="col-6 mx-auto my-auto align-items-center">
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Admin Name</label>
                <input required type="text" name="admin_name" placeholder="Your Name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input required type="password" name="admin_password" placeholder="Your Password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary" name="login_adimn_btn">LogIn</button>
        </form>
    </div>
</body>

</html>
