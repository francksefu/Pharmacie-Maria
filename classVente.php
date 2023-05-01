<?php
function dataProduit($idProduit){
    include 'connexion.php';
    $sql= ("SELECT * FROM Produit WHERE idProduit = $idProduit");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
      $valeur = 0;
        while($row= mysqli_fetch_assoc($result)){
            $valeur = $row["QuantiteStock"];
        }
        
        return $valeur;

   }else{return "Une erreur s est produite ";}  

}

$q = $_REQUEST["q"];

$autre = '';

    if ($q !== "") {
        $hint = dataProduit($q);
    } else {
        $hint = 'erreur';
    }
    echo ''.$hint;
    

?>