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
    <script defer src="./jsfile/takeCaisseout.js"></script>
    <link rel="stylesheet" href="index.css">
</head>

<body class="bg-light">

    <main>
    
        <div class="container bg-transparent pt-5">
            <div class=" p-3 mb-5 border border-1 rounded mt-5" id="sa">
                <h2 class="p-2">Add sortie dans caisse</h2>
                <hr class="w-auto">
                <div class="ps-1 pe-1 pt-3 pb-3">
                <input required type="hidden" id="identifiantM" value="">
                  
                <!--<form class="ps-1 pe-1 pt-3 pb-3" method= "POST" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">-->
                    <div class="input-group mb-3 w-50 mx-auto d-block">
                        <span class="input-group-text w-50" id="dates">Dates *</span>
                        <input required type="date"  name="dates" id="datesout" class="form-control w-50" placeholder="mettre la date" aria-label="Username" aria-describedby="nom" value="<?php $d = strtotime("today"); echo date('Y-m-d',$d); ?>">
                    </div>
                    <div class="row">
                   
                        <div class="input-group mb-3 col-md-6">
                            <label class="input-group-text" for="type">Type de sorties</label>
                            <select class="form-select" id="type">
                              <option selected value="Aucun">Aucun</option>
                              <option value="Charge">Charge</option>
                              <option value="Depense">Depense</option>
                              <option value="Dette">Dette</option>
                              <option value="Autres">Autres</option>
                            </select>
                        </div>
                            
                          

                          <div class="col-md-7 mt-5 mb-4">
                            <div class="input-group ">
                                <span class="input-group-text">Montant*</span>
                                <input required type="float" id="montant" name="CM" class="form-control" placeholder="entrer montant sortie" aria-label="Amount (to the nearest cdf)">
                                <span class="input-group-text">$</span>
                            </div>
                            <small id="montantVide"></small>
                        </div>
                    </div>
                   
                      
                      
                      <div class="row">
                        
                      <div class="input-group">
                        <span class="input-group-text">Commentaires</span>
                        <textarea class="form-control" name="commentaire" id="commentaire" aria-label="With textarea" placeholder="Entrer commentaire"></textarea>
                      </div>

                      <p id="txtHint"></p>
                      <input type="hidden" value="add" id="typeFormulaire">
                      <button id='envoie' class="btn btn-primary p-3 fs-4 mt-4 w-25">Ajoutez</button>
                     <!-- <p id='envoie' class=" bg-primary p-2 mt-4">Envoie</p>-->
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