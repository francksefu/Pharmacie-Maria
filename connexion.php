<?php
    $db_username= 'root';
    $db_password= '';
    $db_name= 'pharmacie';
    $db_host= 'localhost';

    $db= mysqli_connect ($db_host, $db_username, $db_password, $db_name )
    or die('Ne peux pas se connecter a la base de donnee');
?>