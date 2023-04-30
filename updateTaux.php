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
    <script defer src="./jsfile/takePersonnels.js"></script>
    <link rel="stylesheet" href="index.css">
</head>
<?php
  function dataBonusPerte(){
    include 'connexion.php';
    $sql= ("SELECT Chilling, CDF, Rwandais FROM Change order by idChange desc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            echo"<option value='ID ::".$row["idChange"].":: 1$ = ::".$row["Chilling"].":: chilling =  ::".$row["Rwandais"].":: RWD = ::".$row["CDF"].":: fc =::'>QG: ".$row["CDF"]." :fc </option>"; 
        }
                
   }else{echo "Une erreur s est produite ";}  

}
?>
<body class="back">

    <main>
    
        <div class="container bg-transparent pt-5">
            <div class=" p-3 mb-5 border border-1 rounded mt-5" id="sa">
                <h2 class="p-2">Modifier taux de change</h2>
                <hr class="w-auto">
                <div class="ps-1 pe-1 pt-3 pb-3">
                <div class="input-group mb-3  mx-auto d-block">
                        <span class="input-group-text " id="id">Identifiant*</span>
                        <input required type="text" list="dataBesoin" id="identifiantM" class="form-control w-50" placeholder="entrer identifiant" aria-label="Username" aria-describedby="nom" >
                            <datalist id="dataBesoin">
                                <?php 
                                  dataBonusPerte();

                                ?>
                            </datalist>
                    </div>
                    <div class="row">
                        <div class="col-md-7 mb-4">
                            <div class="input-group ">
                                <span class="input-group-text">Chilling*</span>
                                <input required type="float" id="chilling" name="CM" class="form-control" placeholder="entrer cout_Mazout" aria-label="Amount (to the nearest cdf)">
                                <span class="input-group-text">Ch</span>
                            </div>
                            <small id="chillingVide"></small> 
                        </div>
                        <div class="col-md-7 mb-4">
                            <div class="input-group ">
                                <span class="input-group-text">Rwandais*</span>
                                <input required type="float" id="rwandais" name="CM" class="form-control" placeholder="entrer cout_Mazout" aria-label="Amount (to the nearest cdf)">
                                <span class="input-group-text">RWF</span>
                            </div>
                            <small id="rwandaisVide"></small> 
                        </div>
                        <div class="col-md-7 mb-4">
                            <div class="input-group ">
                                <span class="input-group-text">Congolais*</span>
                                <input required type="float" id="cdf" name="CM" class="form-control" placeholder="entrer cout_Mazout" aria-label="Amount (to the nearest cdf)">
                                <span class="input-group-text">Fc</span>
                            </div>
                            <small id="cdfVide"></small> 
                        </div>
                    </div>
                   
                    <p id="txtHint"></p>
                    <input type="hidden" value="update" id="typeFormulaire">
                    <button id='envoie' class="btn btn-primary p-3 fs-4 mt-4 w-25">Modifier</button>
                     
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