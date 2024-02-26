<?php 
include 'identifiant.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'head.php'; ?>
    <link rel="stylesheet" href="index.css">
    <!--<script defer src="jsfile/datalist.js"></script>-->
    <script defer src="jsfile/takeVente.js"></script>
    <style> img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] { display: none;} 
    </style>
</head>
<?php

function dataVente(){
    include 'connexion.php';
    //$take = '';
    $sql= ("SELECT * FROM Ventes, Produit, Client, DataPersonnel WHERE (Produit.idProduit = Ventes.idProduit) and (Client.idClient = Ventes.idClient and (DataPersonnel.idDataPersonnel = Ventes.idPersonnel)) group by Operation order by Operation desc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
      $valeur = '';
        while($row= mysqli_fetch_assoc($result)){
            //
            $sql1= ("SELECT * FROM Ventes, Produit, Client WHERE (Operation = ".$row["Operation"].") and (Produit.idProduit = Ventes.idProduit) and (Client.idClient = Ventes.idClient) order by Operation desc");
            $result1 = mysqli_query($db, $sql1);
                    
            if(mysqli_num_rows($result1)>0){
            $valeur = '';
                while($row1= mysqli_fetch_assoc($result1)){
                    $valeur .= $row1["Operation"]."::".$row1["idClient"]."::".$row1["NomClient"]."::".$row1["idProduit"].":: Nom ::".$row1["Nom"].":: PA ::".$row1["PrixAchat"].":: PV = ::".$row1["PrixVente"].":: PVmin =::".$row1["PrixVmin"].":: QstockMin = ::".$row1["QuantiteStockMin"]."::".$row1["QuantiteVendu"]."::".$row1["PU"]."::".$row1["DatesVente"]."::".$row1["TotalFacture"]."::".$row1["MontantPaye"]."::ID ::".$row["idDataPersonnel"].":: Nom  ::".$row["NomP"].":: Main d oeuvre ::".$row["MainOeuvre"]."::Remise ::".$row["Remise"].":: Total materiel ::".$row["TotalMateriel"]."::__:";
                }

        }else{echo "Une erreur s est produite ";}  
        echo "<option value='".$valeur."'>operation : ".$row["Operation"]."client: ".$row["NomClient"]." :Totol :".$row["TotalFacture"]."</option>"; 
        }

   }else{echo "Une erreur s est produite ";}  
  //return $take;
}

function findIDVente(){
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
            echo"<option value='ID ::".$row["idProduit"].":: Nom ::".$row["Nom"].":: PA ::".$row["PrixAchat"].":: PV = ::".$row["PrixVente"].":: PVmin =::".$row["PrixVmin"].":: QstockMin = ::".$row["QuantiteStockMin"]."'>nom: ".$row["Nom"]." :Description ".$row["Description"]."</option>"; 
        }
                
   }else{echo "Une erreur s est produite ";}  

}

function dataDataPersonnel(){
    include 'connexion.php';
    $sql = ("SELECT * FROM DataPersonnel order by idDataPersonnel desc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            echo "<option value='ID ::".$row["idDataPersonnel"].":: Nom  ::".$row["NomP"].":: Telephone ::".$row["Telephone"]."'> = ".$row["Nom"]."</option>"; 
        }
                
   }else{echo "Une erreur s est produite ";} 
  
  }

function dataPersonnel(){
    include 'connexion.php';
    $sql = ("SELECT * FROM Client order by idClient desc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            echo"<option value='ID ::".$row["idClient"].":: Nom  ::".$row["NomClient"].":: Telephone ::".$row["Telephone"]."'> = ".$row["Nom"]."</option>"; 
        }
                
   }else{echo "Une erreur s est produite ";}  

}
?>
<body class="back">
    <main>
        <div class="container bg-transparent pt-5">
            <h1 class="p-2">Modifier ventes</h1>
            <hr class="w-auto">
            <form action="">
            <input type="hidden" id="check-datalist" value="updateVentes">
            <div class="input-group mb-3  mx-auto d-block">
                <span class="input-group-text " id="id">Identifiant*</span>
                <input required type="text" list="dataBesoin" id="identifiantM" class="form-control w-50" placeholder="entrer identifiant">
                    <datalist id="dataBesoin">
                    <?php
                        dataVente();
                    ?>
                    </datalist>
            </div>
            <div class="row border border-1 mt-3 pt-3 w-75 d-block mx-auto">
            
                    <div class="input-group mb-3" >
                        <div class="input-group mb-3" >
                            <span class="input-group-text" id="basic-addon1">Nom*</span>
                            <input required type="text" list="dataPersonnel" id="nomClient" class="form-control" placeholder="Nom du client" aria-label="Username" aria-describedby="basic-addon1">
                            <datalist id="dataPersonnel">
                              <?php
                                dataPersonnel();
                               ?>
                            </datalist>
                        </div>
                        <small id="clientVide"></small>
                    </div>
                    
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
                    <span class="input-group-text">PV Unitaire</span>
                    <input id="pvu" type="float" class="form-control" placeholder="prix de vente" aria-label="Server">
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
                        <th>Quantite vendu</th>
                        <th>Prix de vente unitaire</th>
                        <th>Prix de vente total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                                              
                    </tbody>
                </table>
         
                <div class="row">
                    <div class="border border-1 p-4 col-md-4 m-2">
                        <div class="input-group mb-3 ">
                            <span class="input-group-text">Nom du vendeur</span>
                            <input type="text" readonly id="personnel" list="dataPersonnel_" class="form-control" value="<?php echo $place_vente; ?>">
                            <datalist id="dataPersonnel_">
                            
                        </datalist>
                        <small id="personnelVide"></small>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Choisir stock</label>
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
                            <h4>Status</h4>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="status">status</label>
                                <select class="form-select" id="status">
                                  <option selected>en attente</option>
                                  <option value="paid">paye</option>
                                  <option value="dette">dette</option>
                                </select>
                                <button id="envoi" type="button" class="btn btn-primary">Valider</button>
                            </div>

                            <div class="input-group mb-3 ">
                                <span class="input-group-text">Main d oeuvre</span>
                                <input type="flaot" id="mainoeuvre" value="0" class="form-control"  aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">$</span>
                            </div>

                            <div class="input-group mb-3 ">
                                <span class="input-group-text">Remise</span>
                                <input type="flaot" id="remise" value="0" class="form-control"  aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text"> % </span>
                            </div>

                            <div class="input-group mb-3 ">
                                <span class="input-group-text">Total apres remise</span>
                                <input readonly type="flaot" id="total_remise_mainoeuvre" class="form-control"  aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text"> $ </span>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text">Montant</span>
                                <input type="float" id="montant"  class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">$</span>
                            </div>
                            <small id="montantVide"></small>
                            <div class="input-group mb-3 ">
                                <span class="input-group-text">Reste</span>
                                <input type="flaot" id="reste" class="form-control"  aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">$</span>
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
                <input type="hidden" id="operation" value="<?php echo findIDVente(); ?>" />
                <input type="hidden" id="typeForm" value="update" />
    </form>
        </div>
    </main>
</body>
</html>