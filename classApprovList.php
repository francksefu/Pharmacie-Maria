<?php
function dataVente($operation){
    include 'connexion.php';
    $sql= ("SELECT * FROM Approvisionnement, Produit WHERE (Approvisionnement.idProduit = Produit.idProduit)  and (Operation = $operation)");
    $result = mysqli_query($db, $sql);
    $valeur = '';
    if(mysqli_num_rows($result)>0){
      $valeur .= '<table class="table border border-1">
      <thead class="bg-transparent text-secondary">
      <tr>
                <th>Nom du produit</th>
                <th>Quantite achete</th>
                <th>Prix d achat unitaire</th>
                <th>Prix d achat total</th>
              </tr>
            </thead>
            <tbody>';
            $total = 0;
        while($row= mysqli_fetch_assoc($result)){
            $nomClient = $row["Source"];
            $date = $row["DatesApprov"];
            $total += $row["QuantiteApprov"] * $row["PrixA"];
            $valeur .= '
                <tr>
                    <td>
                        '.$row["Nom"].'
                    </td>
                    <td>'.$row["QuantiteApprov"].'</td>
                    <td>'.$row["PrixA"].'</td>
                    <td>'.$row["QuantiteApprov"] * $row["PrixA"].'</td>
                </tr>';
        }
        $valeur .= '</tbody>
        <h5 class=" mb-3 mt-3 ms-3"> date : '.$date.'</h5>
        <h3 class="text-center mb-3 mt-3"> source : '.$nomClient.'</h3>
        </table>
        <h3 class="text-center mb-3 mt-3"> total : '.$total.' Fc</h3>';
        return $valeur;

   }else{return "Une erreur s est produite ";}  

}

$q = $_REQUEST["q"];

$autre = '';

    if ($q !== "") {
        $hint = dataVente($q);
    } else {
        $hint = 'erreur';
    }
    echo ''.$hint;
    

?>