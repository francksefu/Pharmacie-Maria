<?php
function dataOperation($stock){
    include 'connexion.php';
    if ($stock == 'stock1') {
        $sql= ("SELECT idVentes FROM Ventes order by idVentes desc limit 1");
    } else {
        $sql= ("SELECT idVentes FROM Ventes2 order by idVentes desc limit 1");
    }
    //$sql= ("SELECT idVentes FROM Ventes order by idVentes desc limit 1");
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
        $hint = dataOperation($q);
    } else {
        $hint = 'erreur';
    }
    echo ''.$hint;
?>