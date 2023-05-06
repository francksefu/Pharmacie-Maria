<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion</title>
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
    <script defer src="navbar.js"></script>
    <script defer src="./jsfile/takePaiements.js"></script>
    <link rel="stylesheet" href="index.css">
</head>
<?php
function dataPaiements(){
    include 'connexion.php';
    $sql= ("SELECT * FROM Paiements, Ventes, Client WHERE (Paiements.Operation = Ventes.Operation) and (Client.idClient = Ventes.idClient) order by idPaiements desc");
    $result = mysqli_query($db, $sql);
           
    if(mysqli_num_rows($result)>0){
        while($row= mysqli_fetch_assoc($result)){
            echo"<option value='ID ::".$row["idPaiements"].":: operation ::".$row["Operation"].":: client  ::".$row["NomClient"].":: Total facture ::".$row["TotalFacture"].":: Dates vente ::".$row["DatesVente"].":: Montant du paiements ::".$row["Montant"].":: Date de paiements ::".$row["DatesPaie"].":: montant deja payE ::".$row["MontantPaye"]."'>client = ".$row["NomClient"]." dates de ce paiement : ".$row["DatesPaie"]."</option>"; 
        }
   }else{echo "Une erreur s est produite ";}  

}
function dataVentes(){
    include 'connexion.php';
    $sql = ("SELECT * FROM Ventes, Client WHERE (Ventes.idClient = Client.idClient) and (Dette = 'Oui')GROUP BY Operation order by Operation desc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            echo"<option value='ID ::".$row["Operation"].":: Date ::".$row["DatesVente"].":: client ::".$row["NomClient"].":: total = ::".$row["TotalFacture"].":: montant deja payé =::".$row["MontantPaye"]."'>nom: ".$row["NomClient"]." :total ".$row["TotalFacture"]."</option>"; 
        }
                
   }else{echo "Une erreur s est produite ";}  

}

?>
<body class="back">

    <main>
        <div class="container bg-transparent pt-5">
          
            <div class=" p-3 mb-5 border border-1 rounded mt-5" id="sa">
                <h2 class="p-2">Modifier paiements</h2>
                <hr class="w-auto">
                <form class="ps-1 pe-1 pt-3 pb-1 mb-5">
                <div class="input-group mb-3  mx-auto d-block">
                        <span class="input-group-text " id="id">Identifiant*</span>
                        <input required type="text" list="data" id="identifiantM" class="form-control w-50" placeholder="entrer identifiant" aria-label="Username" aria-describedby="nom" >
                            <datalist id="data">
                                <?php 
                                    dataPaiements();
                                ?>
                            </datalist>
                    </div>
                  <div class="input-group mb-3 col-md-6">
                    <span class="input-group-text" id="anne">Date*</span>
                    <input required type="date"  name="dates" id="date" class="form-control w-50" placeholder="mettre la date" aria-label="Username" aria-describedby="nom" value="<?php $d = strtotime("today"); echo date('Y-m-d',$d); ?>">
                  </div>
                <div class="input-group col-md-10 mt-3 mb-3">
                    <span class="input-group-text">choisir facture : </span>
                    <input type="text" id="facture" list="dataBesoin" class="form-control" placeholder="entrer la facture ou une information sur la facture, ensuite choisissez" >
                      <datalist id="dataBesoin">
                         <?php 
                            dataVentes();
                        ?>
                      </datalist>
                    <span class="input-group-text pointe" id="cross">&cross;</span>
                </div>
                <small id="factureVide"></small>
                      <div class="row">
                        
                        <div class="input-group mb-3 col-md-6">
                            <span class="input-group-text" id="anne">Montant a payer*</span>
                            <input value="0" id="montant" required type="float" placeholder="Entrer quantite gagne" class="form-control" aria-label="Username" aria-describedby="anne"> 
                        </div>
                        <small id="montantVide"></small>
                        
                      <p id="txtHint"></p>

                      <input type="hidden" value="update" id="typeFormulaire">
                      <button id="envoi" type="button" class="btn btn-primary p-2 mt-4 w-25">Modifier paiements</button>
                    
                </form>
            </div>
            
        </div>
    
    </main>

    <footer>
        <hr class="w-100">
        <p class="text-secondary text-center p-3">&copy; copyright Maria</p>
    </footer>
    
    <!--<script  src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>-->
</body>
</html>