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
    
    <script defer src="./jsfile/jquery-3.6.1.min.js"></script>
    <script defer src="./jsfile/produit.js"></script>
    <script defer src="./jsfile/supprime.js"></script>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="vente.css">
   
    <script defer src="./jsfile/ventesList.js"></script>
    <style> img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] { display: none;} 
    </style>
</head>
<?php
$facture = $_POST["Facture"];
$tabFacture = explode("::", $facture);
$operation_bon = '';

if($tabFacture[0] != '') {
    $operation_bon = $tabFacture[1];
} else {
    $operation_bon = '';
}

function dataVente($operation){
    include 'connexion.php';
    $sql= ("SELECT * FROM Ventes, Produit, Client, DataPersonnel WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient and (DataPersonnel.idDataPersonnel = Ventes.idPersonnel)) and (Operation = $operation)");
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
                $status = '<span class="bg-danger p-2 rounded-3 text-white">Not paid : '.$row["TotalFacture"] - $paye.' Fc </span>';
            }

            $op = $row["Operation"];
            $nomClient = $row["NomClient"];
            $personnel = $row["NomP"];
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
        <h6 class=" mb-3 mt-3 ms-3"> nom du vendeur : '.$personnel.'</h6>
        <br />
        <div class="mb-2">'.$status.'<div>
        <br />
        </table>
        <h3 class="text-center mb-3 mt-3"> total : '.$total.' Fc</h3></div>';
        return $valeur;

   }else{return "Une erreur s est produite ";}  

}

function ventes_affichage_facture($reqSql) {
    include 'connexion.php';
    $total_toute_facture = 0;
    $total_paye = 0;
    $pa = 0;
    echo '<h2 class="mt-0 mb-2 text-center">Ventes</h2><a href="addVentes.php"> Retour </a>';
    
   
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
        
        echo"</table>";
    }else{echo "Pas des donnees dans la base ";}
}


?>
<body>
    <main>
        <?php
            $req= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(Operation = '".$operation_bon."') GROUP BY Operation order by Operation desc");
            ventes_affichage_facture($req);
        ?>
    </main>
</body>
</html>