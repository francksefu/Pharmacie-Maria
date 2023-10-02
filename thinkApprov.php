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
    <script defer src="./jsfile/approvList.js"></script>
</head>
<?php
$date1 = $_POST["Date1"];
$date2 = $_POST["Date2"];
$cache = $_POST["Cache"];
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

// Group by Operation just Ventes, not for Paiements
function dataPaiementAffichageSynthetique($sql, $sqlP){
    include 'connexion.php';
    //$sql= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and (Operation = $operation)");
    $result = mysqli_query($db, $sql);
    $total_vente = 0;
    $operation_array = array("findOp");
    if(mysqli_num_rows($result)>0){
    
        while($row= mysqli_fetch_assoc($result)){
            $paye = 0;
            if($row["Dette"] == 'Oui') {
                $paye = $row["MontantPaye"];
            } else {
                $paye = $row["TotalFacture"];
            }
            array_push($operation_array, $row["Operation"]);
            $total_vente += $paye;
        }
       
        
   }else{$total_vente = 0;} 
   //$sqlP= ("SELECT * FROM Paiements WHERE (Operation = $operation)");
        $resultP = mysqli_query($db, $sqlP);
        $total_paie = 0;
        if(mysqli_num_rows($resultP)>0) {
            
          while($rowP= mysqli_fetch_assoc($resultP)) {
            if (array_search($rowP["Operation"],$operation_array)) {
                $total_paie += 0;
            } else {
                $total_paie += $rowP["Montant"];
            } 
          }
        } else { $total_paie = 0;}
        $vente_paiements = $total_paie + $total_vente;
        return $vente_paiements;
}

function ventes_resume($reqSql) {
    include 'connexion.php';
    $total_toute_facture = 0;
    $total_paye = 0;
    $result= mysqli_query($db, $reqSql);
    if(mysqli_num_rows($result)>0){
        

        while($row= mysqli_fetch_assoc($result)){
            $paye = 0;
            if($row["Dette"] == 'Oui') {
                $paye = $row["MontantPaye"];
            } else {
                $paye = $row["TotalFacture"];
            }
            $total_toute_facture += $row["TotalFacture"];
            $total_paye += ($paye);
        }
        return array($total_toute_facture, $total_paye);
    }else{return array(0, 0);}
}

function sortie_resume($reqSql) {
    include 'connexion.php';
    $total_sortie = 0;
    $result= mysqli_query($db, $reqSql);
    if(mysqli_num_rows($result)>0){
        
        while($row= mysqli_fetch_assoc($result)){
                
        $total_sortie += $row["Montant"];
        }
        return $total_sortie;
        
    }else{ return 0;}
}

function perteOccaz($sql){
    include 'connexion.php';
    $total = 0;
    //$sql = ("SELECT * FROM PerteOccaz order by idPerteOccaz desc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            $total += $row["Montant"];
        }
                
   }else{$total = 0;}  
   return $total;
}

/*function paiement_personnel_resume($reqSql) {
    include 'connexion.php';
    $total = 0;
    //$reqSql= ("SELECT * FROM PersonnelPaie, DataPersonnel WHERE (PersonnelPaie.idDataPersonnel = DataPersonnel.idDataPersonnel) order by idPersonnelPaie desc");
    $result= mysqli_query($db, $reqSql);
    if(mysqli_num_rows($result)>0){
  
        while($row= mysqli_fetch_assoc($result)){
            $total += $row["Montant"];
        }
        return $total;
    }else{ return 0;}
}*/

function bonusPerte_resume ($reqSql) {
    include 'connexion.php';
    $quantiteG = 0;
    $quantiteP = 0;
    
    $result= mysqli_query($db, $reqSql);
    if(mysqli_num_rows($result)>0){

        while($row= mysqli_fetch_assoc($result)){
        $quantiteG += $row["PrixVente"] * ($row["QuantiteGagne"]);
        $quantiteP += $row["PrixVente"] * ($row["QuantitePerdu"]);
        }
        $total = $quantiteG - $quantiteP;
        return $total;
    }else{ return 0;}

}

function paiements_resume($reqSql) {
    include 'connexion.php';
    $result= mysqli_query($db, $reqSql);
    if(mysqli_num_rows($result)>0){

        while($row= mysqli_fetch_assoc($result)){
            $total += $row["Montant"];
        }
        return $total;
    }else{return 0;}
}
function resume ($vente, $sortie, $paiement_personnel, $bonus_perte, $paiements, $paie, $perte) {
   $array_ventes = ventes_resume($vente);
   $total_vente = $array_ventes[0];
   $total_vente_cash = $array_ventes[1];
   $credit = $total_vente - $total_vente_cash;

   $total_sortie = sortie_resume($sortie);
   $total_paie_personnel = $paiement_personnel;
   $total_depenses = $total_sortie + $total_paie_personnel;

   $reste_balances = $total_vente_cash - $total_depenses;
    $perte_occaz = perteOccaz($perte);
   $pertes_occasionne = bonusPerte_resume($bonus_perte);

   $restes_cash_disponible = $reste_balances - $pertes_occasionne - $perte_occaz;

   /**
    * les ventes cash et les paiements (dette recouvertes), s ils sont
    *fait le memes jour il y a risque d incoherence car il y aura augmentation
    *dans le paiements et dans le montants en cash au meme moment, alors 
    *pour eviter cela, nous allons display les paiements normalement, mais au
    *moment du calcul final, nous crerons une fonction qui devra prendre en compte
    *cela eviter de display les donnees incoherente.
    *De cela nous aurons donc le vrai montant en cash additionnee des paiments et ce apres cela 
    *Que nous diminirons les differentes pertes.
    */

    $dette_recouverte = paiements_resume($paie);
    $total_net_pur_versement = dataPaiementAffichageSynthetique($vente, $paiements) - $total_depenses - $pertes_occasionne - $perte_occaz;

    $valeur = '
      <h2 class="mt-1 mb-5">SYNTHESE ACTIVITES JOURNALIERE</h2>
      <h2 class="mt-4 mb-3 text-center">SYNTHESE ACTIVITES JOURNALIERE</h2>
      <div class="border border-secondary redimentionne mt-3 mb-3">
      <table class="table border border-1">
      <thead class="bg-success text-white">
        <tr>
          <th>Libelle du mouvement</th>
          <th>Montant</th>
        </tr>
      </thead>
      <tbody>';
      $valeur .= '
        <tr>
            <td>TOTAL VENTE (cash + credit)</td>
            <td>
                '.$total_vente.' $
            </td>
        </tr>
        <tr>
            <td>VENTE CASH</td>
            <td>
                '.$total_vente_cash.' $
            </td>
        </tr>
        <tr>
            <td>VENTE CREDIT</td>
            <td>
               '.$credit.' $
            </td>
        </tr>
        <tr>
            <td>DEPENSES (les sorties depenses et les paiements du personnels)</td>
            <td>
                '.$total_sortie.'$ + '.$total_paie_personnel.' $ = '.$total_depenses.' $
            </td>
        </tr>
        <tr>
            <td>RESTE (Balances)</td>
            <td>
                '.$reste_balances.' $
            </td>
        </tr>
        <tr>
            <td>PERTES OCCASIONNEES (bons perte + perte occasionnees)</td>
            <td>
                '.$pertes_occasionne.' $ + '.$perte_occaz.' $ = '.$pertes_occasionne + $perte_occaz.' $
            </td>
        </tr>
        <tr>
            <td>RESTE / CASH DISPONIBLES</td>
            <td>
                '.$restes_cash_disponible.' $
            </td>
        </tr>
        <tr>
            <td>DETTE RECOUVREES</td>
            <td>
                '.$dette_recouverte.' $
            </td>
        </tr>
        <tr>
            <td>TOTAL NET PUR VERSEMENT (Cash encaisser)</td>
            <td>
                '.$total_net_pur_versement.' $
            </td>
        </tr></tbody></table></div>
    ';

    return $valeur;
}
?>
<body>
    <main>
        <?php
        if($cache == 'approvisionnements') {
            $reqSql0= ("SELECT * FROM Approvisionnement, Produit WHERE (Approvisionnement.idProduit = Produit.idProduit) and (DatesApprov = '".$date1."') GROUP BY Operation order by Operation desc limit 1000");
            approvisionnement($reqSql0);
          }
 
          if($cache == 'approvisionnements2') {
            $reqSql0= ("SELECT * FROM Approvisionnement, Produit WHERE (Approvisionnement.idProduit = Produit.idProduit) and (DatesApprov BETWEEN '".$date1."' AND '".$date2."') GROUP BY Operation order by Operation desc limit 1000");
            approvisionnement($reqSql0);
          }

          if($cache == 'resume-journaliere') {
            $ventes = ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente = '".$date1."') GROUP BY Operation order by Operation desc");
            $sortie = ("SELECT * FROM Sortie WHERE(DatesD = '".$date1."') order by idSortie desc");
            $paiement_personnel = 0;//("SELECT * FROM PersonnelPaie, DataPersonnel WHERE ((PersonnelPaie.idDataPersonnel = DataPersonnel.idDataPersonnel) and (`Date` BETWEEN '".$date1."' AND '".$date1."')) order by idPersonnelPaie desc");
            $bonus_perte = ("SELECT * FROM BonusPerte, Produit WHERE (DatesD = '".$date1."') and (BonusPerte.idProduit = Produit.idProduit) order by idBonusPerte desc");
            $paiements = ("SELECT * FROM Paiements, Ventes, Client WHERE (Paiements.Operation = Ventes.Operation) and (Client.idClient = Ventes.idClient) and (DatesPaie = '".$date1."') GROUP BY idPaiements order by idPaiements desc");
            $paie = ("SELECT * FROM Paiements WHERE  (DatesPaie = '".$date1."') order by idPaiements desc");
            $perte = ("SELECT * FROM PerteOccaz WHERE  (Dates = '".$date1."') order by idPerteOccaz desc");
            echo resume($ventes, $sortie, $paiement_personnel, $bonus_perte, $paiements, $paie, $perte);
          }

          if($cache == 'resume-periode') {
            $ventes = ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente BETWEEN '".$date1."' AND '".$date2."') GROUP BY Operation order by Operation desc");
            $sortie = ("SELECT * FROM Sortie WHERE(DatesD BETWEEN '".$date1."' AND '".$date1."') order by idSortie desc");
            $paiement_personnel = 0;//("SELECT * FROM PersonnelPaie, DataPersonnel WHERE ((PersonnelPaie.idDataPersonnel = DataPersonnel.idDataPersonnel) and (`Date` BETWEEN '".$date1."' AND '".$date2."')) order by idPersonnelPaie desc");
            $bonus_perte = ("SELECT * FROM BonusPerte, Produit WHERE (DatesD BETWEEN '".$date1."' AND '".$date2."') and (BonusPerte.idProduit = Produit.idProduit) order by idBonusPerte desc");
            $paiements = ("SELECT * FROM Paiements, Ventes, Client WHERE (Paiements.Operation = Ventes.Operation) and (Client.idClient = Ventes.idClient) and (DatesPaie BETWEEN '".$date1."' AND '".$date2."') GROUP BY idPaiements order by idPaiements desc");
            $paie = ("SELECT * FROM Paiements WHERE  (DatesPaie BETWEEN '".$date1."' AND '".$date2."') order by idPaiements desc");
            $perte = ("SELECT * FROM PerteOccaz WHERE  (Dates BETWEEN '".$date1."' AND '".$date2."') order by idPerteOccaz desc");
            echo resume($ventes, $sortie, $paiement_personnel, $bonus_perte, $paiements, $paie, $perte);
          }
        ?>
    </main>
    <div class="bg-light" id="superieur">
    <h1 id="croix">&cross;</h1>
        <div id="container"></div>
    </div>
</body>