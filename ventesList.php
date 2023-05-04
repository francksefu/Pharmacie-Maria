<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventes</title>
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
    <link rel="stylesheet" href="vente.css">
    <script defer src="./jsfile/ventesList.js"></script>
</head>
<?php

function dataVente(){
    include 'connexion.php';
    $sql= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) GROUP BY Operation order by Operation desc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
        while($row= mysqli_fetch_assoc($result)){
            echo"<option value='ID ::".$row["Operation"].":: date ::".$row["DatesVente"].":: client  ::".$row["NomClient"].":: Total facture ::".$row["TotalFacture"]."'>client = ".$row["NomClient"]." dette : ".$row["Dette"]."</option>"; 
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
            <th>Operation</th>
            <th>Date</th>
            <th>Client</th>
            <th>Total</th>
            <th>Payé</th>
            <th>Status</th>
            <th>Reste</th>
            <th>Action</th>
        </tr>
        </thead>';

        while($row= mysqli_fetch_assoc($result)){
            $status = '';
            $paye = 0;

            if($row["Dette"] == 'Oui') {
                $paye = $row["MontantPaye"];
            } else {
                $paye = $row["TotalFacture"];
            }
            if($row["Dette"] == 'Non') {
                $status = '<span class="bg-success p-2 rounded-3 text-white">Paid</span>';
            } else {
                $status = '<span class="bg-danger p-2 rounded-3 text-white">Not paid</span>';
            }
            echo'
        <tr>
        <td>'.$row["Operation"].'</td>
        <td>'.$row["DatesVente"].'</td>
        <td>'.$row["NomClient"].'</td>
        <td>'.$row["TotalFacture"].'</td>
        <td>'.$paye.'</td>
        <td>'.$status.'</td>
        <td>'.($row["TotalFacture"] - $paye).'</td>
        <td >
            <div class="d-flex flex-row justify-content-center">
                <div class="p-2 bg-success m-2 text-white rounded-3">
                <a href="#" class="text-white voir" id="s'.$row["Operation"].'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                    </svg>
                </a>
                </div>
                <div class="p-2 m-2 bg-danger text-white rounded-3" id="del">
                    <a href="#" class="text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                          </svg>
                    </a>
                </div>
                <div class="p-2 bg-primary m-2 text-white rounded-3 montre">
                    <a href="updateVentes.php" class="text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                        </svg>
                    </a>
                </div>  
            </div>
            
        </td>
      </tr>
      <tr>';
      
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
                    <h2>Liste des ventes</h2>
                    <p class=" text-secondary pt-3">
                        Les ventes vous permettent de controler efficacement les KPI de vente et de surveiller
                        dans un lieu centrale tout en aidant les equipes a atteindre leur objectif de vente 
                    </p>
                </div>
                
                <div class="col-md-3 bg-transparent pt-5">
                    <p class="text-center">
                        <a href="addVentes.php" class="btn btn-primary p-2">&plus; Add ventes</a>
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
                          <option value="3">toutes</option>
                        </select>
                        <label class="input-group-text" for="inputGroupSelect01">derniers ventes</label>
                      </div>
                </div>
                <div class="input-group w-50 col-md-5">
                    <span class="input-group-text">Search: </span>
                    <input type="text" class="form-control search" placeholder="Entrer un detail dont vous vous rappeler sur le personnel">
                </div>
                <div class="input-group col-md-10 montre-moi">
                    <span class="input-group-text">supprimer : </span>
                    <input type="text" id="supprimons" list="dataBesoin" class="form-control" placeholder="metez quelque chose dont vous vous rappeler pour le supprimer" >
                      <datalist id="dataBesoin">
                         <?php 
                            dataVente();

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
                <input type="hidden" value="vente1" id="type" >
            </div>
        </div>
    
        <div class="container-fluid pt-5 bg-transparent">
        <?php
            $reqSql0= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) GROUP BY Operation order by Operation desc limit 1000");
            render($reqSql0);
          ?>  
        </div>
        
    </main>
    
    <div class="bg-light" id="superieur">
    <h1 id="croix">&cross;</h1>
        <div id="container"></div>
    </div>
</body>
</html>