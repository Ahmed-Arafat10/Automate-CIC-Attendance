<?php
require_once ("DB.class.php");

class Student
{
    private $db ;
    private $Connect;
    public function __construct()
    {
        $this->db = new DB();
        $this->Connect = $this->db->GetCon();
    }

    public function AddAttendance($name,$student_id,$meeing_id,$date)
    {
        $Insert = "INSERT INTO `attendance` VALUES(NULL,?,?,?,?,?)";
        $Query = $this->Connect->prepare($Insert);
        $IP_Add = $_SERVER['REMOTE_ADDR'];
        $Query->bind_param("siiss",$name,$student_id,$meeing_id,$date,$IP_Add);
        $CheckError = $Query->execute();
        return $CheckError ? 0 : 1;
    }
    public function GetStudentData($Record_ID)
    {
        $Select = "SELECT * FROM `attendance` WHERE `ID` = ? ";
        $Query = $this->Connect->prepare($Select);
        $Query->bind_param("i",$Record_ID);
        $CheckError = $Query->execute();
        $Result = $Query->get_result();
        $Fetch = $Result->fetch_assoc();
        return $Fetch;
    }
    public function EditAttendance($Record_ID,$student_name, $student_id)
    {
        $Update = "UPDATE `attendance` SET `Student_Name` = ? , `Student_ID` = ? WHERE `ID` = ? ";
        $Query = $this->Connect->prepare($Update);
        $Query->bind_param("sii",$student_name,$student_id,$Record_ID);
        $CheckError = $Query->execute();
        return $CheckError ? 0 : 1;
    }
}   
