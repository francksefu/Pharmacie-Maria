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

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php'; ?>
    <script defer src="./jsfile/takeClient.js"></script>
    <link rel="stylesheet" href="index.css">
</head>

<body class="bg-light">

    <main>
    
        <div class="container bg-transparent pt-5">
            <div class=" p-3 mb-5 border border-1 rounded mt-5" id="sa">
                <h2 class="p-2">Add clients</h2>
                <hr class="w-auto">
                <div class="ps-1 pe-1 pt-3 pb-3">
                <input required type="hidden" value="n" id="identifiantM" class="form-control w-50" placeholder="entrer identifiant" aria-label="Username" aria-describedby="nom" >
                    
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <div class="input-group ">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="nom">Nom du client*</span>
                                    <input type="text"  name="nom" id="nomPersonnel" class="form-control" placeholder="Entrer nom du client" aria-label="Username" aria-describedby="nom" >
                                </div>
                            </div>
                            <small id="nomVide"></small>
                        </div>

                        <div class="col-md-7 mb-3">
                            <div class="input-group ">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="nom">Telephone*</span>
                                    <input type="text"  name="nom" id="telephone" class="form-control" placeholder="Entrer numero de telephone" aria-label="Username" aria-describedby="nom" >
                                </div>
                            </div>
                            <small id="telephoneVide"></small>
                        </div>

                         
                    </div>
                   
                    <p id="txtHint"></p>
                    <input type="hidden" value="add" id="typeFormulaire">
                    <button id='envoie' class="btn btn-primary p-3 fs-4 mt-4 w-25">Ajoutez</button>
                    <input type="hidden" id="titre" value="data-client">
                </div>    
                
            </div>
            
        </div>
    
    </main>

    <footer>
        <hr class="w-100">
        <p class="text-secondary text-center p-3">&copy; copyright franck</p>
    </footer>
    
</body>
</html>