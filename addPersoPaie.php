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
    <script defer  src="bootstrap-5.0.2-dist/js/bootstrap.bundle.js"></script>
    <script defer src="./navbar.js"></script>
    <script defer src="./jsfile/takePersoPaie.js"></script>
    <link rel="stylesheet" href="index.css">
</head>
<?php
  function dataPersonnel(){
    include 'connexion.php';
    $sql = ("SELECT * FROM DataPersonnel order by idDataPersonnel desc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            echo"<option value='ID ::".$row["idDataPersonnel"].":: Nom  ::".$row["Nom"].":: Telephone ::".$row["Telephone"]."'> = ".$row["Nom"]."</option>"; 
        }
                
   }else{echo "Une erreur s est produite ";}  

}
?>
<body class="bg-light">

    <main>
    
        <div class="container bg-transparent pt-5">
            <div class=" p-3 mb-5 border border-1 rounded mt-5" id="sa">
                <h2 class="p-2">Fiche de paie individuelle</h2>
                <h4>Ajouter une paie</h4>
                <hr class="w-auto">
                <div class="ps-1 pe-1 pt-3 pb-3">
                <input required type="hidden" id="identifiantM" value="">
                  
                <!--<form class="ps-1 pe-1 pt-3 pb-3" method= "POST" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">-->
                    <div class="input-group mb-3 w-50 mx-auto d-block">
                        <span class="input-group-text w-50" id="dates">Dates *</span>
                        <input required type="date"  name="dates" id="datesout" class="form-control w-50" placeholder="mettre la date" aria-label="Username" aria-describedby="nom" value="<?php $d = strtotime("today"); echo date('Y-m-d',$d); ?>">
                    </div>
                   
                    <div class="row">
                        <div class="input-group col-md-7 mb-3">
                            <span class="input-group-text">Personnel*</span>
                            <input required list="dataBesoin" type="text" id="nom" name="CM" class="form-control" placeholder="entrer nom du personnel" aria-label="Amount (to the nearest cdf)">
                         </div>
                      <datalist id="dataBesoin">
                         <?php 
                            dataPersonnel();

                        ?>
                      </datalist>
                  
                        <div class="input-group mb-3 col-md-6">
                            <label class="input-group-text" for="type">Mois</label>
                            <select class="form-select" id="type">
                              <option selected value="Janvier">Janvier</option>
                              <option value="Fevrier">Fevrier</option>
                              <option value="Mars">Mars</option>
                              <option value="Avril">Avril</option>
                              <option value="Mai">Mai</option>
                              <option value="Juin">Juin</option>
                              <option value="Juillet">Juillet</option>
                              <option value="Aout">Aout</option>
                              <option value="Septembre">Septembre</option>
                              <option value="Octobre">Octobre</option>
                              <option value="Novembre">Novembre</option>
                              <option value="Decembre">Decembre</option>
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
                        <span class="input-group-text">Observation</span>
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