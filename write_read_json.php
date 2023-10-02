<?php 
// elimine ce fichier , j ai changE d avis sur la facon de dupliquer les donnees
function write($data) {
    
    $jsonData = json_encode($data);
    
    if (file_put_contents('data.json', $jsonData)) {
        echo "Data written to JSON file successfully.";
    } else {
        echo "Failed to write data to JSON file.";
    }
    
}

function read() {
    $jsonData = file_get_contents('data.json');

    if ($jsonData !== false) {
        $data = json_decode($jsonData, true); // Use true for associative array, omit for object
        if ($data !== null) {
            echo "Data loaded from JSON file successfully.";
            print_r($data); // Output the PHP array
        } else {
            echo "Failed to decode JSON data.";
        }
    } else {
        echo "Failed to read JSON file.";
    }
}

?>