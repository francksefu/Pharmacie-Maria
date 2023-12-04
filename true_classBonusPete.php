<?php
 
    class BonusPerte {
        public $idBonusPerte;
        private $idProduit;
        private $quantiteGagne;
        private $quantitePerdu;
        private $motif;
        private $date;
        public $message;
        public $remote = false;

        //table for contain json 
        private $insert_arr = array();
        private $update_arr = array();
        private $delete_arr = array();
        

        function __construct($idProduit, $quantiteGagne, $quantitePerdu, $motif, $date) {
            $this->idProduit = $idProduit;
            $this->quantiteGagne = $quantiteGagne;
            $this->quantitePerdu = $quantitePerdu;
            $this->motif = $motif;
            $this->date = $date;
            //$this->read();
        }

        function read() {
            read($this->insert_arr, $this->update_arr, $this->delete_arr, "data_bonus_perte.json");
        }

        function write() {
            //write($this->insert_arr, $this->update_arr, $this->delete_arr, "data_bonus_perte.json");
        }

        function write_insert() {
            array_push($this->insert_arr, (array("idProduit"=>$this->idProduit, "quantiteGagne"=>$this->quantiteGagne, "quantitePerdu"=>$this->quantitePerdu, "motif"=>$this->motif, "date"=>$this->date)));
            $this->write();
        }

        function write_update() {
            array_push($this->update_arr, (array("idProduit"=>$this->idProduit, "quantiteGagne"=>$this->quantiteGagne, "quantitePerdu"=>$this->quantitePerdu, "motif"=>$this->motif, "date"=>$this->date, "idBonusPerte"=>$this->idBonusPerte)));
            $this->write();
        }

        function write_delete() {
            array_push($this->delete_arr, (array("idBonusPerte"=>$this->idBonusPerte)));
            $this->write();
        }
       
        function rechercheProductAndUpdate($type) {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
            /**
             * take old value from bonusPerte table
             */

             $idProduitA ='';
             $quantiteGagneA = '';
             $quantitePerduA = '';
             if ($type == "update") {
                $sql = ("SELECT * FROM BonusPerte WHERE idBonusPerte = $this->idBonusPerte");
                $result = mysqli_query($db, $sql);
                     
                if(mysqli_num_rows($result)>0){
                                 
                 while($row= mysqli_fetch_assoc($result)){
                     $idProduitA = $row["idProduit"];
                     $quantiteGagneA = $row["QuantiteGagne"];
                     $quantitePerduA = $row["QuantitePerdu"];
                 }
                         
                }else{echo "Une erreur s est produite";}
             } else {
                $idProduitA = $this->idProduit;
                $quantiteGagneA = 0;
                $quantitePerduA = 0;
             }
             
 
            /**
             * finish take old value
             * take and update value from product 
             */
             $quantiteA = 0;
             $sqlP = ("SELECT * FROM Produit WHERE idProduit = $idProduitA");
             $resultP = mysqli_query($db, $sqlP);
                     
             if(mysqli_num_rows($resultP)>0){
                                 
                 while($rowP= mysqli_fetch_assoc($resultP)){
                     $quantiteA = $rowP["QuantiteStock"];
                 }
                         
            }else{echo "Une erreur s est produite";}
 
            $value = $quantiteA - $quantiteGagneA + $quantitePerduA;
            

            $upd= ("UPDATE `Produit` SET `QuantiteStock` = $value WHERE idProduit =$idProduitA");
            if(mysqli_query($db,$upd)){echo""; }else{
                $this->message = mysqli_error($db);
                return;
            }

            /**
             * finish take old value
            */
        }

       
        function insererBonusPerte() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
            
            $sql = ("INSERT INTO  BonusPerte (idProduit, QuantitePerdu, QuantiteGagne, DatesD, Motif) values ($this->idProduit, $this->quantitePerdu, $this->quantiteGagne, '".$this->date."', '".$this->motif."')");
            if(mysqli_query($db, $sql)){
                
            }else{
                $this->message = mysqli_error($db);
            }
            $quantite = 0;

            $sqlP = ("SELECT * FROM Produit WHERE idProduit = $this->idProduit");
             $resultP = mysqli_query($db, $sqlP);
                     
             if(mysqli_num_rows($resultP)>0){
                                 
                 while($rowP= mysqli_fetch_assoc($resultP)){
                     $quantite = $rowP["QuantiteStock"];
                 }
                         
            }else{echo "Une erreur s est produite";}
            $valeur = $quantite + $this->quantiteGagne - $this->quantitePerdu;
            $upd= ("UPDATE `Produit` SET `QuantiteStock` = $valeur WHERE idProduit =$this->idProduit");
            if(mysqli_query($db,$upd)){

            }else{
                $this->message = mysqli_error($db);
                return;
            }
        }

        

        function updateBonusPerte() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }

            $this->rechercheProductAndUpdate("update");

            $updC1= ("UPDATE `BonusPerte` SET `idProduit` = $this->idProduit WHERE idBonusPerte =$this->idBonusPerte");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC2= ("UPDATE `BonusPerte` SET QuantiteGagne = $this->quantiteGagne WHERE idBonusPerte =$this->idBonusPerte");
            if(mysqli_query($db,$updC2)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC3= ("UPDATE `BonusPerte` SET QuantitePerdu = $this->quantitePerdu WHERE idBonusPerte =$this->idBonusPerte");
            if(mysqli_query($db,$updC3)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC4= ("UPDATE `BonusPerte` SET Motif = '".$this->motif."' WHERE idBonusPerte =$this->idBonusPerte");
            if(mysqli_query($db,$updC4)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }

            $updC5= ("UPDATE `BonusPerte` SET DatesD = '".$this->date."' WHERE idBonusPerte =$this->idBonusPerte");
            if(mysqli_query($db,$updC5)){
                
            }else{
                $this->message = mysqli_error($db);
                return;
            }

            $sqlP = ("SELECT * FROM Produit WHERE idProduit = $this->idProduit");
             $resultP = mysqli_query($db, $sqlP);
                     
             if(mysqli_num_rows($resultP)>0){
                                 
                 while($rowP= mysqli_fetch_assoc($resultP)){
                     $quantite = $rowP["QuantiteStock"];
                 }
                         
            }else{echo "Une erreur s est produite";}
            $upd= ("UPDATE `Produit` SET `QuantiteStock` = $quantite + $this->quantiteGagne - $this->quantitePerdu WHERE idProduit =$this->idProduit");
            if(mysqli_query($db,$upd)){
                
            }else{
                $this->message = mysqli_error($db);
                return;
            }
        }
        function deleteBonusPerte() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
            $this->rechercheProductAndUpdate("update");
            $delete = ("DELETE FROM BonusPerte WHERE idBonusPerte =$this->idBonusPerte");
            if (mysqli_query($db, $delete)){
                
            } else {
                $this->message = mysqli_error($db);
                return;
            }
        }
    }

    
?>