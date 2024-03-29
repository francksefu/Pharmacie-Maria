<?php

    class Approvisionnement {
        public $operation;
        private $idProduit;
        private $quantite;
        private $total_facture;
        private $date;
        private $pu;
        private $source;
        private $destination;
        public $message;


        function __construct($idProduit, $quantite, $pu, $date, $operation, $total_facture, $source, $destination) {
            $this->operation = $operation;
            $this->idProduit = $idProduit;
            $this->quantite = $quantite;
            $this->pu = $pu;
            $this->total_facture = $total_facture;
            $this->date = $date;
            $this->source = $source;
            $this->destination = $destination;
        }

        function enleveProduitSource($idProduitA) {
            include 'connexion.php';
            $quantite_stock = 0;
            $sql = ("SELECT * FROM Produit2 WHERE (idProduit = $idProduitA)");
            $result = mysqli_query($db, $sql);
                    
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    $quantite_stock = $row["QuantiteStock"];
                }
           }else{echo "Une erreur s est produite ";}

           $updC1= ("UPDATE `Produit2` SET `QuantiteStock` = $quantite_stock - $this->quantite WHERE idProduit =$idProduitA");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
        }

        function remettreProduitSource ($idProduitA, $quantiteA) {
            include 'connexion.php';
            $quantite_stock = 0;
            $sql = ("SELECT * FROM Produit2 WHERE (idProduit = $idProduitA)");
            $result = mysqli_query($db, $sql);
                    
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    $quantite_stock = $row["QuantiteStock"];
                }
           }else{echo "Une erreur s est produite ";}

           $updC1= ("UPDATE `Produit2` SET `QuantiteStock` = $quantite_stock + $quantiteA WHERE idProduit =$idProduitA");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
        }

        function findIDProduit($operationA) {
            include 'connexion.php';
            $sql = ("SELECT * FROM Approvisionnement WHERE (Operation = $operationA)");
            $result = mysqli_query($db, $sql);
                    
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    $idProduitV = $row["idProduit"];
                    $quantiteV = $row["QuantiteApprov"];
                    if ($row["Destination"] == "stock1") {
                        $this->remettreProduit($idProduitV, $quantiteV);
                    } else {
                        $this->remettreProduit2($idProduitV, $quantiteV);
                    }
                    if ($row["Source"] == "stock2") {
                        $this->remettreProduitSource($idProduitV, $quantiteV);
                    }
                    
                }
           }else{$this->message = "Une erreur s est produite ici";}


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

           $updC1= ("UPDATE `Produit` SET `QuantiteStock` = $quantite_stock - $quantiteA WHERE idProduit =$idProduitA");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
        }

        function remettreProduit2($idProduitA, $quantiteA) {
            include 'connexion.php';
            $quantite_stock = 0;
            $sql = ("SELECT * FROM Produit2 WHERE (idProduit = $idProduitA)");
            $result = mysqli_query($db, $sql);
                    
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    $quantite_stock = $row["QuantiteStock"];
                }
           }else{echo "Une erreur s est produite ";}

           $updC1= ("UPDATE `Produit2` SET `QuantiteStock` = $quantite_stock - $quantiteA WHERE idProduit =$idProduitA");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
        }
        // ici eneleveProduit signifie  ajouter dans produit vu que c est l approvisionnement, on ne voudrait pas recommencer, on s appuis sur la vente
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

           $updC1= ("UPDATE `Produit` SET `QuantiteStock` = $quantite_stock + $this->quantite WHERE idProduit =$idProduitA");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
        }
       
        function enleveProduit2($idProduitA) {
            include 'connexion.php';
            $quantite_stock = 0;
            $sql = ("SELECT * FROM Produit2 WHERE (idProduit = $idProduitA)");
            $result = mysqli_query($db, $sql);
                    
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    $quantite_stock = $row["QuantiteStock"];
                }
           }else{echo "Une erreur s est produite ";}

           $updC1= ("UPDATE `Produit2` SET `QuantiteStock` = $quantite_stock + $this->quantite WHERE idProduit =$idProduitA");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
        }

        function insererApprov() {
            include 'connexion.php';
            $sql = ("INSERT INTO Approvisionnement (idProduit, QuantiteApprov, PrixA, DatesApprov, Operation, TotalFacture, `Source`, Destination) values ($this->idProduit, $this->quantite, $this->pu, '".$this->date."', $this->operation, $this->total_facture, '".$this->source."', '".$this->destination."')");
            if(mysqli_query($db, $sql)){
                
                }else{
                $this->message = mysqli_error($db);
            }
            if ($this->destination == 'stock1') {
                $this->enleveProduit($this->idProduit);
            } else {
                $this->enleveProduit2($this->idProduit);
            }
            if ($this->source == 'stock2') {
                $this->enleveProduitSource($this->idProduit);
            }
           
        }
        function updateApprov() {
            include 'connexion.php';

            $delete = ("DELETE FROM Approvisionnement WHERE Operation =$this->operation");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = 'delete'.mysqli_error($db);
                return;
            }
        }

        function deleteVentes() {
            include 'connexion.php';
           $this->findIDProduit($this->operation);
            $delete = ("DELETE FROM Approvisionnement WHERE Operation =$this->operation");
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
            $tracteur = new Approvisionnement($tabElement[0], $tabElement[1], $tabElement[2], $tabElement[3], $tabElement[4], $tabElement[5], $tabElement[6], $tabElement[7]);
            $tracteur->insererApprov();
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
                $tracteur = new Approvisionnement($tabElement[0], $tabElement[1], $tabElement[2], $tabElement[3], $tabElement[4], $tabElement[5], $tabElement[6], $tabElement[7]);
                if ($i == 0) {
                    $tracteur->findIDProduit($tabElement[4]);
                }
                $tracteur->updateApprov();
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
                $tracteur = new Approvisionnement($tabElement[0], $tabElement[1], $tabElement[2], $tabElement[3], $tabElement[4], $tabElement[5], $tabElement[6], $tabElement[7]);
                $tracteur->insererApprov();
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
            
            $tracteur = new Approvisionnement(0, 1, 2, 3, 4, 5, 6,7);
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