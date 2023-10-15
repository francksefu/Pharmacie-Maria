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
</head>
<?php
  function dataCaisseOut(){
    include 'connexion.php';
    $sql = ("SELECT * FROM Sortie order by idSortie desc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            echo"<option value='ID ::".$row["idSortie"].":: Montant ::".$row["Montant"].":: Motif  ::".$row["il_pris_quoi"].":: Type ::".$row["TypeD"].":: Dates ::".$row["DatesD"]."'>montant = ".$row["Montant"]." commentaire : ".$row["il_pris_quoi"]."</option>"; 
        }
                
   }else{echo "Une erreur s est produite ";}  

}

function prediction($sql) {
    $data_input = 0;
    //$data_out = '';
    include 'connexion.php';
    //$sql= ("SELECT * FROM Ventes, Produit WHERE (Ventes.idProduit = Produit.idProduit)");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
        while($row= mysqli_fetch_assoc($result)){
            //echo"<option value='ID ::".$row["Operation"].":: date ::".$row["DatesVente"].":: client  ::".$row["NomClient"].":: Total facture ::".$row["TotalFacture"]."'>client = ".$row["NomClient"]." dette : ".$row["Dette"]."</option>"; 
            $data_input += $row["QuantiteVendu"];
            
        }
        
   }else{$data_input = 0;}
   
   return $data_input;
}

function dataProduct(){
    include 'connexion.php';
    $sql = ("SELECT * FROM Produit order by Nom asc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
        echo '<table class="table border border-1">
                    <thead class="bg-secondary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Quantite deja vendu</th>
                        
                    </tr>
                    </thead>';
        while($row= mysqli_fetch_assoc($result)){
            $id = $row["idProduit"];
            $sq= ("SELECT * FROM Ventes, Produit WHERE ( Ventes.idProduit = $id) and (Ventes.idProduit = Produit.idProduit)");
            $valeur = prediction($sq);
            echo'
                            <tr>
                    <td>'.$row["idProduit"].'</td>
                    <td>'.$row["Nom"].'</td>
                    <td>'.$valeur.'</td>
                    </tr>';
        }
                
   }else{echo "Une erreur s est produite ";}  
   echo "</table> ";
}
?>
<body class="bg-light">
   
    <main>
        <div class="container bg-transparent pt-5" >
            <div class="row bg-transparent pt-5">
                <div class="col-md-6 bg-transparent m-2">
                    <h2>Compteur des nombres des ventes de chaque produits</h2>
                    <p class=" text-secondary pt-3">
                        Cette section de compteur vous renseigne sur les nombres de ventes que vous avez deja effectué sur chaque produit,
                        On vous donne donc une bonne vision de comment votre busness evolue
                    </p>
                </div>
                
                <div class="col-md-3 bg-transparent pt-5">
                    <p class="text-center">
                        <a href="ventesList.php" class="btn btn-primary p-2">&plus; Voir vos ventes</a>
                    </p>
                </div>
    
            </div>
            <div class="row">
                <div class="col-md-5">
                    
                </div>
                <div class="input-group w-50 col-md-5">
                    
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
                dataProduct();

            ?> 
        </div>
        
    </main>
    
</body>
</html>