<?php 
include 'identifiant.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
      include 'head.php';
    ?>
    <link rel="stylesheet" href="index.css">
    <script defer src="jsfile/takeApprov.js"></script>
    <style> img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] { display: none;} 
    </style>
    
</head>
<?php
//find id for vente to make a nmber of operation
function findIDVente(){
    include 'connexion.php';
    $sql= ("SELECT idApprov FROM Approvisionnement order by idApprov desc limit 1");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
      $valeur = 0;
        while($row= mysqli_fetch_assoc($result)){
            $valeur = $row["idApprov"];
        }
        
        return $valeur;

   }else{return "Une erreur s est produite ";}  

}
function data(){
    include 'connexion.php';
    $sql = ("SELECT * FROM `Change` order by idChange desc limit 1");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            return "ID ::".$row["idChange"].":: 1$ = ::".$row["Chilling"].":: chilling =  ::".$row["Rwandais"].":: rwandais= ::".$row["CDF"].":: Fc";
        }       
   }  
}
function dataProduct(){
    include 'connexion.php';
    $sql = ("SELECT * FROM Produit order by Nom asc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            echo"<option value='ID ::".$row["idProduit"].":: Nom ::".$row["Nom"].":: PA ::".$row["PrixAchat"].":: PV = ::".$row["PrixVente"].":: PVmin =::".$row["PrixVmin"].":: QstockMin = ::".$row["QuantiteStockMin"]."'>nom: ".$row["Nom"]." :Qstock ".$row["QuantiteStock"]."</option>"; 
        }
                
   }else{echo "Une erreur s est produite ";}  

}


?>
<body class="bg-light">
    <main>
        <div class="container bg-transparent pt-5">
            <h1 class="p-2">Ajouter Approvisionnement</h1>
            <hr class="w-auto">
            <form action="">
            <div class="row border border-1 mt-3 pt-3 w-75 d-block mx-auto">
                    <!-- -->
                    
                </div>
                <div class="input-group mb-3 pt-5 pb-4" id="ajoutons">
                    <a id="remove" href="#" class="text-decoration-none"><span class="input-group-text bg-danger text-white">&cross;</span></a>
                    <span class="input-group-text border border-primary">Nom</span>
                    <input id="produit" type="text" list="dataProduct" class="form-control border border-primary w-25" placeholder="Entrer nom du produit" aria-label="Username">
                      <datalist id="dataProduct">
                        <?php
                          dataProduct();
                        ?>
                      </datalist>
                    <span class="input-group-text border border-success">Quantite</span>
                    <input id="quantite" type="float" class="form-control border border-success" placeholder="Quantite" aria-label="Server">
                    <span class="input-group-text">PA Unitaire</span>
                    <input id="pvu" type="float" class="form-control" placeholder="prix d achat" aria-label="Server">
                    <span class="input-group-text">$</span>
                    <a id="add" href="#" class="text-decoration-none"><span class="input-group-text bg-success text-white">&plus;</span></a>
                    <a id="M-add" href="#" class="text-decoration-none"><span class="input-group-text bg-primary text-white">&check;</span></a>
                </div>
                <small id="produitVide"></small>
                <small id="quantiteVide"></small>
                <small id="pvuVide"></small>
                <small id="quantiteGrand"></small>
                <p id="txtHint1"></p>
                <table class="table border border-1">
                    <thead class="bg-transparent text-secondary">
                      <tr>
                        <th>Nom du produit</th>
                        <th>Quantite approvisionné</th>
                        <th>Prix d achat unitaire</th>
                        <th>Prix d achat total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                                              
                    </tbody>
                </table>
         
                <div class="row">
                    <div class="border border-1 p-4 col-md-4 m-2">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Le stock dans lequel vous travaillez</label>
                            <select class="form-select" id="inputGroupSelect01">
                              <option selected value="1">Stock 1</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Date*</span>
                            <input required type="date"  name="dates" id="date-vente" class="form-control w-50" placeholder="mettre la date" aria-label="Username" aria-describedby="nom" value="<?php $d = strtotime("today"); echo date('Y-m-d',$d); ?>">
                        </div>
                        <div class="input-group mb-3 border border-1 border-warning">
                            <span class="input-group-text" id="basic-addon1">Quantite en stock*</span>
                            <input id="qstock" readonly type="float" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <small>1 commande en cours ...</small>
                    </div>
  
                        <div class="border border-1 m-2 col-md-4">
                            <h4>Source</h4>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="status">source</label>
                                <select class="form-select" id="source">
                                  <option value="ailleur">ailleurs</option>
                                  <option value="stock2">stock2</option>
                                </select>
                                <button id="envoi" type="button" class="btn btn-primary">Valider</button>
                            </div>
                            <h4>Destination</h4>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="status">destination</label>
                                <select class="form-select" id="destination">
                                  <option value="stock1">stock1</option>
                                  <!--<option value="stock2">stock2</option>-->
                                </select>
                                
                            </div>
                            
                        </div>
                        <div class="border border-1 col-md-3 m-2 bg-warning moinClaire">
                            <h4 class="text-secondary">Calcul du total</h4>
                            <div class="input-group mb-3">
                                <input type="float" id="total" readonly class="form-control" placeholder="0.00" aria-label="Recipient's username" aria-describedby="basic-addon0">
                                <span class="input-group-text" id="basic-addon0">$</span>
                            </div>
                            <div class="input-group mb-3">
                                <input type="float" id="cdf" readonly class="form-control" placeholder="0.00" aria-label="Recipient's username" aria-describedby="basic-addon1">
                                <span class="input-group-text" id="basic-addon">Fc</span>
                            </div>
                            <div class="input-group mb-3">
                                <input type="float" id="chilling" readonly class="form-control" placeholder="0.00" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">chilling</span>
                            </div>
                            <div class="input-group mb-3">
                                <input type="float" id="rwandais" readonly class="form-control" placeholder="0.00" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">RWD</span>
                            </div>
   
                        </div>
                        
                  
                </div>
                <input type="hidden" id="change" value='<?php echo data(); ?>'>
            <!-- just using to make difference between add, remove, and update -->
                <input type="hidden" id="state" >
                <input type="hidden" id="identifiantM" value="">
                <input type="hidden" id="operation"/>
                <input type="hidden" id="typeForm" value="add" />
    </form>
        </div>
    </main>
</body>
</html>