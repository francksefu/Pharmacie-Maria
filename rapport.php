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
    <link rel="stylesheet" href="index.css">
    <script defer src="jsfile/rapport.js"></script>
</head>
<?php
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

/*function dataPersoPaie(){
  include 'connexion.php';
  $sql = ("SELECT * FROM PersonnelPaie, DataPersonnel WHERE (PersonnelPaie.idDataPersonnel = DataPersonnel.idDataPersonnel) order by idPersonnelPaie desc");
  $result = mysqli_query($db, $sql);
          
  if(mysqli_num_rows($result)>0){
                      
      while($row= mysqli_fetch_assoc($result)){
          echo "<option value='ID ::".$row["idPersonnelPaie"].":: dates  ::".$row["Date"].":: Nom ::".$row["Nom"].":: Montant ::".$row["Montant"].":: Mois ::".$row["Mois"].":: iDPerso ::".$row["idDataPersonnel"].":: Observation ::".$row["Observation"].":: Telephone ::".$row["Telephone"]."'> = ".$row["Nom"].":".$row["Montant"]." $ mois:".$row["Mois"]."</option>"; 
      }
              
 }else{echo "Une erreur s est produite ";} 

}*/

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

function dataVente(){
  include 'connexion.php';
  $sql= ("SELECT * FROM Ventes, Produit, Client WHERE (Ventes.idProduit = Produit.idProduit) and (Client.idClient = Ventes.idClient) GROUP BY Operation order by Operation desc");
  $result = mysqli_query($db, $sql);
          
  if(mysqli_num_rows($result)>0){
      while($row= mysqli_fetch_assoc($result)){
          echo"<option value='ID ::".$row["Operation"].":: date ::".$row["DatesVente"].":: client  ::".$row["NomClient"].":: Total facture ::".$row["TotalFacture"]."'>client = ".$row["NomClient"]." dette : ".$row["Dette"]."</option>"; 
      }
 }else{echo "Une erreur s est produite ";}  

}
?>
<body class="bg-light">
   
    <main>
        <div class="container bg-transparent pt-5" >
            <div class="row bg-transparent pt-5">
                <div class="col-md-6 bg-transparent m-2">
                    <h2>Rapports</h2>
                    <p class=" text-secondary pt-3">
                        Le rapport est une page qui permet de voir l evolution des ses activités sur une periode 
                        que vous determinez vous meme.
                </div>
            </div>
        </div>
 
        <div class="container-fluid pt-5 bg-transparent">
           <div class="row">
            <!--Button left-->
            <div class="col-md-2">
                <div class="dropdown mt-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      ventes affichage synthetique
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li id="toute-vente"><a class="dropdown-item" href="#">Toutes les ventes</a></li>
                      <li id="paye-cache"><a class="dropdown-item" href="#">ventes payé cache</a></li>
                      <li id="vente-dette"><a class="dropdown-item" href="#">ventes accordé en dette</a></li>
                      <li id="vente-sortie"><a class="dropdown-item" href="#">ventes et sortie</a></li>
                    </ul>
                </div>
                <div class="dropdown mt-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1F" data-bs-toggle="dropdown" aria-expanded="false">
                      ventes affichage factures
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li id="toute-vente-facture"><a class="dropdown-item" href="#">Toutes les ventes</a></li>
                      <li id="paye-cache-facture"><a class="dropdown-item" href="#">ventes payé cache</a></li>
                      <li id="vente-dette-facture"><a class="dropdown-item" href="#">ventes accordé en dette</a></li>
                    </ul>
                </div>
                
                <div class="dropdown mt-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      Sortie
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li id="toutes-sortie"><a class="dropdown-item" href="#">Toutes les sorties</a></li>
                      <li id="trie-dette"><a class="dropdown-item" href="#">Trie par dette</a></li>
                      <li id="trie-depenses"><a class="dropdown-item" href="#">Trie par depenses</a></li>
                      <li id="trie-charge"><a class="dropdown-item" href="#">Trie par charge</a></li>
                      <li id="trie-inutile"><a class="dropdown-item" href="#">Trie par inutile</a></li>
                    </ul>
                </div>
                <button id="bonusOuPerte" class="btn btn-secondary  mt-3">Bonus ou perte</button>
                <button id="approv" class="btn btn-secondary  mt-3">Approvisionnement</button>
                <div class="dropdown mt-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      Paiements
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li id="paiements"><a class="dropdown-item" href="#">Tous les paiements</a></li>
                      <li id="paiements-client"><a class="dropdown-item" href="#">Paiements par clients</a></li>
                      <li id="paiements-facture"><a class="dropdown-item" href="#">Paiements par factures</a></li>
                    </ul>
                </div>
                <div class="dropdown mt-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuBres1" data-bs-toggle="dropdown" aria-expanded="false">
                      Perte Occasionnées
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonres1">
                      <li id="perte-journaliere"><a class="dropdown-item" href="#">Journaliere</a></li>
                      <li id="perte-periode"><a class="dropdown-item" href="#">entre 2 dates</a></li>
                    </ul>
                </div>
                <div class="dropdown mt-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuBres" data-bs-toggle="dropdown" aria-expanded="false">
                      Resume
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonres1">
                      <li id="resume-journaliere"><a class="dropdown-item" href="#">Journaliere</a></li>
                      <li id="resume-periode"><a class="dropdown-item" href="#">entre 2 dates</a></li>
                    </ul>
                </div>
               
                <div class="dropdown mt-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuBresk" data-bs-toggle="dropdown" aria-expanded="false">
                      Prediction
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonres1k">
                      
                      <li id="prediction-periode"><a class="dropdown-item" href="#">Tendance des données</a></li>
                    </ul>
                </div>
            </div>

            <!--Form between-->
            <div class="col-md-7 m-2 ps-3">
                <div class="border border-1">
                  <form action="think.php" method="POST">
                    <p class="border border-1 text-center ft-3 text-secondary" id="paragraphe"></p>
                      <div class="input-group mb-3 col-md-5" id="cont-date1">
                          <span class="input-group-text" id="basic-addon1">Date1*</span>
                          <input required type="date"  name="Date1" id="date1" class="form-control w-50" placeholder="mettre la date" aria-label="Username" aria-describedby="nom" >
                      </div>
                      <div class="input-group mb-3 col-md-5" id="cont-date2">
                            <span class="input-group-text" id="basic-addon1">Date2*</span>
                            <input required type="date"  name="Date2" id="date2" class="form-control w-50" placeholder="mettre la date" aria-label="Username" aria-describedby="nom" >
                        </div>
                        <div class="input-group  mt-3 mb-3" id="cont-input1">
                          <span class="input-group-text">choisir : </span>
                          <input type="text" name="Personnel" id="input-1" list="dataPersonnel" class="form-control" placeholder="entrer le nom du client ou une information sur le produit, ensuite choisissez" >
                            <datalist id="dataPersonnel">
                              <?php 
                                dataPersonnel();
                              ?>
                            </datalist>
                          <span class="input-group-text pointe" id="cross">&cross;</span>
                      </div>
                      <div class="input-group  mt-3 mb-3" id="cont-input2">
                          <span class="input-group-text">choisir : </span>
                          <input type="text" name="Facture" id="input-2" list="dataFacture" class="form-control" placeholder="entrer le nom d un client ou une information sur la vente, ensuite choisissez" >
                            <datalist id="dataFacture">
                              <?php 
                                 dataVente();
                              ?>
                            </datalist>
                          <span class="input-group-text pointe" id="cross">&cross;</span>
                      </div>
                      <div class="input-group  mt-3 mb-3" id="cont-input3">
                          <span class="input-group-text">choisir : </span>
                          <input type="text" name="Produit" id="input-3" list="dataPerso" class="form-control" placeholder="entrer le nom d un personnel" >
                            <datalist id="dataPerso">
                              <?php 
                                 dataProduct();
                              ?>
                            </datalist>
                          <span class="input-group-text pointe" id="cross">&cross;</span>
                      </div>

                     <input type="hidden" id="type" name="Cache">
                     <button type="submit" class="btn btn-primary" id="envoi">Soumettre</button> 
                  </form>
                </div>
            </div>
            <!--Button right-->
            <div class="col-md-2">
                <div class="dropdown mt-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      ventes affichage synthetique
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li id="toute-vente2"><a class="dropdown-item" href="#">Toutes les ventes</a></li>
                      <li id="paye-cache2"><a class="dropdown-item" href="#">ventes payé cache</a></li>
                      <li id="vente-dette2"><a class="dropdown-item" href="#">ventes accordé en dette</a></li>
                      <li id="vente-sortie2"><a class="dropdown-item" href="#">ventes et sortie</a></li>
                    </ul>
                </div>
                <div class="dropdown mt-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      ventes affichage factures
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li id="toute-vente2-facture"><a class="dropdown-item" href="#">Toutes les ventes</a></li>
                      <li id="paye-cache2-facture"><a class="dropdown-item" href="#">ventes payé cache</a></li>
                      <li id="vente-dette2-facture"><a class="dropdown-item" href="#">ventes accordé en dette</a></li>
                    </ul>
                </div>
                <div class="dropdown mt-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      ventes affichage tableaux
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li id="toute-vente2-tableau"><a class="dropdown-item" href="#">Toutes les ventes</a></li>
                    </ul>
                </div>
                <div class="dropdown mt-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      Sortie
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li id="toutes-sortie2"><a class="dropdown-item" href="#">Toutes les sorties</a></li>
                      <li id="trie-dette2"><a class="dropdown-item" href="#">Trie par dette</a></li>
                      <li id="trie-depenses2"><a class="dropdown-item" href="#">Trie par depenses</a></li>
                      <li id="trie-charge2"><a class="dropdown-item" href="#">Trie par charge</a></li>
                      <li id="trie-inutile2"><a class="dropdown-item" href="#">Trie par inutile</a></li>
                    </ul>
                </div>
                <button id="bonusOuPerte2" class="btn btn-secondary  mt-3">Bonus ou perte</button>
               
                <button id="approvisionnement2" class="btn btn-secondary  mt-3">Approvisionnement</button>
                <div class="dropdown mt-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      Clients
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li id="toutes-facture"><a class="dropdown-item" href="#">Toutes les factures du client</a></li>
                      <li id="facture-2-dates"><a class="dropdown-item" href="#">factures du clients entre 2 dates</a></li>
                      <li id="facture-dette"><a class="dropdown-item" href="#">factures non reglé du client</a></li>
                    </ul>
                </div>
                <div class="dropdown mt-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      Paiements
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li id="paiements2"><a class="dropdown-item" href="#">Tous les paiements</a></li>
                      <li id="paiements-client2"><a class="dropdown-item" href="#">Paiements par clients</a></li>
                      
                    </ul>
                </div>
                <div class="dropdown mt-3 mb-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      Paiements du personnel
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li id="paiements-personnel"><a class="dropdown-item" href="#">Tous les paiements du personnel</a></li>
                      <li id="paiements-par-personnel"><a class="dropdown-item" href="#">Paiements par personnel</a></li>
                    </ul>
                </div>
            </div>

           </div>
        </div>
        
    </main>
    
</body>
</html>