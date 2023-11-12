<?php


function dataVente(){
    $valeur = '';
    include 'connexion.php';
    $sql= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) GROUP BY Operation order by Operation desc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
        while($row= mysqli_fetch_assoc($result)){
            $valeur .= "<option value='ID ::".$row["Operation"].":: date ::".$row["DatesVente"].":: client  ::".$row["NomClient"].":: Total facture ::".$row["TotalFacture"]."'>client = ".$row["NomClient"]." dette : ".$row["Dette"]."</option>"; 
        }
   }else{$valeur = "Une erreur s est produite ";}  
   return $valeur;
}

$q = $_REQUEST["q"];

$autre = '';

    if ($q !== "") {
        $hint = dataVente();
    } else {
        $hint = 'erreur';
    }
    echo ''.$hint;
    

?>