<?php
/**
 * Nous avons creer et recreer TakeApprov dans le fichier class car les insertions, les update et les deletes
 * ne se suivent pas, d ou la necessite meme de la variable approv_insert, car apres avoir inserer, takeapprov
 * devient vide, faut le recreer pour qu il contienne des donnees
 */



    class TakeApprov {
        //table for contain json
        // this array is public because I wanna access on the moment to send data remotely 

        public $insert_arr = array();
        public $update_arr = array();
        public $delete_arr = array();
        private $approv_insert;

        function __construct($approv_insert) {
            $this->approv_insert = $approv_insert;
            $this->read();
        }

        function read() {
            read($this->insert_arr, $this->update_arr, $this->delete_arr, "data_approv.json");
        }

        function write() {
            write($this->insert_arr, $this->update_arr, $this->delete_arr, "data_approv.json");
        }

        function write_insert() {
            for ($j = 0; $j < count($this->approv_insert); $j++) {
                array_push($this->insert_arr, (array("idProduit"=>$this->approv_insert[$j]->idProduit, "quantite"=>$this->approv_insert[$j]->quantite, "pu"=>$this->approv_insert[$j]->pu, "date"=>$this->approv_insert[$j]->date, "operation"=>$this->approv_insert[$j]->operation, "total_facture"=>$this->approv_insert[$j]->total_facture, "source"=>$this->approv_insert[$j]->source, "destination"=>$this->approv_insert[$j]->destination)));
            }
            $this->write();
        }

        function write_update() {
            for ($j = 0; $j < count($this->approv_insert); $j++) {
                array_push($this->update_arr, (array("idProduit"=>$this->approv_insert[$j]->idProduit, "quantite"=>$this->approv_insert[$j]->quantite, "pu"=>$this->approv_insert[$j]->pu, "date"=>$this->approv_insert[$j]->date, "operation"=>$this->approv_insert[$j]->operation, "total_facture"=>$this->approv_insert[$j]->total_facture, "source"=>$this->approv_insert[$j]->source, "destination"=>$this->approv_insert[$j]->destination)));
            }
            $this->write();
        }

        function write_delete() {
            for ($j = 0; $j < count($this->approv_insert); $j++) {
                array_push($this->delete_arr, (array( "operation"=>$this->approv_insert[$j]->operation)));
            }
            $this->write();
        }
    }

    class Approvisionnement {
        public $operation;
        public $idProduit;
        public $quantite;
        public $total_facture;
        public $date;
        public $pu;
        public $source;
        public $destination;
        public $message;
        public $remote = false;

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
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
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
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
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
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
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
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
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
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
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
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
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
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
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
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
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
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
            $delete = ("DELETE FROM Approvisionnement WHERE Operation =$this->operation");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = 'delete'.mysqli_error($db);
                return;
            }
        }

        function deleteVentes() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }

           $this->findIDProduit($this->operation);
            $delete = ("DELETE FROM Approvisionnement WHERE Operation =$this->operation");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = 'delete'.mysqli_error($db);
                return;
            }
        }

    }

    
?>