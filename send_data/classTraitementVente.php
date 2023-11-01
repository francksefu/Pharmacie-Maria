<?php 
    $user = "";
    session_start();
    if(isset($_GET['deconnexion']))
    { 
    if($_GET['deconnexion']==true)
    {  
        session_destroy();
        header("location:index.php");
    }
    }
    else if($_SESSION['username'] !== ""){
        $user = $_SESSION['username'];
    }
?>

<?php

include 'write_read_json.php';

    class TakeVente {
        //table for contain json 

        private $insert_arr = array();
        private $update_arr = array();
        private $delete_arr = array();
        private $vente_json;

        function __construct($vente_json) {
            $this->vente_json = $vente_json;
            $this->read();
        }

        function read() {
            read($this->insert_arr, $this->update_arr, $this->delete_arr, "data_vente.json");
        }

        function write() {
            write($this->insert_arr, $this->update_arr, $this->delete_arr, "data_vente.json");
        }

        //$idProduit, $idClient, $quantite, $pu, $date, $operation, $dette, $total_facture, $montant

        function write_insert() {
            for ($j = 0; $j < count($this->vente_json); $j++) {
                array_push($this->insert_arr, (array("idProduit"=>$this->vente_json[$j]->idProduit, "idClient"=>$this->vente_json[$j]->idClient, "quantite"=>$this->vente_json[$j]->quantite, "pu"=>$this->vente_json[$j]->pu, "date"=>$this->vente_json[$j]->date, "operation"=>$this->vente_json[$j]->operation, "dette"=>$this->vente_json[$j]->dette, "total_facture"=>$this->vente_json[$j]->total_facture, "montant"=>$this->vente_json[$j]->montant)));
            }
            $this->write();
        }

        function write_update() {
            for ($j = 0; $j < count($this->vente_json); $j++) {
                array_push($this->update_arr, (array("idProduit"=>$this->vente_json[$j]->idProduit, "quantite"=>$this->vente_json[$j]->quantite, "pu"=>$this->vente_json[$j]->pu, "date"=>$this->vente_json[$j]->date, "operation"=>$this->vente_json[$j]->operation, "total_facture"=>$this->vente_json[$j]->total_facture, "source"=>$this->vente_json[$j]->source, "destination"=>$this->vente_json[$j]->destination)));
            }
            $this->write();
        }

        function write_delete() {
            for ($j = 0; $j < count($this->vente_json); $j++) {
                array_push($this->delete_arr, (array( "operation"=>$this->vente_json[$j]->operation)));
            }
            $this->write();
        }
    }

    class Ventes {
        public $operation;
        public $idProduit;
        public $quantite;
        public $idClient;
        public $total_facture;
        public $montant;
        public $date;
        public $pu;
        public $dette; 
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

    $insert_table = array();
    $update_table = array();
    $delete_table = array();

    if (end($tabObj) == "add") {
    for ($i = 0; $i < count($tabObj) - 1; $i += 1) {
        $tabElement = explode("::", $tabObj[$i]);
        $autre = '';
    
        if ($q !== "") {
            $hint = $q;
            $tracteur = new Ventes($tabElement[0], $tabElement[1], $tabElement[2], $tabElement[3], $tabElement[4], $tabElement[5], $tabElement[6], $tabElement[7], $tabElement[8]);
            $tracteur->insererVentes();
            array_push($insert_table, $tracteur);
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
    $take_vente_tojson = new TakeVente($insert_table);
    $take_vente_tojson->write_insert();
    
    
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
                array_push($update_table, $tracteur);
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
        
        $take_vente_tojson = new TakeVente($update_table);
        $take_vente_tojson->write_update();
        
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
            array_push($delete_table, $tracteur);
            $autre = $tracteur->message;
            if( $tracteur->message) {
                $hint = $autre;
                echo '<div class="alert alert-danger" role="alert">
                Erreur '.$hint.'
              </div>';
                return;
            }
            
        }
        
        $take_vente_tojson = new TakeVente($delete_table);
        $take_vente_tojson->write_delete();
        
            $sucess = '<div class="alert alert-success" role="alert">
            Suppression fait avec success
          </div>';
        
          $error = '<div class="alert alert-danger" role="alert">
          Erreur '.$autre.'
        </div>';
        echo $hint == $autre ? $error : $sucess;
    } 

?>