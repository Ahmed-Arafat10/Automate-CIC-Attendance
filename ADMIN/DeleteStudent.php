<?php
require_once("../Class/DB.class.php");
echo $_GET['Record_ID']."<br>";                      
if(isset($_GET['Record_ID']) && $_GET['Record_ID'] != NULL)
{
    $Record_ID = $_GET['Record_ID'];
    $db = new DB();
    $Connect = $db->GetCon();
    $Delete = "DELETE FROM `attendance` WHERE `ID` = ?";
    $Query = $Connect->prepare($Delete);
    $Query->bind_param("i", $Record_ID);
    $Check = $Query->execute();
    if($Check) header("location:ViewStudents.php");
    else echo "Something Went Wrong";
}
else
{
    echo "So Then ??";
    exit(0);
}

?>