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
$paie_perso = $_POST["PaiePerso"];
$tabC = explode("::", $personnel);
$tabFacture = explode("::", $facture);
$tabPerso = explode("::", $paie_perso);
if($tabC[0] != ''){
  $id = $tabC[1];
} else {
  $id = '';
}

if($tabPerso[0] != ''){
  $idi = $tabPerso[1];
} else {
  $idi = '';
}

if($tabFacture[0] != '') {
  $operation = $tabFacture[1];
} else {
  $operation = '';
}

function ventes($reqSql) {
    include 'connexion.php';
    $total_toute_facture = 0;
    $total_paye = 0;
    $pa = 0;
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
            if($row["TotalFacture"] == $paye) {
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
      $pa += $row["PrixAchat"];
        }
        echo'<h3 class="mt-4 mb-2 text-center">Total de toutes les factures : '.$total_toute_facture.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center text-success">Total montant deja payé : '.$total_paye.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center text-danger">difference : '.$total_toute_facture - $total_paye.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">total prix d achat : '.$pa.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">total benefice avec total factures : '.$total_toute_facture - $pa.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">total benefice avec total des montant payé : '.$total_paye - $pa.' $</h3>';
        echo"</table>";
    }else{echo "Pas des donnees dans la base ";}
}

function dataVente($operation){
    include 'connexion.php';
    $sql= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and (Operation = $operation)");
    $result = mysqli_query($db, $sql);
    $valeur = '';  
    if(mysqli_num_rows($result)>0){
      $valeur .= '<div class="border border-secondary redimentionne mt-3 mb-3">
      <h2 class="text-center">Facture</h2>
      <table class="table border border-1">
      <thead class="bg-secondary text-white">
      <tr>
            <th>Quantite vendu</th>
            <th>Nom du produit</th>
            <th>Prix de vente unitaire</th>
            <th>Prix de vente total</th>
        </tr>
      </thead>
    <tbody>';
    $total = 0;
        while($row= mysqli_fetch_assoc($result)){
            $status = '';
            $paye = 0;

            if($row["Dette"] == 'Oui') {
                $paye = $row["MontantPaye"];
            } else {
                $paye = $row["TotalFacture"];
            }
            if($row["TotalFacture"] == $paye) {
                $status = '<span class="bg-success p-2 rounded-3 text-white">Paid</span>';
            } else {
                $status = '<span class="bg-danger p-2 rounded-3 text-white">Not paid : '.$row["TotalFacture"] - $paye.' $ </span>';
            }

            $op = $row["Operation"];
            $nomClient = $row["NomClient"];
            $date = $row["DatesVente"];
            $total += $row["PT"];
            $valeur .= '
                <tr>
                    <td>'.$row["QuantiteVendu"].'</td>
                    <td>
                        '.$row["Nom"].'
                    </td>
                    <td>'.$row["PU"].'</td>
                    <td>'.$row["PT"].'</td>
                </tr>';
        }
       
        $valeur .= '</tbody>
        <h5 class=" mb-3 mt-3 ms-3"> numero : '.$op.'</h5>
        <h5 class=" mb-3 mt-3 ms-3"> date : '.$date.'</h5>
        <h3 class=" mb-3 mt-3 ms-3"> client : '.$nomClient.'</h3>
        <br />
        <div class="mb-2">'.$status.'<div>
        <br />
        </table>
        <h3 class="text-center mb-3 mt-3"> total : '.$total.' $</h3></div>';
        return $valeur;

   }else{return "Une erreur s est produite ";}  

}

function dataVente_tableau_date($date_tableau){
    include 'connexion.php';
    $sql= ("SELECT * FROM Ventes, Produit WHERE ((Ventes.idProduit = Produit.idProduit) and DatesVente = '".$date_tableau."')");
    $result = mysqli_query($db, $sql);
    $valeur = '';     
    if(mysqli_num_rows($result)>0){
      $valeur .= '<div class="redimentionne mt-3 mb-3">
      
      <table class="table border border-1">
      <thead class="bg-secondary text-white">
      <tr>
            <th>Articles</th>
            <th>Quantite vendu</th>
            <th>Prix de vente unitaire</th>
            <th>Prix de vente total</th>
        </tr>
      </thead>
    <tbody>
    <tr class="text-success bg-warning"><td>'.$date_tableau.'</td></tr>';
    $total = 0;
        while($row= mysqli_fetch_assoc($result)){

            $total += $row["PT"];
            $valeur .= '
                
                <tr>
                    <td>
                        '.$row["Nom"].'
                    </td>
                    <td>'.$row["QuantiteVendu"].'</td>
                    <td>'.$row["PU"].'</td>
                    <td>'.$row["PT"].'</td>
                </tr>';
        }
       
        $valeur .= '</tbody>
        
        </table>
        <h3 class="text-center mb-3 mt-3 w-75 border border-success"> total : '.$total.' $</h3></div>';
        return $valeur;

   }else{return "Pas des donnees ici";}  

}

function dataVente_tableau_produit($idProduit_tableau, $dateV,$dateV2 = 10){
    include 'connexion.php';
    if ($dateV2 === 10) {
        $sql= ("SELECT * FROM Ventes, Produit WHERE (Ventes.idProduit = Produit.idProduit) and (Produit.idProduit = '".$idProduit_tableau."' and DatesVente = '".$dateV."') order by Produit.idProduit");
    } else {
        $sql= ("SELECT * FROM Ventes, Produit WHERE (Ventes.idProduit = Produit.idProduit) and (Produit.idProduit = '".$idProduit_tableau."' and DatesVente between '".$dateV."' and '".$dateV2."') order by Produit.idProduit");
    }
    
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
      $qtite_vendu_total = 0;
        while($row= mysqli_fetch_assoc($result)){
            $qtite_vendu_total += $row["QuantiteVendu"]; 
        }
        return $qtite_vendu_total;

   }else{return "Une erreur s est produite ";}  

}

function ventes_affichage_facture($reqSql) {
    include 'connexion.php';
    $total_toute_facture = 0;
    $total_paye = 0;
    $pa = 0;
    echo '<h2 class="mt-0 mb-2 text-center">Ventes</h2>';
    echo '<h2 class="mt-3 mb-2 text-center">Ventes</h2>';
   
    //$reqSql= ("SELECT * FROM Produit order by idProduit asc");
    $result= mysqli_query($db, $reqSql);
    if(mysqli_num_rows($result)>0){
        
        while($row= mysqli_fetch_assoc($result)){
          echo dataVente($row["Operation"]);
          $paye = 0;

            if($row["Dette"] == 'Oui') {
                $paye = $row["MontantPaye"];
            } else {
                $paye = $row["TotalFacture"];
            }
      $total_toute_facture += $row["TotalFacture"];
      $total_paye += $paye;
      $pa += $row["PrixAchat"];
        }
        echo'<h3 class="mt-4 mb-2 text-center">Total de toutes les factures : '.$total_toute_facture.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center text-success">Total montant deja payé : '.$total_paye.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center text-danger">difference : '.$total_toute_facture - $total_paye.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">total prix d achat : '.$pa.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">total benefice avec total factures : '.$total_toute_facture - $pa.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">total benefice avec total des montant payé : '.$total_paye - $pa.' $</h3>';
        echo"</table>";
    }else{echo "Pas des donnees dans la base ";}
}

function ventes_affichage_tableau($reqSqlDate, $reqProduit, $dat1 = 10, $dat2 = 10) {
    include 'connexion.php';
    
    echo '<h2 class="mt-0 mb-2 text-center">Ventes</h2>';
    echo '<h2 class="mt-3 mb-2 text-center">Ventes</h2>';

    $result= mysqli_query($db, $reqSqlDate);
    if(mysqli_num_rows($result)>0){
        
        while($row= mysqli_fetch_assoc($result)){
          echo dataVente_tableau_date($row["DatesVente"]);
        }
        
    }else{echo "Pas des donnees dans la base ";}
   
    $resultProduit= mysqli_query($db, $reqProduit);
    if(mysqli_num_rows($resultProduit)>0){
       echo '<div class="redimentionne mt-3 mb-3">
      
        <table class="table border border-1">
          <thead class="bg-secondary text-white">
            <tr class="bg-success">
             <th>Articles</th>
             <th>Quantite vendu</th>
             <th>Quantite en stock actuel</th>
            </tr>
          </thead>
          <tbody>';
        while($row= mysqli_fetch_assoc($resultProduit)){
          $qtite = dataVente_tableau_produit($row["idProduit"], $dat1, $dat2);
          echo '<tr>
            <td>
              '.$row["Nom"].'
            </td>
            <td>
              '.$qtite.'
            </td>
            <td>
              '.$row["QuantiteStock"].'
            </td>
          </tr>';
        }
        echo '</tbody>
            </table>
          </div>';
        
    }else{echo "Pas des donnees dans la base ";}
}

function sortie($reqSql) {
    include 'connexion.php';
    $total_paye = 0;
    echo '<h2 class="mt-0 mb-2 text-center">Sortie</h2>';
    echo '<h2 class="mt-3 mb-2 text-center">Sorties</h2>';

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

function venteEtsortie($reqSql, $req) {
  include 'connexion.php';
  $total_sortie = 0;
  echo '<h2 class="mt-0 mb-2 text-center">Sortie</h2>';
  echo '<h2 class="mt-3 mb-2 text-center">Sorties</h2>';
                     
  //$reqSql= ("SELECT * FROM Sortie order by idSortie desc");
  $result= mysqli_query($db, $req);
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
      $total_sortie += $row["Montant"];
      }
      echo'<h3 class="mt-2 mb-2 text-center">Total : '.$total_sortie.' $</h3>';
      echo"</table>";
  }else{echo "Pas des donnees dans la base ";}
  //
  $total_toute_facture = 0;
    $total_paye = 0;
    $pa = 0;
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
            if($row["TotalFacture"] == $paye) {
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
      $pa += $row["PrixAchat"];
        }
        echo'<h3 class="mt-4 mb-2 text-center">Total de toutes les factures : '.$total_toute_facture.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center text-succes">Total montant deja payé : '.$total_paye.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center text-danger">difference : '.$total_toute_facture - $total_paye.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">total prix d achat : '.$pa.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">total benefice avec total factures : '.$total_toute_facture - $pa.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">total benefice avec total des montant payé : '.$total_paye - $pa.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">Difference entre les sorties et les ventes : '.$total_toute_facture - $total_sortie.' $</h3>';
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

function dataPaiementAffichageSynthetique($operation){
    include 'connexion.php';
    $sql= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and (Operation = $operation)");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
      $valeur .= '<div class="border border-secondary redimentionne mt-3 mb-3">
      <h2 class="text-center">Facture</h2>
      <table class="table border border-1">
      <thead class="bg-secondary text-white">
      <tr>
            <th>Quantite vendu</th>
            <th>Nom du produit</th>
            <th>Prix de vente unitaire</th>
            <th>Prix de vente total</th>
        </tr>
      </thead>
    <tbody>';
    $total = 0;
    $reste = 0;
        while($row= mysqli_fetch_assoc($result)){
            $status = '';
            $paye = 0;

            if($row["Dette"] == 'Oui') {
                $paye = $row["MontantPaye"];
            } else {
                $paye = $row["TotalFacture"];
            }
            if($row["TotalFacture"] == $paye) {
                $status = '<span class="bg-success p-2 rounded-3 text-white">Paid</span>';
            } else {
                $status = '<span class="bg-danger p-2 rounded-3 text-white">Not paid : '.$row["TotalFacture"] - $paye.' $ </span>';
            }
           $reste = $row["TotalFacture"] - $paye;
            $op = $row["Operation"];
            $nomClient = $row["NomClient"];
            $date = $row["DatesVente"];
            $total += $row["PT"];
            $valeur .= '
                <tr>
                    <td>'.$row["QuantiteVendu"].'</td>
                    <td>
                        '.$row["Nom"].'
                    </td>
                    <td>'.$row["PU"].'</td>
                    <td>'.$row["PT"].'</td>
                </tr>';
        }
       
        $valeur .= '</tbody>
        <h5 class=" mb-3 mt-3 ms-3"> numero : '.$op.'</h5>
        <h5 class=" mb-3 mt-3 ms-3"> date : '.$date.'</h5>
        <h3 class=" mb-3 mt-3 ms-3"> client : '.$nomClient.'</h3>
        <br />
        <div class="mb-2">'.$status.'<div>
        <br />
        </table>
        <h3 class="text-center mb-3 mt-3"> total : '.$total.' $</h3></div>';

   }else{return "Une erreur s est produite ";} 
   $sqlP= ("SELECT * FROM Paiements WHERE (Operation = $operation)");
        $resultP = mysqli_query($db, $sqlP);
        $total_paie = 0;
        if(mysqli_num_rows($resultP)>0) {
            $valeur .= '<div class="border border-secondary redimentionne mt-3 mb-3">
            <table class="table border border-1">
            <thead class="bg-success text-white">
              <tr>
                  <th>Date</th>
                  <th>Paiements</th>
              </tr>
            </thead>
          <tbody>';
          while($rowP= mysqli_fetch_assoc($resultP)) {
            $total_paie += $rowP["Montant"];
            $valeur .= '
            <tr>
                <td>'.$rowP["DatesPaie"].'</td>
                <td>
                    '.$rowP["Montant"].' $
                </td>
            </tr>';
          }
          $valeur .= '</tbody>
          </table>
          <h2 class="text-center text-danger">Reste : '.$reste.' $</h2></div>';
        } else { return "Pas des donnee";}

        return $valeur;
}

function paiements_affichage_facture($reqSql) {
    include 'connexion.php';
    $total_toute_facture = 0;
    $total_paye = 0;
    echo '<h2 class="mt-0 mb-2 text-center">Paiements factures</h2>';
    echo '<h2 class="mt-3 mb-2 text-center">Paiements factures</h2>';
   
    //$reqSql= ("SELECT * FROM Produit order by idProduit asc");
    $result= mysqli_query($db, $reqSql);
    if(mysqli_num_rows($result)>0){
        
        while($row= mysqli_fetch_assoc($result)){
          echo dataPaiementAffichageSynthetique($row["Operation"]);
          $paye = 0;

            if($row["Dette"] == 'Oui') {
                $paye = $row["MontantPaye"];
            } else {
                $paye = $row["TotalFacture"];
            }
      $total_toute_facture += $row["TotalFacture"];
      $total_paye += $paye;
      
        }
        echo'<h3 class="mt-4 mb-2 text-center">Total de toutes les factures : '.$total_toute_facture.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center text-success">Total montant deja payé : '.$total_paye.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center text-danger">difference : '.$total_toute_facture - $total_paye.' $</h3>';
        
    }else{echo "Pas des donnees dans la base ";}
}

function paiements($reqSql, $req) {
    include 'connexion.php';

    $total_facture = 0;
    $montant = 0;
    echo '<h2 class="mt-0 mb-2 text-center">Paiements</h2>';
    echo '<h2 class="mt-4 mb-2 text-center">Paiements</h2>';
    $res = mysqli_query($db, $req);
    if(mysqli_num_rows($res)>0) {
        while($rowT= mysqli_fetch_assoc($res)) {
            if($rowT["Dette"] == 'Oui') {
                $payes = $rowT["MontantPaye"];
            } else {
                $payes = $rowT["TotalFacture"];
            }
            $total_facture += $rowT["TotalFacture"];
            $montant += $payes;
        }
    }
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
            if($row["TotalFacture"] == $paye) {
                $status = '<span class="bg-success p-2 rounded-3 text-white">Paid</span>';
            } else {
                $status = '<span class="bg-danger p-2 rounded-3 text-white">Not paid</span>';
            }
            $somme_montant += $row["Montant"];
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
      
        }
        echo'<h3 class="mt-2 mb-2 text-center text-success">Sommes du montant payé ce jour la : '.$somme_montant.' $</h3>';
        echo'<h3 class="mt-4 mb-2 text-center">Total des factures : '.$total_facture.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">Total des montants deja payé : '.$montant.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">difference : '.$total_facture - $montant.' $</h3>';
        
        echo"</table>";
    }else{echo "Pas des donnees dans la base ";}
}

function paiement_personnel($reqSql) {
    include 'connexion.php';
    echo '<h2 class="mt-0 mb-2 text-center">Paiements du personnel</h2>';
    echo '<h2 class="mt-4 mb-2 text-center">Paiements du personnel</h2>';
    $total = 0;
    //$reqSql= ("SELECT * FROM PersonnelPaie, DataPersonnel WHERE (PersonnelPaie.idDataPersonnel = DataPersonnel.idDataPersonnel) order by idPersonnelPaie desc");
    $result= mysqli_query($db, $reqSql);
    if(mysqli_num_rows($result)>0){
        echo '<table class="table border border-1">
        <thead class="bg-secondary text-white">
        <tr>
            <th>ID</th>
            <th>Nom du personnel</th>
            <th>Date</th>
            <th>Mois</th>
            <th>Montant</th>
            <th>Observation</th>
            <th>Action</th>
        </tr>
        </thead>';
  
        while($row= mysqli_fetch_assoc($result)){
            $total += $row["Montant"];
                echo'
                <tr>
        <td>'.$row["idPersonnelPaie"].'</td>
        <td>'.$row["Nom"].'</td>
        <td>'.$row["Date"].'</td>
        <td>'.$row["Mois"].'</td>
        <td>'.$row["Montant"].'</td>
        <td>'.$row["Observation"].'</td>
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
                    <a href="updatePersoPaie.php" class="text-white">
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
        echo'<h3 class="mt-4 mb-2 text-center text-success">Total des montants payés : '.$total.' $</h3>';
        echo"</table>";
    }else{echo "Pas des donnees dans la base ";}
}

function perte_occasionnee($reqSql) {
  include 'connexion.php';
  echo '<h2 class="mt-0 mb-2 text-center">Perte occasionnee</h2>';
    echo '<h2 class="mt-4 mb-2 text-center">Pertes occasionnée</h2>';
    $total = 0;     
  //$reqSql= ("SELECT * FROM PerteOccaz order by idPerteOccaz desc limit 500");
  $result= mysqli_query($db, $reqSql);
  if(mysqli_num_rows($result)>0){
      echo '<table class="table border border-1">
      <thead class="bg-secondary text-white">
      <tr>
          <th>ID</th>
          <th>Montant perdu</th>
          <th>Commentaire</th>
          <th>Dates</th>
          <th>Action</th>
      </tr>
      </thead>';
  
      while($row= mysqli_fetch_assoc($result)){
        $total += $row["Montant"];
              echo'
              <tr>
      <td>'.$row["idPerteOccaz"].'</td>
      <td>'.$row["Montant"].'</td>
      <td>'.$row["Commentaire"].'</td>
      
      <td>'.$row["Dates"].'</td>
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
                  <a href="updatePerteOccaz.php" class="text-white">
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
      echo '<h2 class = "text-center w-75 ms-5 text-success">'.$total.' $</h2>';
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

      if($cache == 'toute_vente_facture') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente = '".$date1."') GROUP BY Operation order by Operation desc");
        ventes_affichage_facture($reqSq);
      }

      if($cache == 'toute_vente_tableau') {
        $reqSq= ("SELECT * FROM Ventes, Produit WHERE (Ventes.idProduit = Produit.idProduit) and(DatesVente = '".$date1."') GROUP BY DatesVente order by DatesVente desc");
        $reqSqP= ("SELECT * FROM Ventes, Produit WHERE (Ventes.idProduit = Produit.idProduit) and(DatesVente = '".$date1."') GROUP BY Produit.idProduit order by DatesVente desc");
        ventes_affichage_tableau($reqSq, $reqSqP);
      }

      if($cache == 'toute_vente2') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente BETWEEN '".$date1."' AND '".$date2."') GROUP BY Operation order by Operation desc");
        ventes($reqSq);
      }

      if($cache == 'toute_vente2_facture') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente BETWEEN '".$date1."' AND '".$date2."') GROUP BY Operation order by Operation desc");
        ventes_affichage_facture($reqSq);
      }

      if($cache == 'toute_vente2_tableau') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente BETWEEN '".$date1."' AND '".$date2."') GROUP BY DatesVente order by DatesVente desc");
        $reqSqP= ("SELECT * FROM Ventes, Produit WHERE (Ventes.idProduit = Produit.idProduit) and(DatesVente BETWEEN '".$date1."' AND '".$date2."') GROUP BY Produit.idProduit order by DatesVente desc");
        ventes_affichage_tableau($reqSq, $reqSqP, $date1, $date2);
      }

      if($cache == 'paye_cache') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente = '".$date1."') and (Dette = 'Non') GROUP BY Operation order by Operation desc");
        ventes($reqSq);
      }

      if($cache == 'paye_cache_facture') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente = '".$date1."') and (Dette = 'Non') GROUP BY Operation order by Operation desc");
        ventes_affichage_facture($reqSq);
      }

      if($cache == 'paye_cache2') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente BETWEEN '".$date1."' AND '".$date2."') and (Dette = 'Non') GROUP BY Operation order by Operation desc");
        ventes($reqSq);
      }

      if($cache == 'paye_cache2_facture') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente BETWEEN '".$date1."' AND '".$date2."') and (Dette = 'Non') GROUP BY Operation order by Operation desc");
        ventes_affichage_facture($reqSq);
      }


      if($cache == 'vente_dette') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente = '".$date1."') and (Dette = 'Oui') GROUP BY Operation order by Operation desc");
        ventes($reqSq);
      }

      if($cache == 'vente_dette_facture') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente = '".$date1."') and (Dette = 'Oui') GROUP BY Operation order by Operation desc");
        ventes_affichage_facture($reqSq);
      }

      if($cache == 'vente_dette2') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente BETWEEN '".$date1."' AND '".$date2."') and (Dette = 'Oui') GROUP BY Operation order by Operation desc");
        ventes($reqSq);
      }

      if($cache == 'vente_dette2_facture') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente BETWEEN '".$date1."' AND '".$date2."') and (Dette = 'Oui') GROUP BY Operation order by Operation desc");
        ventes_affichage_facture($reqSq);
      }

      if($cache == 'vente_sortie') {
        $reqSq1= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente = '".$date1."') GROUP BY Operation order by Operation desc");
        $reqSq2= ("SELECT * FROM Sortie WHERE(DatesD = '".$date1."') order by idSortie desc");
        venteEtsortie($reqSq1, $reqSq2);
      }

      if($cache == 'vente_sortie2') {
        $reqSq1= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente BETWEEN '".$date1."' AND '".$date2."') GROUP BY Operation order by Operation desc");
        $reqSq2= ("SELECT * FROM Sortie WHERE(DatesD BETWEEN '".$date1."' AND '".$date2."') order by idSortie desc");
        venteEtsortie($reqSq1, $reqSq2);
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
        $reqSq= ("SELECT * FROM Paiements, Ventes, Client WHERE (Paiements.Operation = Ventes.Operation) and (Client.idClient = Ventes.idClient) and (DatesPaie = '".$date1."') GROUP BY Ventes.Operation order by idPaiements desc");
        paiements($reqSql0, $reqSq);
      }

      if($cache == 'paiements2') {
        $reqSql0= ("SELECT * FROM Paiements, Ventes, Client WHERE (Paiements.Operation = Ventes.Operation) and (Client.idClient = Ventes.idClient) and (DatesPaie BETWEEN '".$date1."' AND '".$date2."') GROUP BY idPaiements order by idPaiements desc");
        $reqSq= ("SELECT * FROM Paiements, Ventes, Client WHERE (Paiements.Operation = Ventes.Operation) and (Client.idClient = Ventes.idClient) and (DatesPaie BETWEEN '".$date1."' AND '".$date2."') GROUP BY Ventes.Operation order by idPaiements desc");
        paiements($reqSql0, $reqSq);
        //$reqSql0= ("SELECT * FROM Paiements, Ventes WHERE (Paiements.Operation = Ventes.Operation) and (DatesPaie BETWEEN '".$date1."' AND '".$date2."') GROUP BY Ventes.Operation ");
        //paiements_affichage_facture($reqSql0);
      }

      if($cache == 'paiements_facture') {
        $reqSql0= ("SELECT * FROM Paiements, Ventes, Client WHERE (Paiements.Operation = Ventes.Operation) and (Client.idClient = Ventes.idClient) and (Paiements.Operation = $operation) GROUP BY idPaiements order by idPaiements desc");
        $reqSq= ("SELECT * FROM Paiements, Ventes, Client WHERE (Paiements.Operation = Ventes.Operation) and (Client.idClient = Ventes.idClient) and (Paiements.Operation = $operation) GROUP BY Ventes.Operation order by idPaiements desc");
        paiements($reqSql0, $reqSq);
      }

      if($cache == 'paiements_client') {
        $reqSql0= ("SELECT * FROM Paiements, Ventes, Client WHERE (Paiements.Operation = Ventes.Operation) and (Client.idClient = Ventes.idClient) and (Ventes.idClient = $id) GROUP BY idPaiements order by idPaiements desc");
        $reqSq= ("SELECT * FROM Paiements, Ventes, Client WHERE (Paiements.Operation = Ventes.Operation) and (Client.idClient = Ventes.idClient) and (Ventes.idClient = $id) GROUP BY Paiements.Operation order by idPaiements desc");
        paiements($reqSql0, $reqSq);
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

      //$reqSql= ("SELECT * FROM PersonnelPaie, DataPersonnel WHERE (PersonnelPaie.idDataPersonnel = DataPersonnel.idDataPersonnel) order by idPersonnelPaie desc");
      if($cache == 'paiements-par-personnel') {
        $reqSql= ("SELECT * FROM PersonnelPaie, DataPersonnel WHERE (PersonnelPaie.idDataPersonnel = DataPersonnel.idDataPersonnel) and (DataPersonnel.idDataPersonnel = $idi) order by idPersonnelPaie desc");
        paiement_personnel($reqSql);
      }

      if($cache == 'paiements-personnel') {
        $reqSql= ("SELECT * FROM PersonnelPaie, DataPersonnel WHERE ((PersonnelPaie.idDataPersonnel = DataPersonnel.idDataPersonnel) and (`Date` BETWEEN '".$date1."' AND '".$date2."')) order by idPersonnelPaie desc");
        paiement_personnel($reqSql);
      }

      if($cache == 'perte-journaliere') {
        $reqSql= ("SELECT * FROM PerteOccaz WHERE (Dates = '".$date1."')  order by idPerteOccaz desc");
        perte_occasionnee($reqSql);
      } 

      if($cache == 'perte-periode') {
        $reqSql= ("SELECT * FROM PerteOccaz WHERE (`Dates` BETWEEN '".$date1."' AND '".$date2."')  order by idPerteOccaz desc");
        perte_occasionnee($reqSql);
      } 
    ?>
</main>
<div class="bg-light" id="superieur">
    <h1 id="croix">&cross;</h1>
    <div id="container"></div>
</div>
</body>
</html>