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
    <script defer src="./jsfile/ventesList.js"></script>
</head>
<?php
$date1 = $_POST["Date1"];
$date2 = $_POST["Date2"];
$cache = $_POST["Cache"];
$personnel = $_POST["Personnel"];
$facture = $_POST["Facture"];
$tabC = explode(":", $personnel);
$id = end($tabC);

function ventes($reqSql) {
    include 'connexion.php';
    $total_toute_facture = 0;
    $total_paye = 0;
    echo '<h2 class="mt-0 mb-2 text-center">Ventes</h2>';
    echo '<h2 class="mt-3 mb-2 text-center">Ventes</h2>';
    
    //$reqSql= ("SELECT * FROM Produit order by idProduit asc");
    $result= mysqli_query($db, $reqSql);
    if(mysqli_num_rows($result)>0){
        echo '<table class="table border border-1">
        <thead class="bg-secondary text-white">
        <tr>
            <th>Operation</th>
            <th>Date</th>
            <th>Client</th>
            <th>Total</th>
            <th>Payé</th>
            <th>Status</th>
            <th>Reste</th>
            <th>Action</th>
        </tr>
        </thead>';

        while($row= mysqli_fetch_assoc($result)){
            $status = '';
            $paye = 0;

            if($row["Dette"] == 'Oui') {
                $paye = $row["MontantPaye"];
            } else {
                $paye = $row["TotalFacture"];
            }
            if($row["Dette"] == 'Non') {
                $status = '<span class="bg-success p-2 rounded-3 text-white">Paid</span>';
            } else {
                $status = '<span class="bg-danger p-2 rounded-3 text-white">Not paid</span>';
            }
            echo'
        <tr>
        <td>'.$row["Operation"].'</td>
        <td>'.$row["DatesVente"].'</td>
        <td>'.$row["NomClient"].'</td>
        <td>'.$row["TotalFacture"].'</td>
        <td>'.$paye.'</td>
        <td>'.$status.'</td>
        <td>'.($row["TotalFacture"] - $paye).'</td>
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
                <div class="p-2 m-2 bg-danger text-white rounded-3" id="del">
                    <a href="#" class="text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                          </svg>
                    </a>
                </div>
                <div class="p-2 bg-primary m-2 text-white rounded-3 montre">
                    <a href="updateVentes.php" class="text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                        </svg>
                    </a>
                </div>  
            </div>
            
        </td>
      </tr>
      <tr>';
      $total_toute_facture += $row["TotalFacture"];
      $total_paye += ($row["TotalFacture"] - $paye);
        }
        echo'<h3 class="mt-4 mb-2 text-center">Total de toutes les factures : '.$total_toute_facture.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">Total montant deja payé : '.$total_paye.' $</h3>';
        echo'<h3 class="mt-2 mb-2 text-center">difference : '.$total_toute_facture - $total_paye.' $</h3>';
        echo"</table>";
    }else{echo "Pas des donnees dans la base ";}
}
?>

<body>
<main>
    <?php 
      if($cache == 'toute_vente') {
        $reqSq= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) and(DatesVente = $date1) GROUP BY Operation order by Operation desc");
        ventes($reqSq);
      }
    ?>
</main>
</body>
</html>