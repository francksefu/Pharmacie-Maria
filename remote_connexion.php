<?php
    /*$db_username= 'id21454035_franck';
    $db_password= 'kalunga1998@F';
    $db_name= 'id21454035_pharmaciemaria';
    $db_host= 'localhost';

    $db= mysqli_connect ($db_host, $db_username, $db_password, $db_name )
    or die('Ne peux pas se connecter a la base de donnee');*/
    $db_username= 'root';
    $db_password= '';
    $db_name= 'pharmcie_test_remote';
    $db_host= 'localhost';

    $db= mysqli_connect ($db_host, $db_username, $db_password, $db_name )
    or die('Ne peux pas se connecter a la base de donnee');

?>