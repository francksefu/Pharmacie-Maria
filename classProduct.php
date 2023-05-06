<?php

    class Produit {
        public $idProduit;
        private $nom;
        private $pa;
        private $pv;
        private $pvmin;
        private $quantite;
        private $quantiteMin;
        private $description;
        
        
        public $message;

        function __construct($nom, $pa, $pv, $pvmin, $quantite, $quantiteMin, $description) {
            $this->nom = $nom;
            $this->pa = $pa;
            $this->pv = $pv;
            $this->pvmin = $pvmin;
            $this->quantite = $quantite;
            $this->quantiteMin = $quantiteMin;
            $this->description = $description;
        }

       
        function insererProduct() {
            include 'connexion.php';
            $sql = ("INSERT INTO Produit (Nom, PrixAchat, PrixVente, PrixVmin, QuantiteStock, QuantiteStockMin, DescriptionP) values ('".$this->nom."', '".$this->pa."', '".$this->pv."', '".$this->pvmin."', '".$this->quantite."', '".$this->quantiteMin."', '".$this->description."')");
            if(mysqli_query($db, $sql)){
                
            }else{
                $this->message = mysqli_error($db);
            }
        }

        function updateProduct() {
            include 'connexion.php';
            $updC= ("UPDATE `Produit` SET `Nom` = '".$this->nom."' WHERE idProduit =$this->idProduit");
            if(mysqli_query($db,$updC)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }

            $updC1= ("UPDATE `Produit` SET `PrixAchat` = $this->pa WHERE idProduit =$this->idProduit");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC2= ("UPDATE `Produit` SET PrixVente = $this->pv WHERE idProduit =$this->idProduit");
            if(mysqli_query($db,$updC2)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC3= ("UPDATE `Produit` SET PrixVmin = $this->pvmin WHERE idProduit =$this->idProduit");
            if(mysqli_query($db,$updC3)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC4= ("UPDATE `Produit` SET QuantiteStock = $this->quantite WHERE idProduit =$this->idProduit");
            if(mysqli_query($db,$updC4)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC5= ("UPDATE `Produit` SET QuantiteStockMin = $this->quantiteMin WHERE idProduit =$this->idProduit");
            if(mysqli_query($db,$updC5)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }

            $updC6= ("UPDATE `Produit` SET DescriptionP = '".$this->description."' WHERE idProduit =$this->idProduit");
            if(mysqli_query($db,$updC6)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
        }
        function deleteProduct() {
            include 'connexion.php';
            $delete = ("DELETE FROM Produit WHERE idProduit =$this->idProduit");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = mysqli_error($db);
                return;
            }
        }
    }

    $q = $_REQUEST["q"];
    $tabC = explode("::", $q);
    $autre = '';
    if (end($tabC) == 'add') {
        if ($q !== "") {
            $hint = $q;
            $produit = new Produit($tabC[0], $tabC[1], $tabC[2], $tabC[3], $tabC[4], $tabC[5], $tabC[6]);
            $produit->insererProduct();
            $autre = $produit->message;
            if( $produit->message) {
                $hint = $autre;
            }
           
        }
   
            $sucess = '<div class="alert alert-success" role="alert">
            Insertion fait avec success
        </div>';
    
        $error = '<div class="alert alert-danger" role="alert">
        Erreur '.$autre.'
        </div>';
        echo $hint == $autre ? $error : $sucess;
        
    }
    if(end($tabC) == 'update') {
        $id= $tabC[7];
        if ($q !== "") {
            $hint = $q;
            $produit = new Produit($tabC[0], $tabC[1], $tabC[2], $tabC[3], $tabC[4], $tabC[5], $tabC[6]);
            $produit->idProduit = $id;
            $produit->updateProduct();
            $autre = $produit->message;
            if( $produit->message) {
                $hint = $autre;
            }
           
        }
        $sucess = '<div class="alert alert-success" role="alert">
    Modification fait avec success
  </div>';

  $error = '<div class="alert alert-danger" role="alert">
  Erreur '.$autre.'
</div>';
    echo $hint == $autre ? $error : $sucess;
    }

    if(end($tabC) == 'delete') {
        $idCaisse = $tabC[4];
        if ($q !== "") {
            $hint = $q;
            $salaire = new Produit(1, 2, 3, 4,5,6,7);
            $salaire->idProduit = $tabC[0];
            $salaire->deleteProduct();
            $autre = $salaire->message;
            if( $salaire->message) {
                $hint = $autre;
            }
            
        }
        $sucess = '<div class="alert alert-success" role="alert">
    Suppression fait avec success
  </div>';

  $error = '<div class="alert alert-danger" role="alert">
  Erreur '.$autre.'
</div>';
    echo $hint == $autre ? $error : $sucess;
    }
?>