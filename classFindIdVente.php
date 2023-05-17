<?php
function dataOperation(){
    include 'connexion.php';
    $sql= ("SELECT idVentes FROM Ventes order by idVentes desc limit 1");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
      $valeur = 0;
        while($row= mysqli_fetch_assoc($result)){
            $valeur = $row["idVentes"];
        }
        
        return $valeur;

   }else{return "Une erreur s est produite ";}  

}

$q = $_REQUEST["q"];

$autre = '';

    if ($q !== "") {
        $hint = dataOperation();
    } else {
        $hint = 'erreur';
    }
    echo ''.$hint;
?>