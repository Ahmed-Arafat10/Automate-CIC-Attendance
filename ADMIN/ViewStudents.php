
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automate Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<?php
require_once("../Shared.php");
require_once("../Class/DB.class.php");
require_once("../Shared.php");

if (!isset($_SESSION['is_auth_admin'])  || !$_SESSION['is_auth_admin']) {
    PrintMessage("Not Authorized","Danger");
    exit(0);
}

$Cur_Meeting = Current_Meeting($meeting);
//$Cur_Meeting = "SUN_IS_2";
$_SESSION['CUR_MEETING'] = $Cur_Meeting;
$MeetingData = GetCurmeetingData($Cur_Meeting);
$MeetingID = $MeetingData[0];
$Password = $MeetingData[1];
$db = new DB();
//echo $Password;


if (isset($_POST['update_password'])) {
    $Connect = $db->GetCon();
    $Meeting_password = $_POST['Meeting_password'];
    $Update = "UPDATE `meetings` SET `Password` = ? WHERE `Meeting_Name` = ?";
    $Query = $Connect->prepare($Update);
    $Query->bind_param("ss", $Meeting_password, $Cur_Meeting);
    $CheckError = $Query->execute();
    if (!$CheckError) echo "Please Try Again";
    else PrintMessage("Done Updating The Password","Normal");
}

$Date = date("Y-m-d");
?>

<body>
<h1 style="text-align:center"> <span style="color:cadetblue"><?php echo $Cur_Meeting ?></span></h1>
<h2 style="text-align:center"><?php echo $Date ?></h2>

    <div class="col-6 mx-auto my-auto align-items-center">
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Meeting Name</label>
                <input required disabled type="text" name="Meeting_Code" class="form-control" value="<?php echo $Cur_Meeting; ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Meeting Password</label>
                <input required type="text" name="Meeting_password" class="form-control" value="<?php echo $Password ?>" id="exampleInputPassword1">
            </div>
            <button onclick="confirm('Are You Sure ??')" type="submit" class="btn btn-danger"  name="update_password">Update Password</button>
        </form>
    </div>

    <table class="table table-dark table-hover" style="text-align:center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Student Name</th>
                <th scope="col">Student ID</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $Connect = $db->GetCon();
            $Select = "SELECT * FROM `attendance` WHERE `Meeting_ID` = ? AND `Date` LIKE CONCAT('%',?,'%') ";
            $Query = $Connect->prepare($Select);
            $Date = date("Y-m-d");
            $Query->bind_param("is", $MeetingID,$Date);
            $CheckError = $Query->execute();
            $Result = $Query->get_result();
            $cnt = 1;
            foreach($Result as $StudentData):
                extract($StudentData);
            ?>

            <tr>
                <th scope="row"><?php echo $cnt++;?></th>
                <td><?php echo $Student_Name ?></td>
                <td><?php echo $Student_ID ?></td>
                <td><button onclick="window.location='UpdateStudent.php?Record_ID=<?php echo $ID ?>'" type="button" class="btn btn-outline-primary">Update</button></td>
                <td><button onclick="window.location='DeleteStudent.php?Record_ID=<?php echo $ID ?>'" type="button" class="btn btn-outline-danger">Delete</button></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
    </table>

</body>

</html>
