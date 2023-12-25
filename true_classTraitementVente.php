<?php

    class TakeVente {
        //table for contain json 

        public $insert_arr = array();
        public $update_arr = array();
        public $delete_arr = array();
        private $vente_json;

        function __construct($vente_json) {
            $this->vente_json = $vente_json;
           // $this->read();
        }

        function read() {
            read($this->insert_arr, $this->update_arr, $this->delete_arr, "data_vente.json");
        }

        function write() {
            //write($this->insert_arr, $this->update_arr, $this->delete_arr, "data_vente.json");
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
                array_push($this->update_arr, (array("idProduit"=>$this->vente_json[$j]->idProduit, "idClient"=>$this->vente_json[$j]->idClient, "quantite"=>$this->vente_json[$j]->quantite, "pu"=>$this->vente_json[$j]->pu, "date"=>$this->vente_json[$j]->date, "operation"=>$this->vente_json[$j]->operation, "dette"=>$this->vente_json[$j]->dette, "total_facture"=>$this->vente_json[$j]->total_facture, "montant"=>$this->vente_json[$j]->montant)));
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

        public $idPersonnel;
        private $stock;
        public $remote = false;


        function __construct($idProduit, $idClient, $quantite, $pu, $date, $operation, $dette, $total_facture, $montant, $idPersonnel, $stock) {
            $this->operation = $operation;
            $this->idProduit = $idProduit;
            $this->quantite = $quantite;
            $this->idClient = $idClient;
            $this->pu = $pu;
            $this->dette = $dette;
            $this->total_facture = $total_facture;
            $this->montant = $montant;
            $this->date = $date;
            $this->idPersonnel = $idPersonnel;
            $this->stock = $stock;
        }
//This method find first the id of product, and after that put againquantity in product if the operation of vente(sell) is delete
        function findIDProduit($operationA) {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
            if ($this->stock == 'stock1') {
                $sql = ("SELECT * FROM Ventes WHERE (Operation = $operationA)");
            } else {
                $sql = ("SELECT * FROM Ventes2 WHERE (Operation = $operationA)");
            }
            
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
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
            $quantite_stock = 0;
            if ($this->stock == 'stock1') {
                $sql = ("SELECT * FROM Produit WHERE (idProduit = $idProduitA)");
            } else {
                $sql = ("SELECT * FROM Produit2 WHERE (idProduit = $idProduitA)");
            }
            
            $result = mysqli_query($db, $sql);
                    
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    $quantite_stock = $row["QuantiteStock"];
                }
           }else{echo "Une erreur s est produite ";}
           if ($this->stock == 'stock1') {
                $updC1= ("UPDATE `Produit` SET `QuantiteStock` = $quantite_stock + $quantiteA WHERE idProduit =$idProduitA");
                if(mysqli_query($db,$updC1)){echo"";}else{
                    $this->message = mysqli_error($db);
                    return;
                }
           } else {
                $updC1= ("UPDATE `Produit2` SET `QuantiteStock` = $quantite_stock + $quantiteA WHERE idProduit =$idProduitA");
                if(mysqli_query($db,$updC1)){echo"";}else{
                    $this->message = mysqli_error($db);
                    return;
                }
           }
           
        }
        function enleveProduit($idProduitA) {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
            $quantite_stock = 0;
            if ($this->stock == 'stock1') {
                $sql = ("SELECT * FROM Produit WHERE (idProduit = $idProduitA)");
            } else {
                $sql = ("SELECT * FROM Produit2 WHERE (idProduit = $idProduitA)");
            }
            
            $result = mysqli_query($db, $sql);
                    
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    $quantite_stock = $row["QuantiteStock"];
                }
           }else{echo "Une erreur s est produite ";}
           if ($this->stock == 'stock1') {
                $updC1= ("UPDATE `Produit` SET `QuantiteStock` = $quantite_stock - $this->quantite WHERE idProduit =$idProduitA");
                if(mysqli_query($db,$updC1)){echo"";}else{
                    $this->message = mysqli_error($db);
                    return;
                }
           } else {
                $updC1= ("UPDATE `Produit2` SET `QuantiteStock` = $quantite_stock - $this->quantite WHERE idProduit =$idProduitA");
                if(mysqli_query($db,$updC1)){echo"";}else{
                    $this->message = mysqli_error($db);
                    return;
                }
           }
           
        }

        
        function insererVentes() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }

            if ($this->stock == 'stock1') {
                $sql = ("INSERT INTO Ventes (idProduit, idClient, QuantiteVendu, PU, PT, DatesVente, Operation, Dette, TotalFacture, MontantPaye, idPersonnel) values ($this->idProduit, $this->idClient, $this->quantite, $this->pu, $this->pu * $this->quantite, '".$this->date."', $this->operation, '".$this->dette."', $this->total_facture, $this->montant, $this->idPersonnel)");
            } else {
                $sql = ("INSERT INTO Ventes2 (idProduit, idClient, QuantiteVendu, PU, PT, DatesVente, Operation, Dette, TotalFacture, MontantPaye, idPersonnel) values ($this->idProduit, $this->idClient, $this->quantite, $this->pu, $this->pu * $this->quantite, '".$this->date."', $this->operation, '".$this->dette."', $this->total_facture, $this->montant, $this->idPersonnel)");
            }
            
            if(mysqli_query($db, $sql)){
                
                }else{
                $this->message = mysqli_error($db);
            }
            $this->enleveProduit($this->idProduit);
        }
        function updateVentes() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }

            if ($this->stock == 'stock1') {
                $delete = ("DELETE FROM Ventes WHERE Operation =$this->operation");
                if (mysqli_query($db, $delete)){echo"";} else {
                    $this->message = 'delete'.mysqli_error($db);
                    return;
                }
            } else {
                $delete = ("DELETE FROM Ventes2 WHERE Operation =$this->operation");
                if (mysqli_query($db, $delete)){echo"";} else {
                    $this->message = 'delete'.mysqli_error($db);
                    return;
                }
            }
            
        }

        function deleteVentes() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
           $this->findIDProduit($this->operation);
            $delete = ("DELETE FROM Ventes WHERE Operation =$this->operation");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = 'delete'.mysqli_error($db);
                return;
            }
        }

        function deleteVentes2() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
           $this->findIDProduit($this->operation);
            $delete = ("DELETE FROM Ventes2 WHERE Operation =$this->operation");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = 'delete'.mysqli_error($db);
                return;
            }
        }

    }

    
?>