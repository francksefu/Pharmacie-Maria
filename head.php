<?php 
echo '<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestion</title>
<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.css">
<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap-grid.css">
<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap-grid.rtl.css">
<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap-reboot.css">
<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap-reboot.rtl.css">
<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap-utilities.css">
<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap-utilities.rtl.css">
<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap-utilities.rtl.min.css">
<script defer src="bootstrap-5.0.2-dist/js/bootstrap.js"></script>
<script defer src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
<script defer src="bootstrap-5.0.2-dist/js/bootstrap.esm.js"></script>
<script defer src="bootstrap-5.0.2-dist/js/bootstrap.esm.min.js"></script>
<script defer  src="bootstrap-5.0.2-dist/js/bootstrap.bundle.js"></script>
';

switch ($user) {
    case "Approvisionneur" :
      echo '<script defer src="navbarApprov.js"></script>';
    break;

    case "Responsable" :
        echo '<script defer src="navbarResp.js"></script>';
    break;
    
    case "Commercial" :
        echo '<script defer src="navbarVente.js"></script>';
    break;

    case "franck" :
        echo '<script defer src="navbar.js"></script>';
    break;

    case "Administrateur" :
        echo '<script defer src="navbar.js"></script>';
    break;

    
    
}
?>