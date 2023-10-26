<?php

    class Ventes {
        public $operation;
        private $idProduit;
        private $quantite;
        private $idClient;
        private $total_facture;
        private $montant;
        private $date;
        private $pu;
        private $dette; 
        public $message;


        function __construct($idProduit, $idClient, $quantite, $pu, $date, $operation, $dette, $total_facture, $montant) {
            $this->operation = $operation;
            $this->idProduit = $idProduit;
            $this->quantite = $quantite;
            $this->idClient = $idClient;
            $this->pu = $pu;
            $this->dette = $dette;
            $this->total_facture = $total_facture;
            $this->montant = $montant;
            $this->date = $date;
        }
//This method find first the id of product, and after that put againquantity in product if the operation of vente(sell) is delete
        function findIDProduit($operationA) {
            include 'connexion.php';
            $sql = ("SELECT * FROM Ventes WHERE (Operation = $operationA)");
            $result = mysqli_query($db, $sql);
                    
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    $idProduitV = $row["idProduit"];
                    $quantiteV = $row["QuantiteVendu"];
                    $this->remettreProduit($idProduitV, $quantiteV);
                }
           }else{$this->message = "Une erreur s est produite ";}


        }
        function remettreProduit($idProduitA, $quantiteA) {
            include 'connexion.php';
            $quantite_stock = 0;
            $sql = ("SELECT * FROM Produit WHERE (idProduit = $idProduitA)");
            $result = mysqli_query($db, $sql);
                    
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    $quantite_stock = $row["QuantiteStock"];
                }
           }else{echo "Une erreur s est produite ";}

           $updC1= ("UPDATE `Produit` SET `QuantiteStock` = $quantite_stock + $quantiteA WHERE idProduit =$idProduitA");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
        }
        function enleveProduit($idProduitA) {
            include 'connexion.php';
            $quantite_stock = 0;
            $sql = ("SELECT * FROM Produit WHERE (idProduit = $idProduitA)");
            $result = mysqli_query($db, $sql);
                    
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    $quantite_stock = $row["QuantiteStock"];
                }
           }else{echo "Une erreur s est produite ";}

           $updC1= ("UPDATE `Produit` SET `QuantiteStock` = $quantite_stock - $this->quantite WHERE idProduit =$idProduitA");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
        }
        
        function insererVentes() {
            include 'connexion.php';
            $sql = ("INSERT INTO Ventes (idProduit, idClient, QuantiteVendu, PU, PT, DatesVente, Operation, Dette, TotalFacture, MontantPaye) values ($this->idProduit, $this->idClient, $this->quantite, $this->pu, $this->pu * $this->quantite, '".$this->date."', $this->operation, '".$this->dette."', $this->total_facture, $this->montant)");
            if(mysqli_query($db, $sql)){
                
                }else{
                $this->message = mysqli_error($db);
            }
            $this->enleveProduit($this->idProduit);
        }
        function updateVentes() {
            include 'connexion.php';

            $delete = ("DELETE FROM Ventes WHERE Operation =$this->operation");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = 'delete'.mysqli_error($db);
                return;
            }
        }

        function deleteVentes() {
            include 'connexion.php';
           $this->findIDProduit($this->operation);
            $delete = ("DELETE FROM Ventes WHERE Operation =$this->operation");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = 'delete'.mysqli_error($db);
                return;
            }
        }

    }

    $q = $_REQUEST["q"];
    $tabObj = explode("__:", $q);
    $autre = '';
    $hint = '';
    if (end($tabObj) == "add") {
    for ($i = 0; $i < count($tabObj) - 1; $i += 1) {
        $tabElement = explode("::", $tabObj[$i]);
        $autre = '';
    
        if ($q !== "") {
            $hint = $q;
            $tracteur = new Ventes($tabElement[0], $tabElement[1], $tabElement[2], $tabElement[3], $tabElement[4], $tabElement[5], $tabElement[6], $tabElement[7], $tabElement[8]);
            $tracteur->insererVentes();
            $autre = $tracteur->message;
            if( $tracteur->message) {
                $hint = $autre;
                echo '<div class="alert alert-danger" role="alert">
                Erreur '.$hint.'
              </div>';
                return;
            }
            
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

    if (end($tabObj) == "update") {
        for ($i = 0; $i < count($tabObj) - 1; $i += 1) {
            $tabElement = explode("::", $tabObj[$i]);
            $autre = '';
        /**
         * avant de update il faut dabord remettre le produit
         * ensuite supprimer la vente
         * et enfin inserer une nouvelle vente en se servant de l ancien numero d operation
         */
            if ($q !== "") {
                $hint = $q;
                $tracteur = new Ventes($tabElement[0], $tabElement[1], $tabElement[2], $tabElement[3], $tabElement[4], $tabElement[5], $tabElement[6], $tabElement[7], $tabElement[8]);
                if ($i == 0) {
                    $tracteur->findIDProduit($tabElement[5]);
                }
                $tracteur->updateVentes();
                $autre = $tracteur->message;
                if( $tracteur->message) {
                    $hint = $autre;
                    echo '<div class="alert alert-danger" role="alert">
                    Erreur fran '.$hint.'
                  </div>';
                    return;
                }
               
            }
        }
       
        for ($i = 0; $i < count($tabObj) - 1; $i += 1) {
            $tabElement = explode("::", $tabObj[$i]);
            $autre = '';
        /**
         * avant de update il faut dabord remettre le produit
         * ensuite supprimer la vente
         * et enfin inserer une nouvelle vente en se servant de l ancien numero d operation
         */
            if ($q !== "") {
                $hint = $q;
                $tracteur = new Ventes($tabElement[0], $tabElement[1], $tabElement[2], $tabElement[3], $tabElement[4], $tabElement[5], $tabElement[6], $tabElement[7], $tabElement[8]);
                $tracteur->insererVentes();
                $autre = $tracteur->message;
                if( $tracteur->message) {
                    $hint = $autre;
                    echo '<div class="alert alert-danger" role="alert">
                    Erreur fran '.$hint.'
                  </div>';
                    return;
                }
               
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
    
    if (end($tabObj) == "delete") {
        if ($q !== "") {
            $hint = $q;
            
            $tracteur = new Ventes(0, 1, 2, 3, 4, 5, 6,7, 8);
            $tracteur->operation = $tabObj[0];
            $tracteur->deleteVentes();
            $autre = $tracteur->message;
            if( $tracteur->message) {
                $hint = $autre;
                echo '<div class="alert alert-danger" role="alert">
                Erreur '.$hint.'
              </div>';
                return;
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