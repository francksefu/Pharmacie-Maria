<?php
/**
 * file create for make dataliste updated directely
 */

 function dataProduct(){
    include 'connexion.php';
    $take = '';
    $sql = ("SELECT * FROM Produit order by Nom asc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            $take .= "<option value='ID ::".$row["idProduit"].":: Nom ::".$row["Nom"].":: PA ::".$row["PrixAchat"].":: PV = ::".$row["PrixVente"].":: PVmin =::".$row["PrixVmin"].":: Qstock = ::".$row["QuantiteStock"]."::QstockMin = ::".$row["QuantiteStockMin"].":: Description = ::".$row["DescriptionP"]."'>nom: ".$row["Nom"]." :Qstock ".$row["QuantiteStock"]."</option>"; 
        }
                
   }else{$take = "Une erreur s est produite ";} 
   
   return $take;

}

function dataVente(){
    include 'connexion.php';
    $take = '';
    $sql= ("SELECT * FROM Ventes, Produit, Client WHERE (Produit.idProduit = Ventes.idProduit) and (Client.idClient = Ventes.idClient) group by Operation order by Operation desc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
      $valeur = '';
        while($row= mysqli_fetch_assoc($result)){
            //
            $sql1= ("SELECT * FROM Ventes, Produit, Client WHERE (Operation = ".$row["Operation"].") and (Produit.idProduit = Ventes.idProduit) and (Client.idClient = Ventes.idClient) order by Operation desc");
            $result1 = mysqli_query($db, $sql1);
                    
            if(mysqli_num_rows($result1)>0){
            $valeur = '';
                while($row1= mysqli_fetch_assoc($result1)){
                    $valeur .= $row1["Operation"]."::".$row1["idClient"]."::".$row1["NomClient"]."::".$row1["idProduit"].":: Nom ::".$row1["Nom"].":: PA ::".$row1["PrixAchat"].":: PV = ::".$row1["PrixVente"].":: PVmin =::".$row1["PrixVmin"].":: QstockMin = ::".$row1["QuantiteStockMin"]."::".$row1["QuantiteVendu"]."::".$row1["PU"]."::".$row1["DatesVente"]."::".$row1["TotalFacture"]."::".$row1["MontantPaye"]."::__:";
                }

        }else{echo "Une erreur s est produite ";}  
        $take .= "<option value='".$valeur."'>operation : ".$row["Operation"]."client: ".$row["NomClient"]." :Totol :".$row["TotalFacture"]."</option>"; 
        }

   }else{$take = "Une erreur s est produite ";}  
  return $take;
}

function dataPersonnel(){
    include 'connexion.php';
    $take = '';
    $sql = ("SELECT * FROM Client order by idClient desc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            $take .= "<option value='ID ::".$row["idClient"].":: Nom  ::".$row["NomClient"].":: Telephone ::".$row["Telephone"]."'> = ".$row["NomClient"]."</option>"; 
        }
                
   }else{$take = "Une erreur s est produite ";} 
   return $take;

}

function dataDataPersonnel(){
  include 'connexion.php';
  $take = '';
  $sql = ("SELECT * FROM DataPersonnel order by idDataPersonnel desc");
  $result = mysqli_query($db, $sql);
          
  if(mysqli_num_rows($result)>0){
                      
      while($row= mysqli_fetch_assoc($result)){
          $take .= "<option value='ID ::".$row["idDataPersonnel"].":: Nom  ::".$row["Nom"].":: Telephone ::".$row["Telephone"]."'> = ".$row["Nom"]."</option>"; 
      }
              
 }else{$take = "Une erreur s est produite ";} 
 return $take;

}

function dataCaisseOut(){
    include 'connexion.php';
    $take = '';
    $sql = ("SELECT * FROM Sortie order by idSortie desc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            $take .= "<option value='ID ::".$row["idSortie"].":: Montant ::".$row["Montant"].":: Motif  ::".$row["il_pris_quoi"].":: Type ::".$row["TypeD"].":: Dates ::".$row["DatesD"]."'>montant = ".$row["Montant"]." commentaire : ".$row["il_pris_quoi"]."</option>"; 
        }
                
   }else{$take = "Une erreur s est produite ";}  

}

function dataPersoPaie(){
  include 'connexion.php';
  $take = '';
  $sql = ("SELECT * FROM PersonnelPaie, DataPersonnel WHERE (PersonnelPaie.idDataPersonnel = DataPersonnel.idDataPersonnel) order by idPersonnelPaie desc");
  $result = mysqli_query($db, $sql);
          
  if(mysqli_num_rows($result)>0){
                      
      while($row= mysqli_fetch_assoc($result)){
          $take .= "<option value='ID ::".$row["idPersonnelPaie"].":: dates  ::".$row["Date"].":: Nom ::".$row["Nom"].":: Montant ::".$row["Montant"].":: Mois ::".$row["Mois"].":: iDPerso ::".$row["idDataPersonnel"].":: Observation ::".$row["Observation"].":: Telephone ::".$row["Telephone"]."'> = ".$row["Nom"].":".$row["Montant"]." $ mois:".$row["Mois"]."</option>"; 
      }
              
 }else{$take = "Une erreur s est produite ";} 
 return $take;

}

function dataPerteOccaz(){
  include 'connexion.php';
  $take = '';
  $sql = ("SELECT * FROM PerteOccaz order by idPerteOccaz desc");
  $result = mysqli_query($db, $sql);
          
  if(mysqli_num_rows($result)>0){
                      
      while($row= mysqli_fetch_assoc($result)){
          $take .= "<option value='ID ::".$row["idPerteOccaz"].":: Montant ::".$row["Montant"].":: Motif  ::".$row["Commentaire"].":: Dates ::".$row["Dates"]."'>montant = ".$row["Montant"]." commentaire : ".$row["Commentaire"]."</option>"; 
      }
              
 }else{$take .= "Une erreur s est produite ";}  
  return $take;
}

$q = $_REQUEST["q"];

$autre = '';

  if ($q !== "") {
        //$hint = dataProduct();
        switch($q) {
          case 'updateProduct':
            $hint = dataProduct();
          break;
          case 'updateVentes':
            $hint = dataVente();
          break;
          case 'updatePersonnel':
            $hint = dataPersonnel();
          break;
          case 'updateDataPersonnel' :
            $hint = dataDataPersonnel();
          break;
          case 'updatePerteOccaz' :
            $hint = dataPerteOccaz();
          break;
          case 'updatePersoPaie' :
            $hint = dataPersoPaie();
          break;
        }
  } else {
        $hint = 'erreur';
  }
    echo ''.$hint;
?>