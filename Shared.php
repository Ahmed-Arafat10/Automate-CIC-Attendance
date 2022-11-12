<?php
date_default_timezone_set("Africa/Cairo");
session_start();
$meeting = array(
    "SUN_PROG3_8",
    "SUN_IS_10_12",
    "SUN_IS_12_2",
    "SUN_IS_2_2",
    "MON_OS2_10",
    "MON_IS_12",
    "MON_STRAT_2",
    "TUE_STRAT_8",
    "TUE_DB2_12",
    "WEN_STRAT_2",
    "FRI_STRAT_10"
);

function Current_Meeting($meeting)
{
    $d = date("D");
    $d = strtoupper($d);
    $h = date("g");
    $am_pm = date("a");
    //echo $d . $h . $am_pm;
    for ($i = 0; $i < count($meeting); $i++) {
        $cur_meeting = explode("_", $meeting[$i]);
        $cur_dat = $cur_meeting[0];
        $start_h = $cur_meeting[2];
        $end_h = ($start_h + 2);
        if ($end_h > 12) $end_h = $end_h % 12;
        //echo $end_h . "<br>";
        $cur_ampm = "am";
        if ($start_h >= "12") $cur_ampm = "pm";
        //echo $cur_ampm;
        if ($d == $cur_dat && $h >= $start_h && $h <= $end_h && $cur_ampm == $am_pm) return $meeting[$i];
    }
    return -1;
}
require_once("Class/DB.class.php");
function GetCurmeetingData($Cur_Meeting)
{
    $res = array();
    $db = new DB();
    $Connect = $db->GetCon();
    $Select = "SELECT `Password`,`ID` from `meetings` WHERE `Meeting_Name` = ?";
    $Query = $Connect->prepare($Select);
    $Query->bind_param("s", $Cur_Meeting);
    $Query->execute();
    $Reslut = $Query->get_result();
    $Fetch = $Reslut->fetch_assoc();
    $res[] = $Fetch['ID'];
    $res[] = $Fetch['Password'];
    return $res;
}

function PrintMessage($text, $Type)
{
    if ($Type == "Danger") echo '<div style="text-align:center;margin:0" class="alert alert-danger alert-dismissible fade show" role="alert">
    ' . $text . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    else if ($Type == "Normal") echo '<div style="text-align:center;margin:0" class="alert alert-primary alert-dismissible fade show" role="alert">
    ' . $text . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    else if ($Type == "Green")  echo '<div style="text-align:center;margin:0" class="alert alert-success alert-dismissible fade show" role="alert">
    ' . $text . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

