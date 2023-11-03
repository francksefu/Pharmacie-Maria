<?php
include 'write_read_json.php';

    class Produit {
        public $idProduit;
        private $nom;
        private $pa;
        private $pv;
        private $pvmin;
        private $quantite;
        private $quantiteMin;
        private $description;
        
        //table for contain json 

        private $insert_arr = array();
        private $update_arr = array();
        private $delete_arr = array();
        
        public $message;

        function __construct($nom, $pa, $pv, $pvmin, $quantite, $quantiteMin, $description) {
            $this->nom = $nom;
            $this->pa = $pa;
            $this->pv = $pv;
            $this->pvmin = $pvmin;
            $this->quantite = $quantite;
            $this->quantiteMin = $quantiteMin;
            $this->description = $description;
            $this->read();
        }

        function read() {
            read($this->insert_arr, $this->update_arr, $this->delete_arr, "data_stock.json");
        }

        function write() {
            write($this->insert_arr, $this->update_arr, $this->delete_arr, "data_stock.json");
        }

        function write_insert() {
            array_push($this->insert_arr, (array("nom"=>$this->nom, "pa"=>$this->pa, "pv"=>$this->pv, "pvmin"=>$this->pvmin, "quantite"=>$this->quantite, "quantiteMin"=>$this->quantiteMin, "description"=>$this->description)));
            $this->write();
        }

        function write_update() {
            array_push($this->update_arr,(array("idProduit"=>$this->idProduit, "nom"=>$this->nom, "pa"=>$this->pa, "pv"=>$this->pv, "pvmin"=>$this->pvmin, "quantite"=>$this->quantite, "quantiteMin"=>$this->quantiteMin, "description"=>$this->description)));
            $this->write();
        }

        function write_delete() {
            array_push($this->delete_arr, (array("idProduit"=>$this->idProduit)));
            $this->write();
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

    
?>