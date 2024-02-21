<?php 
include 'identifiant.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'head.php'; ?>
    <script defer src="./jsfile/takeBonusPerte.js"></script>
    <link rel="stylesheet" href="index.css">
    <style> img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] { display: none;} 
    </style>
</head>
<?php
  function dataProduct(){
    include 'connexion.php';
    $sql = ("SELECT * FROM Produit order by Nom asc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            echo"<option value='ID ::".$row["idProduit"].":: Nom ::".$row["Nom"].":: PA ::".$row["PrixAchat"].":: PV = ::".$row["PrixVente"].":: PVmin =::".$row["PrixVmin"].":: Qstock = ::".$row["QuantiteStock"]."'>nom: ".$row["Nom"]." :Qstock ".$row["QuantiteStock"]."</option>"; 
        }
                
   }else{echo "Une erreur s est produite ";}  

}

function dataBonusPerte(){
    include 'connexion.php';
    $sql= ("SELECT * FROM BonusPerte, Produit WHERE (BonusPerte.idProduit = Produit.idProduit) order by idBonusPerte desc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            echo"<option value='ID ::".$row["idBonusPerte"].":: date ::".$row["DatesD"].":: Nom ::".$row["Nom"].":: QG = ::".$row["QuantiteGagne"].":: QP =::".$row["QuantitePerdu"].":: Motif = ::".$row["Motif"]."::ID ::".$row["idProduit"].":: Nom ::".$row["Nom"].":: PA ::".$row["PrixAchat"].":: PV = ::".$row["PrixVente"].":: PVmin =::".$row["PrixVmin"].":: Qstock = ::".$row["QuantiteStock"]."'>QG: ".$row["QuantiteGagne"]." :QP ".$row["QuantitePerdu"]."</option>"; 
        }
                
   }else{echo "Une erreur s est produite ";}  

}
?>
<body class="back">

    <main>
    
    <div class="container bg-transparent pt-5">
          
          <div class=" p-3 mb-5 border border-1 rounded mt-5" id="sa">
              <h2 class="p-2">Modifier bonus ou perte</h2>
              <hr class="w-auto">
              <form class="ps-1 pe-1 pt-3 pb-1 mb-5">
              <div class="input-group mb-3  mx-auto d-block">
                        <span class="input-group-text " id="id">Identifiant*</span>
                        <input required type="text" list="dataBesoin" id="identifiantM" class="form-control w-50" placeholder="entrer identifiant" aria-label="Username" aria-describedby="nom" >
                            <datalist id="dataBesoin">
                                <?php 
                                    dataBonusPerte();

                                ?>
                            </datalist>
                    </div>
                <div class="input-group mb-3 col-md-6">
                  <span class="input-group-text" id="anne">Date*</span>
                  <input required type="date"  name="dates" id="date" class="form-control w-50" placeholder="mettre la date" aria-label="Username" aria-describedby="nom" value="<?php $d = strtotime("today"); echo date('Y-m-d',$d); ?>">
                </div>
              <div class="input-group col-md-10 mt-3 mb-3">
                  <span class="input-group-text">choisir produit : </span>
                  <input type="text" id="produit" list="dataProduct" class="form-control" placeholder="entrer le nom du produit ou une information sur le produit, ensuite choisissez" >
                    <datalist id="dataProduct">
                       <?php 
                          dataProduct();
                      ?>
                    </datalist>
                  <span class="input-group-text pointe" id="cross">&cross;</span>
              </div>
              <small id="produitVide"></small>
                    <div class="row">
                      
                      <div class="input-group mb-3 col-md-6">
                          <span class="input-group-text" id="anne">Quantite regagné(remplissage)*</span>
                          <input value="0" id="quantite-gagne" required type="float" placeholder="Entrer quantite gagne" class="form-control" aria-label="Username" aria-describedby="anne"> 
                      </div>
                      <small id="quantiteGVide"></small>
                      <div class="input-group mb-3 col-md-6">
                          <span class="input-group-text" id="anne">Quantite perdu*</span>
                          <input value="0" id="quantite-perdu" required type="float" placeholder="Entrer quantite perdu" class="form-control" aria-label="Username" aria-describedby="anne"> 
                      </div>
                      <small id="quantitePVide"></small>
                    </div>
                    <div class="row">
                      <div class="input-group mb-3 col-md-6">
                          <span class="input-group-text">Motif :*</span>
                          <textarea id="motif" class="form-control" aria-label="With textarea" placeholder="Entrer motif"></textarea>
                        </div>
                    </div>
                    <p id="txtHint"></p>
                    
                    <input type="hidden" value="update" id="typeFormulaire">
                    <button id="envoi" type="button" class="btn btn-primary p-2 mt-4">Modifier bonus et perte</button>
                  
              </form>
          </div>
          
      </div>
  
    
    </main>

    <footer>
        <hr class="w-100">
        <p class="text-secondary text-center p-3">&copy; copyright franck</p>
    </footer>
   
</body>
</html>
