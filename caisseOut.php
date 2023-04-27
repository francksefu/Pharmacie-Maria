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
    <script defer src="./jsfile/navbar.js"></script>
    <script defer src="./jsfile/jquery-3.6.1.min.js"></script>
    <script defer src="./jsfile/produit.js"></script>
    <script defer src="./jsfile/supprime.js"></script>
    <link rel="stylesheet" href="index.css">
</head>
<?php
  function dataCaisseOut(){
    include 'connexion.php';
    $sql = ("SELECT * FROM CaisseOut order by idCaisseOut desc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            echo"<option value='ID ::".$row["idCaisseOut"].":: Montant entrer ::".$row["MontantOut"].":: Motif  ::".$row["Commentaire"].":: Type ::".$row["Type"].":: Dates ::".$row["DatesOut"]."'>montant = ".$row["MontantOut"]." commentaire : ".$row["Commentaire"]."</option>"; 
        }
                
   }else{echo "Une erreur s est produite ";}  

}
?>
<body class="bg-light">
   
    <main>
        <div class="container bg-transparent pt-5" >
            <div class="row bg-transparent pt-5">
                <div class="col-md-6 bg-transparent m-2">
                    <h2>Liste des sorties dans la caisse</h2>
                    <p class=" text-secondary pt-3">
                        Cette section de sortie vous renseigne sur les sorties dans votre caisse d argent,
                        il peut s agir d une sortie due a une certaine charge(paie du loyé, paie de la facture de l ectricité, achat d un truc non rentable, payer un employé,...)
                    </p>
                </div>
                
                <div class="col-md-3 bg-transparent pt-5">
                    <p class="text-center">
                        <a href="addCaisseout.php" class="btn btn-primary p-2">&plus; Ajoutez sorties</a>
                    </p>
                </div>
    
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="input-group mb-3 w-75">
                        <label class="input-group-text" for="inputGroupSelect01">montrer </label>
                        <select class="form-select" id="inputGroupSelect01">
                          <option value="0" selected>10</option>
                          <option value="1">100</option>
                          <option value="2">250</option>
                          <option value="3">tous</option>
                        </select>
                        <label class="input-group-text" for="inputGroupSelect01">sorties</label>
                      </div>
                </div>
                <div class="input-group w-50 col-md-5">
                    <span class="input-group-text">Search: </span>
                    <input type="text" class="form-control" placeholder="Entrer un detail dont vous vous sur un utilisateur">
                </div>
            </div>
            <div class="input-group mt-3 col-md-10 montre-moi">
                    <span class="input-group-text">supprimer : </span>
                    <input type="text" id="supprimons" list="dataBesoin" class="form-control" placeholder="metez quelque chose dont vous vous rappeler pour le supprimer" >
                      <datalist id="dataBesoin">
                         <?php 
                            dataCaisseOut();

                        ?>
                      </datalist>
                    <span class="input-group-text pointe" id="cross">&cross;</span>
                    <span class="input-group-text pointe" id="btn">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                      </svg>
                    </span>
                </div>
                <small id="txtHint"></small>
                <input type="hidden" value="caisseout" id="type" >
        </div>
    
        <div class="container-fluid pt-5 bg-transparent">
        <?php
                include 'connexion.php';
                        
                $reqSql= ("SELECT * FROM CaisseOut order by idCaisseOut desc ");
                $result= mysqli_query($db, $reqSql);
                if(mysqli_num_rows($result)>0){
                    echo '<table class="table border border-1">
                    <thead class="bg-secondary text-white">
                    <tr>
                        <th>Montant sorti</th>
                        <th>Commentaire</th>
                        <th>Type</th>
                        <th>Dates</th>
                        <th>Action</th>
                    </tr>
                    </thead>';
                 
                    while($row= mysqli_fetch_assoc($result)){
                            echo'
                            <tr>
                    <td>'.$row["MontantOut"].'</td>
                    <td>'.$row["Commentaire"].'</td>
                    <td>'.$row["Type"].'</td>
                    <td>'.$row["DatesOut"].'</td>
                    <td >
                        <div class="d-flex flex-row justify-content-center">
                            
                            <div class="p-2 m-2 bg-danger text-white rounded-3" id="del">
                                <a href="#" class="text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                      </svg>
                                </a>
                            </div>
                            <div class="p-2 bg-primary m-2 text-white rounded-3">
                                <a href="updateCaisseOut.php" class="text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                    </svg>
                                </a>
                            </div>  
                        </div>
                    </td>
                  </tr>
                  <tr>
                            ';
                    }
                    echo"</table>";
                }else{echo "Pas des donnees dans la base ";}

            ?> 
        </div>
        
    </main>
    
</body>
</html>