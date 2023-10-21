<?php 
function write ($insert_arr, $update_arr, $delete_arr, $datajson) {
    $myfile = fopen($datajson, "w") or die("Unable to open file!");
    $txt = json_encode(array("insert_arr"=>$insert_arr, "update_arr"=>$update_arr, "delete_arr"=>$delete_arr));
    fwrite($myfile, $txt);
    fclose($myfile);
}

function read(&$insert_arr, &$update_arr, &$delete_arr, $datajson) {
    $myfile = fopen($datajson, "r") or die("Unable to open file!");
    $big_arrjs = fread($myfile,filesize($datajson));
    $big_arr = json_decode($big_arrjs, true);
    if ($big_arrjs) {
        $insert_arr = $big_arr['insert_arr'];
        $update_arr = $big_arr['update_arr'];
        $delete_arr = $big_arr['delete_arr'];
    } else {
        $insert_arr = array();
        $update_arr =  array();
        $delete_arr = array();
    }
    
    fclose($myfile);
}
?>