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
    <link rel="stylesheet" href="imprime.css">
  
    <script defer src="./jsfile/ventesList.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script defer src="./jsfile/to_pdf.js"></script>
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

function toFixed($number, $decimals) {
  return number_format($number, $decimals, '.', "");
}
function data_initial($operation){
  include 'connexion.php';
  $sql= ("SELECT * FROM Ventes, Produit, Client, DataPersonnel WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient and (DataPersonnel.idDataPersonnel = Ventes.idPersonnel)) and (Operation = $operation)");
  $result = mysqli_query($db, $sql);  
  if(mysqli_num_rows($result)>0){
    
      while($row= mysqli_fetch_assoc($result)){
          
        $op = $row["Operation"];
        $nomClient = $row["NomClient"];
        $telephone = $row["Telephone"];
        $adresse = $row["Adresse"];
        $email = $row["Email"];
        $date = $row["DatesVente"];
        $total += $row["PT"];
        $code_postale = $row["CodePostale"];
        $total_facture = $row["TotalFacture"];
        $total_materiel = $row["TotalMateriel"];
        $mainoeuvre = $row["MainOeuvre"];
        $remise = $row["Remise"];
        $titre = $row["Titre"];
        $frais_expedition = $row["FraisExpedition"];
        $type = $row["Type"];
      }
      
      return array("operation" => $op, "nom_client" => $nomClient, "date" => $date, "code_postale" => $code_postale, "adresse" => $adresse, "email" => $email, "telephone" => $telephone, "total_materiel" => $total_materiel, "total_facture" => $total_facture, "remise" => $remise, "mainoeuvre" => $mainoeuvre, "titre" => $titre, "frais_expedition" => $frais_expedition, "type" => $type);

 }else{return "Une erreur s est produite ";}  

}
function dataVente($operation){
    include 'connexion.php';
    $sql= ("SELECT * FROM Ventes, Produit, Client, DataPersonnel WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient and (DataPersonnel.idDataPersonnel = Ventes.idPersonnel)) and (Operation = $operation)");
    $result = mysqli_query($db, $sql);
    $valeur = '';  
    if(mysqli_num_rows($result)>0){
      $valeur .= '<div id="print" class="p-3"><div class="border border-secondary w-100 mt-3 mb-3">
      <div class="row ps-3 pe-3">
        <div class="col-md-6 hauteur bg-light text-dark">
            <h1 class="text-secondary mt-3 mb-3 text-center">SARBOJ ENERGY</h1>
            
        </div> 
        <div class="col-md-6 hauteur bg-info text-dark">
            <h1 class="text-secondary mt-3 mb-3 text-center"> '.data_initial($operation)["type"].'</h1>
            <h6><span> Nom du client</span> : <span> '.data_initial($operation)["nom_client"].' </span></h6>
            <h6><span> Numero facture </span> : <span>'.data_initial($operation)["operation"].' </span> </h6>
            <h6><span> Date </span> : <span> '.data_initial($operation)["date"].' </span> </h6>
           
        </div>
      </div>
      <h1 class="text-light bg-secondary pt-3 pb-3 text-center"> '.data_initial($operation)["titre"].' </h1>
      <div class="row">
        <div class="col-md-6 p-3">
          <h6><span> Adresse</span> : <span> Quartier Les volcans, Avenue Du port numero 006</span></h6>
          <h6><span> Code postal </span> :  </h6>
          <h6><span> Ville </span> : <span> Goma / DRC </span> </h6>
          <h6><span> Telephone </span> : <span> +243 973 087 726 </span> </h6>
          <h6><span> Email </span> : <span> sarbojenergy@gmail.com </span> </h6>
          <h6><span> Email </span> : <span> sarutidieumerci@gmail.com </span> </h6>
        </div> 
        <div class="col-md-6">
          <h6><span> Nom du client</span> : <span> '.data_initial($operation)["nom_client"].' </span></h6>
          <h6><span> Telephone du client </span> : <span> '.data_initial($operation)["telephone"].' </span> </h6>
          <h6><span> Adresse du client </span> : <span> '.data_initial($operation)["adresse"].' </span> </h6>
          <h6><span> Email du client </span> : <span> '.data_initial($operation)["email"].' </span> </h6>
        </div>
      </div>
      <table class="table border border-1">
      <thead class="bg-secondary text-white">
      <tr>
            <th>Description</th>
            <th>Quantite</th>
            <th>Prix unitaire HT</th>
            <th>Prix total HT</th>
        </tr>
      </thead>
    <tbody>';
    
        while($row= mysqli_fetch_assoc($result)){
            
            $valeur .= '
                <tr>
                    <td>'.$row["Nom"].'</td>
                    <td>
                        '.$row["QuantiteVendu"].'
                    </td>
                    <td>'.$row["PU"].'</td>
                    <td>'.$row["PT"].'</td>
                </tr>';
        }
      
        $valeur .= '</tbody>
       
        </table>
        <section class="row p-3 mt-0 text-secondary">
          <h5 class="text-light bg-secondary col-md-4 border  m-0">Remarques et instructions de paiement :</h5>
          <h3 class="text-secondary col-md-4 border m-0"> SOUS-TOTAL : </h3>
          <h3 class="text-secondary text-center col-md-4 border m-0 bg-warning"> '.data_initial($operation)["total_materiel"].'  </h3>
          <div class="col-md-4 border p-0 m-0 text-secondary">
            <h5 class="border m-0"> A inclure ici</h5>
            <p class="border m-0"> L’indemnité forfaitaire pour frais de recouvrement en cas de retard de paiement</p>
            <p class="border m-0"> Compte bancaire : Equity BCDC <br>028100000060497 </p>
          </div>
          <h2 class="col-md-4 border m-0 text-center"> Remise :</h2>
          <div class="col-md-4 border p-0 m-0 text-secondary">
            <h5 class="border m-0 text-danger text-center"> '.data_initial($operation)["remise"].' %</h5>
            <h5 class="m-0 text-center mt-3"> '.data_initial($operation)["total_materiel"]*1 * (data_initial($operation)["remise"] / 100) .'</h5>
          </div>
          <h5 class="col-md-4 border m-0 text-center"> </h5>
          <h5 class="col-md-4 border m-0 text-center p-2"> Sous total moins remise</h5>
          <h5 class="col-md-4 border m-0 text-center"> '.(data_initial($operation)["total_materiel"]) - (data_initial($operation)["remise"] * (data_initial($operation)["total_materiel"] / 100)) .' </h5>

          <h5 class="col-md-4 border m-0 text-center"> </h5>
          <h5 class="col-md-4 border m-0 text-center"> Main d oeuvre</h5>
          <h5 class="col-md-4 border m-0 text-center"> '.data_initial($operation)["mainoeuvre"].' </h5>

          <h5 class="col-md-4 border m-0 text-center"> </h5>
          <h5 class="col-md-4 border m-0 text-center"> frais d expédition </h5>
          <h5 class="col-md-4 border m-0 text-center"> '.data_initial($operation)["frais_expedition"].' </h5>

          <h5 class="col-md-4 border m-0 text-center"> </h5>
          <h4 class="col-md-4 border m-0 text-center text-dark p-3"> Somme total a payer </h4>
          <h2 class="col-md-4 border m-0 text-center pt-3"> '.data_initial($operation)["total_facture"].' </h2>
        </section>
        <div class="row">
          <div class="col-md-3 border border-1">
          </div>
          <div class="col-md-3 border border-1">
          </div>
          <div class="col-md-3 border border-1">
          </div>
        </div>';
        return $valeur;
     
   }else{return "Une erreur s est produite ";}  
  
}

function ventes_affichage_facture($reqSql) {
    include 'connexion.php';
    $total_toute_facture = 0;
    $total_paye = 0;
    $pa = 0;
    echo '<h2 class="mt-0 mb-2 text-center"></h2>';
    
   
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