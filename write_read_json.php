<?php 
    function write () {
        $myfile = fopen("data.json", "w") or die("Unable to open file!");
        $txt = json_encode(array("Peter"=>35, "Ben"=>37, "Joe"=>43));
        fwrite($myfile, $txt);
        
        fclose($myfile);
    }
?>