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
    <script defer src="./jsfile/datalist.js"></script>
    <style> img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] { display: none;} 
    </style>
</head>
<?php
  
?>
<body class="back">

    <main>
    
        <div class="container bg-transparent pt-5">
            <div class=" p-3 mb-5 border border-1 rounded mt-5" id="sa">
                <h2 class="p-2">Modifier du clients</h2>
                <hr class="w-auto">
                <div class="ps-1 pe-1 pt-3 pb-3">
                <div class="input-group mb-3  mx-auto d-block">
                        <span class="input-group-text " id="id">Identifiant*</span>
                        <input required type="text" list="dataBesoin" id="identifiantM" class="form-control w-50" placeholder="entrer identifiant" aria-label="Username" aria-describedby="nom" >
                            <datalist id="dataBesoin"></datalist>
                    </div>
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
                    <input type="hidden" value="update" id="typeFormulaire">
                    <button id='envoie' class="btn btn-primary p-3 fs-4 mt-4 w-25">Modifier</button>
                    <input type="hidden" id="check-datalist" value="updatePersonnel">
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