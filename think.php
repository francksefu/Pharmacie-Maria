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
$date1 = $_POST["Date1"];
$date2 = $_POST["Date2"];
$cache = $_POST["Cache"];
$personnel = $_POST["Personnel"];
$facture = $_POST["Facture"];
$tabC = explode("::", $personnel);
$tabFacture = explode("::", $facture);
$operation = $tabFacture[1];
$id = $tabC[1];

function ventes($reqSql) {
    include 'connexion.php';
    $total_toute_facture = 0;
    $total_paye = 0;
    echo '<h2 class="mt-0 mb-2 text-center">Ventes</h2>';
    echo '<h2 class="mt-3 mb-2 text-center">Ventes</h2>';
    
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
      $total_toute_facture += $row["TotalFacture"];
      $total_paye += ($paye);
        }
        echo'<h3 class="mt-4 mb-2 text-center">Total de toutes les factures : '.$total_toute_facture.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">Total montant deja payé : '.$total_paye.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">difference : '.$total_toute_facture - $total_paye.' $</h3>';
        echo"</table>";
    }else{echo "Pas des donnees dans la base ";}
}

function sortie($reqSql) {
    include 'connexion.php';
    $total_paye = 0;
    echo '<h2 class="mt-0 mb-2 text-center">Sortie</h2>';
    echo '<h2 class="mt-3 mb-2 text-center">Sorties</h2>';
                       
    //$reqSql= ("SELECT * FROM Sortie order by idSortie desc");
    $result= mysqli_query($db, $reqSql);
    if(mysqli_num_rows($result)>0){
        echo '<table class="table border border-1">
        <thead class="bg-secondary text-white">
        <tr>
            <th>ID</th>
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
        <td>'.$row["idSortie"].'</td>
        <td>'.$row["Montant"].'</td>
        <td>'.$row["il_pris_quoi"].'</td>
        <td>'.$row["TypeD"].'</td>
        <td>'.$row["DatesD"].'</td>
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
        $total_paye += $row["Montant"];
        }
        echo'<h3 class="mt-2 mb-2 text-center">Total : '.$total_paye.' $</h3>';
        echo"</table>";
    }else{echo "Pas des donnees dans la base ";}
}

function bonusPerte ($reqSql) {
    include 'connexion.php';
    $quantiteG = 0;
    $quantiteP = 0;
    echo '<h2 class="mt-0 mb-2 text-center">Bonus et perte</h2>';
    echo '<h2 class="mt-3 mb-2 text-center">Bonus et pertes</h2>';
    //$reqSql= ("SELECT * FROM Produit order by idProduit asc");
    $result= mysqli_query($db, $reqSql);
    if(mysqli_num_rows($result)>0){
        echo '<table class="table border border-1">
        <thead class="bg-secondary text-white">
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Produit</th>
            <th>Quantite gagné</th>
            <th>Quantite perdu</th>
            <th>Motif</th>
            <th>Valeur</th>
            <th>Quantite stock</th>
            <th>Action</th>
        </tr>
        </thead>';

        while($row= mysqli_fetch_assoc($result)){
            echo'
        <tr>
        <td>'.$row["idBonusPerte"].'</td>
        <td>'.$row["DatesD"].'</td>
        <td>'.$row["Nom"].'</td>
        <td>'.$row["QuantiteGagne"].'</td>
        <td>'.$row["QuantitePerdu"].'</td>
        <td>'.$row["Motif"].'</td>
        <td>'.$row["PrixVente"] * ($row["QuantiteGagne"] - $row["QuantitePerdu"]).'</td>
        <td>'.$row["QuantiteStock"].'</td>
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
                    <a href="updateBonusPerte.php" class="text-white">
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
        $quantiteG += $row["PrixVente"] * ($row["QuantiteGagne"]);
        $quantiteP += $row["PrixVente"] * ($row["QuantitePerdu"]);
        }
        echo'<h3 class="mt-4 mb-2 text-center">Total des valeurs gagné : '.$quantiteG.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">Total des valeurs perdu : '.$quantiteP.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">difference : '.$quantiteG - $quantiteP.' $</h3>';
       
        echo"</table>";
    }else{echo "Pas des donnees dans la base ";}

}

function approvisionnement($reqSql) {
    include 'connexion.php';

    $total = 0;
    echo '<h2 class="mt-0 mb-2 text-center">Approvisionnement</h2>';
    echo '<h2 class="mt-3 mb-2 text-center">Approvisionnement</h2>';
   
    $result= mysqli_query($db, $reqSql);
    if(mysqli_num_rows($result)>0){
        echo '<table class="table border border-1">
        <thead class="bg-secondary text-white">
        <tr>
            <th>Operation</th>
            <th>Date</th>
            <th>Source</th>
            <th>Destination</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        </thead>';

        while($row= mysqli_fetch_assoc($result)){
           
            echo'
        <tr>
        <td>'.$row["Operation"].'</td>
        <td>'.$row["DatesApprov"].'</td>
        <td>'.$row["Source"].'</td>
        <td>'.$row["Destination"].'</td>
        <td>'.$row["TotalFacture"].'</td>
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
                
                <div class="p-2 bg-primary m-2 text-white rounded-3 montre">
                    <a href="updateApprov.php" class="text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                        </svg>
                    </a>
                </div>  
            </div>
            
        </td>
      </tr>
      <tr>';
    $total += $row["TotalFacture"];
        }
        echo'<h3 class="mt-4 mb-2 text-center">Total : '.$total.' $</h3>';
        echo"</table>";
    }else{echo "Pas des donnees dans la base ";}
}

function paiements($reqSql) {
    include 'connexion.php';

    $total_facture = 0;
    $montant = 0;
    echo '<h2 class="mt-0 mb-2 text-center">Paiements</h2>';
    echo '<h2 class="mt-4 mb-2 text-center">Paiements</h2>';
    
    //$reqSql= ("SELECT * FROM Produit order by idProduit asc");
    $result= mysqli_query($db, $reqSql);
    if(mysqli_num_rows($result)>0){
        echo '<table class="table border border-1">
        <thead class="bg-secondary text-white">
        <tr>
            <th>ID</th>
            <th>Montant payé</th>
            <th>date de paiement</th>
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
        <td>'.$row["idPaiements"].'</td>
        <td>'.$row["Montant"].'</td>
        <td>'.$row["DatesPaie"].'</td>
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
                
                <div class="p-2 bg-primary m-2 text-white rounded-3 montre">
                    <a href="updatePaiements.php" class="text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                        </svg>
                    </a>
                </div>  
            </div>
            
        </td>
      </tr>
      <tr>';
      $total_facture += $row["TotalFacture"];
      $montant += $paye;
        }
        echo'<h3 class="mt-4 mb-2 text-center">Total des factures : '.$total_facture.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">Total des montants deja payé : '.$montant.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">difference : '.$total_facture - $montant.' $</h3>';
        
        echo"</table>";
    }else{echo "Pas des donnees dans la base ";}
}
?>

<body>
<main>
    <?php 
      if($cache == 'toute_vente') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente = '".$date1."') GROUP BY Operation order by Operation desc");
        ventes($reqSq);
      }

      if($cache == 'toute_vente2') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente BETWEEN '".$date1."' AND '".$date2."') GROUP BY Operation order by Operation desc");
        ventes($reqSq);
      }

      if($cache == 'paye_cache') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente = '".$date1."') and (Dette = 'Non') GROUP BY Operation order by Operation desc");
        ventes($reqSq);
      }

      if($cache == 'paye_cache2') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente BETWEEN '".$date1."' AND '".$date2."') and (Dette = 'Non') GROUP BY Operation order by Operation desc");
        ventes($reqSq);
      }

      if($cache == 'vente_dette') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente = '".$date1."') and (Dette = 'Oui') GROUP BY Operation order by Operation desc");
        ventes($reqSq);
      }

      if($cache == 'vente_dette2') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente BETWEEN '".$date1."' AND '".$date2."') and (Dette = 'Oui') GROUP BY Operation order by Operation desc");
        ventes($reqSq);
      }

      if($cache == 'toutes_sortie') {
        $reqSq= ("SELECT * FROM Sortie WHERE(DatesD = '".$date1."') order by idSortie desc");
        sortie($reqSq);
      }

      if($cache == 'toutes_sortie2') {
        $reqSq= ("SELECT * FROM Sortie WHERE(DatesD BETWEEN '".$date1."' AND '".$date2."') order by idSortie desc");
        sortie($reqSq);
      }

      if($cache == 'trie_dette') {
        $reqSq= ("SELECT * FROM Sortie WHERE(DatesD = '".$date1."') and (TypeD = 'Dette') order by idSortie desc");
        sortie($reqSq);
      }

      if($cache == 'trie_dette2') {
        $reqSq= ("SELECT * FROM Sortie WHERE(DatesD BETWEEN '".$date1."' AND '".$date2."') and (TypeD = 'Charge') order by idSortie desc");
        sortie($reqSq);
      }

      if($cache == 'trie_charge') {
        $reqSq= ("SELECT * FROM Sortie WHERE(DatesD = '".$date1."') and (TypeD = 'Dette') order by idSortie desc");
        sortie($reqSq);
      }

      if($cache == 'trie_charge2') {
        $reqSq= ("SELECT * FROM Sortie WHERE(DatesD BETWEEN '".$date1."' AND '".$date2."') and (TypeD = 'Charge') order by idSortie desc");
        sortie($reqSq);
      }

      if($cache == 'trie_depenses') {
        $reqSq= ("SELECT * FROM Sortie WHERE(DatesD = '".$date1."') and (TypeD = 'Depense') order by idSortie desc");
        sortie($reqSq);
      }

      if($cache == 'trie_depenses2') {
        $reqSq= ("SELECT * FROM Sortie WHERE(DatesD BETWEEN '".$date1."' AND '".$date2."') and (TypeD = 'Depense') order by idSortie desc");
        sortie($reqSq);
      }

      if($cache == 'trie_inutile') {
        $reqSq= ("SELECT * FROM Sortie WHERE(DatesD = '".$date1."') and (TypeD = 'Aucun') order by idSortie desc");
        sortie($reqSq);
      }

      if($cache == 'trie_inutile2') {
        $reqSq= ("SELECT * FROM Sortie WHERE(DatesD BETWEEN '".$date1."' AND '".$date2."') and (TypeD = 'Aucun') order by idSortie desc");
        sortie($reqSq);
      }

      if($cache == 'bonus_perte') {
        $reqSq=  ("SELECT * FROM BonusPerte, Produit WHERE (DatesD = '".$date1."') and (BonusPerte.idProduit = Produit.idProduit) order by idBonusPerte desc");
        bonusPerte($reqSq);
      }

      if($cache == 'bonus_perte2') {
        $reqSq=  ("SELECT * FROM BonusPerte, Produit WHERE (DatesD BETWEEN '".$date1."' AND '".$date2."') and (BonusPerte.idProduit = Produit.idProduit) order by idBonusPerte desc");
        bonusPerte($reqSq);
      }

      if($cache == 'approvisionnements') {
        $reqSql0= ("SELECT * FROM Approvisionnement, Produit WHERE (Approvisionnement.idProduit = Produit.idProduit) and (DatesApprov = '".$date1."') GROUP BY Operation order by Operation desc limit 1000");
        approvisionnement($reqSql0);
      }

      if($cache == 'approvisionnements2') {
        $reqSql0= ("SELECT * FROM Approvisionnement, Produit WHERE (Approvisionnement.idProduit = Produit.idProduit) and (DatesApprov BETWEEN '".$date1."' AND '".$date2."') GROUP BY Operation order by Operation desc limit 1000");
        approvisionnement($reqSql0);
      }

      if($cache == 'paiements') {
        $reqSql0= ("SELECT * FROM Paiements, Ventes, Client WHERE (Paiements.Operation = Ventes.Operation) and (Client.idClient = Ventes.idClient) and (DatesPaie = '".$date1."') GROUP BY idPaiements order by idPaiements desc");
        paiements($reqSql0);
      }

      if($cache == 'paiements2') {
        $reqSql0= ("SELECT * FROM Paiements, Ventes, Client WHERE (Paiements.Operation = Ventes.Operation) and (Client.idClient = Ventes.idClient) and (DatesPaie BETWEEN '".$date1."' AND '".$date2."') GROUP BY idPaiements order by idPaiements desc");
        paiements($reqSql0);
      }

      if($cache == 'paiements_facture') {
        $reqSql0= ("SELECT * FROM Paiements, Ventes, Client WHERE (Paiements.Operation = Ventes.Operation) and (Client.idClient = Ventes.idClient) and (Paiements.Operation = $operation) GROUP BY idPaiements order by idPaiements desc");
        paiements($reqSql0);
      }

      if($cache == 'paiements_client') {
        $reqSql0= ("SELECT * FROM Paiements, Ventes, Client WHERE (Paiements.Operation = Ventes.Operation) and (Client.idClient = Ventes.idClient) and (Client.idClient = $id) GROUP BY idPaiements order by idPaiements desc");
        paiements($reqSql0);
      }

      if($cache == 'paiements_client') {
        $reqSql0= ("SELECT * FROM Paiements, Ventes, Client WHERE (Paiements.Operation = Ventes.Operation) and (Client.idClient = Ventes.idClient) and (Client.idClient = $id) GROUP BY idPaiements order by idPaiements desc");
        paiements($reqSql0);
      }

      if($cache == 'clients_facture') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(Client.idClient = $id) GROUP BY Operation order by Operation desc");
        ventes($reqSq);
      }

      if($cache == 'clients_facture_dette') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(Client.idClient = $id) and (Dette = 'Oui') GROUP BY Operation order by Operation desc");
        ventes($reqSq);
      }

      if($cache == 'clients_facture_2dates') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(Client.idClient = $id) and (DatesPaie BETWEEN '".$date1."' AND '".$date2."') GROUP BY Operation order by Operation desc");
        ventes($reqSq);
      }
    ?>
</main>
<div class="bg-light" id="superieur">
    <h1 id="croix">&cross;</h1>
        <div id="container"></div>
    </div>
</body>
</html>