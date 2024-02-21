<?php
function dataVente($operation){
    include 'connexion.php';
    $valeur = '';
    $sql= ("SELECT * FROM Ventes, Produit, Client, DataPersonnel WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient and (DataPersonnel.idDataPersonnel = Ventes.idPersonnel)) and (Operation = $operation)");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
      $valeur .= '<h2 class="text-center">Facture</h2>
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
            $nomClient = $row["NomClient"];
            $date = $row["DatesVente"];
            $personnel = $row["NomP"];
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
        <h5 class=" mb-3 mt-3 ms-3"> date : '.$date.'</h5>
        <h3 class=" mb-3 mt-3 ms-3"> client : '.$nomClient.'</h3>
        <h6 class=" mb-3 mt-3 ms-3"> nom du vendeur : '.$personnel.'</h6>
        </table>
        <h3 class="text-center mb-3 mt-3"> total : '.$total.' $</h3>';
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