<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    <script defer src="navbar.js"></script>
   
    <link rel="stylesheet" href="index.css">
</head>
<?php 
$user = "";
session_start();
if(isset($_GET['deconnexion']))
{ 
   if($_GET['deconnexion']==true)
   {  
      session_destroy();
      header("location:index.php");
   }
}
else if($_SESSION['username'] !== ""){
    $user = $_SESSION['username'];
}
?>
<body class="bg-light">
    <?php 
        if($user == "") {
            echo "<h1> Vous ne pouvez pas voir cette page sans autorisation</h1><br>";
            echo "<h1> Vous ne pouvez pas voir cette page sans autorisation</h1><br>";
            echo "<h1> Vous ne pouvez pas voir cette page sans autorisation</h1><br>";
        } else {
    ?>
     <main>
        <div class="container bg-transparent pt-5">
            <div class="row bg-transparent pt-5">
                <div class="col-md-5 bg-transparent m-2">
                    <h2>Hi <?php echo $user; ?>, Good Morning</h2>
                    <p class=" text-secondary pt-3">
                        Votre dashboard vous donne une vues sur vos performances ou l evolution
                         de votre busness
                    </p>
                </div>
                <div class="col-md-3 bg-transparent border border-1 pt-3 pb-3 d-flex flex-row m-2 rounded-3">
                    <div class="p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                          </svg>
                    </div>
                    <div class="p-3">
                        <p class="">Total vendues</p>
                        <h2 class="">31</h2>
                        <a href='index.php?deconnexion=true' >Déconnexion</a>
                    </div>
                   
                </div>
                <div class="col-md-3 bg-transparent border border-1 pt-3 pb-3 d-flex flex-row m-2 rounded-3">
                    <div class="p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                            <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.501.501 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89L8 0ZM3.777 3h8.447L8 1 3.777 3ZM2 6v7h1V6H2Zm2 0v7h2.5V6H4Zm3.5 0v7h1V6h-1Zm2 0v7H12V6H9.5ZM13 6v7h1V6h-1Zm2-1V4H1v1h14Zm-.39 9H1.39l-.25 1h13.72l-.25-1Z"/>
                        </svg>
                    </div>
                    <div class="p-3">
                        <p class="">Total vendues</p>
                        <h2 class="">31</h2>
                    </div>
                    
                </div>
            </div>
    
            <div class=" p-3 mb-5 border border-1 rounded mt-5" id="sa">
                <h2 class="p-2">Top product</h2>
                <hr class="w-auto">
                <div class="d-flex flex-row ps-1 pe-1 pt-3 pb-3">
                    <div class=" border border-1 p-3 w-auto ms-2">
                        <img src="banane.png" alt="Product-1" class="img-fluid rounded-3">
                        <h3>Banenes</h3>
                        <p class="text-secondary">667 items</p>
                    </div>
                    <div class=" border border-1 p-3 w-auto ms-2">
                        <img src="banane.png" alt="Product-1" class="img-fluid rounded-3">
                        <h3>Banenes</h3>
                        <p class="text-secondary">667 items</p>
                    </div>
                    <div class=" border border-1 p-3 w-auto ms-2">
                        <img src="banane.png" alt="Product-1" class="img-fluid rounded-3">
                        <h3>Banenes</h3>
                        <p class="text-secondary">667 items</p>
                    </div>
    
                    <div class=" border border-1 p-3 w-auto ms-2">
                        <img src="banane.png" alt="Product-1" class="img-fluid rounded-3">
                        <h3>Banenes</h3>
                        <p class="text-secondary">667 items</p>
                    </div>
                </div>
            </div>
            
        </div>
     </main>

    

    <footer>
        <hr class="w-100">
        <p class="text-secondary text-center p-3">&copy; copyright Maria</p>
    </footer>
    <?php } ?>
    <!--<script  src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>-->
</body>
</html>