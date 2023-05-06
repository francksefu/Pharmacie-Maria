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
    <script defer src="./jsfile/takeProduit.js"></script>
    <link rel="stylesheet" href="index.css">
</head>
<?php
function dataProduct(){
    include 'connexion.php';
    $sql = ("SELECT * FROM Produit order by Nom asc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            echo"<option value='ID ::".$row["idProduit"].":: Nom ::".$row["Nom"].":: PA ::".$row["PrixAchat"].":: PV = ::".$row["PrixVente"].":: PVmin =::".$row["PrixVmin"].":: Qstock = ::".$row["QuantiteStock"]."::QstockMin = ::".$row["QuantiteStockMin"].":: Description = ::".$row["DescriptionP"]."'>nom: ".$row["Nom"]." :Qstock ".$row["QuantiteStock"]."</option>"; 
        }
                
   }else{echo "Une erreur s est produite ";}  

}
?>
<body class="back">

    <main>
        <div class="container bg-transparent pt-5">
        
            <div class=" p-3 mb-5 border border-1 rounded mt-5" id="sa">
                <h2 class="p-2">Modifier produit</h2>
                <hr class="w-auto">
                <form class="ps-1 pe-1 pt-3 pb-3">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Choisir stock</label>
                        <select class="form-select" id="inputGroupSelect01">
                          <option selected value="1">Stock 1</option>
                        </select>
                      </div>
                      <div class="input-group mb-3  mx-auto d-block">
                        <span class="input-group-text " id="id">Identifiant*</span>
                        <input required type="text" list="dataBesoin" id="identifiantM" class="form-control w-50" placeholder="entrer identifiant" aria-label="Username" aria-describedby="nom" >
                            <datalist id="dataBesoin">
                                <?php 
                                    dataProduct();

                                ?>
                            </datalist>
                      </div>
                      <div class="row">
                        <div class="input-group mb-3 col-md-6">
                            <span class="input-group-text" id="basic-addon1">Nom*</span>
                            <input id="nom" required type="text" class="form-control" placeholder="Nom du produit" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <small id="nomVide"></small>
                        <div class="input-group mb-3 col-md-6"></div>
                      </div>
                      <div class="row">
                        <div class="input-group mb-3 col-md-6">
                            <span class="input-group-text">Prix d achat*</span>
                            <input id="pa" required type="float" class="form-control" placeholder="entrer prix d achat" aria-label="Amount (to the nearest dollar)">
                            <span class="input-group-text">$</span>
                        </div>
                        <small id="paVide"></small>
                        
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Prix de vente*</span>
                                <input id="pv" required type="float" class="form-control" placeholder="entrer prix de vente" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">$</span>
                            </div>
                            <small id="pvVide"></small>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Prix de vente minimum*</span>
                                <input id="pvmin" required type="float" class="form-control" placeholder="entrer prix de vente a ne pas depasser" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">$</span>
                            </div>
                            <small id="pvminVide"></small>  
                        </div>
                      
                        
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Quantite*</span>
                                <input id="quantite" required type="float"  class="form-control" placeholder="Entrer quantite" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <small id="quantiteVide"></small>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Quantite min*</span>
                                    <input id="quantitemin" required type="float"  class="form-control" placeholder="Entrer quantite" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <small id="quantiteminVide"></small>
                        </div>  
                      </div>
                      <div class="input-group">
                        <span class="input-group-text">Description du produit</span>
                        <textarea id="description" class="form-control" aria-label="With textarea" placeholder="Entrer description"></textarea>
                      </div>
                      <p id="txtHint"></p>
                      <input type="hidden" value="update" id="typeFormulaire">
                      <button id="envoi" type="button" class="btn btn-primary p-2 mt-4">Modifier produit</button>
                    
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