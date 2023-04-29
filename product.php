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
    <script defer src="./navbar.js"></script>
    <script defer src="./jsfile/jquery-3.6.1.min.js"></script>
    <script defer src="./jsfile/produit.js"></script>
    <script defer src="./jsfile/supprime.js"></script>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="modifier.css">
</head>
<?php
function dataProduct(){
    include 'connexion.php';
    $sql = ("SELECT * FROM Produit order by Nom asc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            echo"<option value='ID ::".$row["idProduit"].":: Nom ::".$row["Nom"].":: PA ::".$row["PrixAchat"].":: PV = ::".$row["PrixVente"].":: PVmin =::".$row["PrixVmin"].":: Qstock = ::".$row["QuantiteStock"]."'>nom: ".$row["Nom"]." :Qstock ".$row["QuantiteStock"]."</option>"; 
        }
                
   }else{echo "Une erreur s est produite ";}  

}

function render($reqSql) {
    include 'connexion.php';
    //$reqSql= ("SELECT * FROM Produit order by idProduit asc");
    $result= mysqli_query($db, $reqSql);
    if(mysqli_num_rows($result)>0){
        echo '<table class="table border border-1">
        <thead class="bg-secondary text-white">
        <tr>
            <th>Produit</th>
            <th>Prix d achat</th>
            <th>Prix de vente</th>
            <th>Prix de vente min</th>
            <th>Quantite stock</th>
            <th>Quantite stock min</th>
            <th>Action</th>
        </tr>
        </thead>';

        while($row= mysqli_fetch_assoc($result)){
              echo'
        <tr>
        <td>
          <div class="d-flex flex-row" id="taille">
            <img src ="banane.png" class="img-fluid photo m-0" alt="produit">
            <div class="ps-2 m-0">
              <h4 class="text-end">'.$row["Nom"].'</h4>
              <small class="text-secondary">'.$row["DescriptionP"].'</small>
            </div>
          </div>
        </td>
        <td>'.$row["PrixAchat"].'</td>
        <td>'.$row["PrixVente"].'</td>
        <td>'.$row["PrixVmin"].'</td>
        <td>'.$row["QuantiteStock"].'</td>
        <td>'.$row["QuantiteStockMin"].'</td>
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
                <div class="p-2 bg-primary m-2 text-white rounded-3 montre">
                    <a href="updateProduct.php" class="text-white">
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

}
?>
<body class="bg-light">
   
    <main>
        <div class="container bg-transparent pt-5" >
            <div class="row bg-transparent pt-5">
                <div class="col-md-6 bg-transparent m-2">
                    <h2>Liste des produit</h2>
                    <p class=" text-secondary pt-3">
                        La liste de produits dicte efficacement la presentation du produit et fornit de l espace
                        pour reportoriervos produits et votre offre de la manierela plus attrayante
                    </p>
                </div>
                <div class="col-md-3 bg-transparent pt-5">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Choisir stock</label>
                        <select class="form-select" id="select-stock">
                          <option value="1">Stock 1</option>
                          <option value="2">Stock 2</option>
                        </select>
                      </div>
                </div>
                <div class="col-md-2 bg-transparent pt-5">
                    <p class="text-center">
                        <a href="addProduct.php" class="btn btn-primary p-2">&plus; Add product</a>
                    </p>
                </div>
    
            </div>
            <div class="input-group w-50 col-md-5">
                <span class="input-group-text">Search: </span>
                <input type="text" class="form-control search" placeholder="Entrer un detail dont vous vous rappeler sur le personnel">
            </div>
            <div class="row supprime mt-3">
                <div class="col-md-2">
                    
                </div>
                <div class="input-group col-md-10 montre-moi">
                    <span class="input-group-text">supprimer : </span>
                    <input type="text" id="supprimons" list="dataBesoin" class="form-control" placeholder="metez quelque chose dont vous vous rappeler pour le supprimer" >
                      <datalist id="dataBesoin">
                         <?php 
                            dataProduct();

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
                <input type="hidden" value="besoin" id="type" >
            </div>
        </div>
   
        <div class="container-fluid pt-5 bg-transparent" id="render">
       <?php
          $reqSql0= ("SELECT * FROM Produit order by Nom asc");
          render($reqSql0);
        ?>
        </div>
        
    </main>
    
</body>
</html>