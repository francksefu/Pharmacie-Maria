<?php

    class BonusPerte {
        public $idBonusPerte;
        private $idProduit;
        private $quantiteGagne;
        private $quantitePerdu;
        private $motif;
        private $date;
        public $message;

        //table for contain json 

        private $insert_arr = array();
        private $update_arr = array();
        private $delete_arr = array();
        private $update_product_arr = array();

        function __construct($idProduit, $quantiteGagne, $quantitePerdu, $motif, $date) {
            $this->idProduit = $idProduit;
            $this->quantiteGagne = $quantiteGagne;
            $this->quantitePerdu = $quantitePerdu;
            $this->motif = $motif;
            $this->date = $date;
            $this->read();
        }

        function write () {
            $myfile = fopen("data_bonus_perte.json", "w") or die("Unable to open file!");
            $txt = json_encode(array("insert_arr"=>$this->insert_arr, "update_arr"=>$this->update_arr, "delete_arr"=>$this->delete_arr, "update_product_arr"=>$this->update_product_arr));
            fwrite($myfile, $txt);
            fclose($myfile);
        }

        function read() {
            $myfile = fopen("data_bonus_perte.json", "r") or die("Unable to open file!");
            $big_arrjs = fread($myfile,filesize("data_bonus_perte.json"));
            $big_arr = json_decode($big_arrjs, true);
            if ($big_arrjs) {
                $this->insert_arr = $big_arr['insert_arr'];
                $this->update_arr =  $big_arr['update_arr'];
                $this->delete_arr = $big_arr['delete_arr'];
                $this->update_product_arr = $big_arr['update_product_arr'];
            } else {
                $this->insert_arr = array();
                $this->update_arr =  array();
                $this->delete_arr = array();
                $this->update_product_arr = array();
            }
            
            fclose($myfile);
        }


        function rechercheProductAndUpdate($type) {
            include 'connexion.php';
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
            if(mysqli_query($db,$upd)){
                array_push($this->update_product_arr, (array("idProduit"=>$idProduitA, "quantite_stock"=>$value)));
                $this->write();
            }else{
                $this->message = mysqli_error($db);
                return;
            }

            /**
             * finish take old value
            */
        }

       
        function insererBonusPerte() {
            include 'connexion.php';
            
            $sql = ("INSERT INTO  BonusPerte (idProduit, QuantitePerdu, QuantiteGagne, DatesD, Motif) values ($this->idProduit, $this->quantitePerdu, $this->quantiteGagne, '".$this->date."', '".$this->motif."')");
            if(mysqli_query($db, $sql)){
                /*Update array must go in json file for host data*/
                array_push($this->insert_arr, (array("idProduit"=>$this->idProduit, "quantitePerdu"=>$this->quantitePerdu, "quantiteGagne"=>$this->quantiteGagne, "date"=>$this->date, "motif"=>$this->motif)));
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
                array_push($this->update_product_arr, (array("idProduit"=>$this->idProduit, "quantite_stock"=>$valeur)));
                $this->write();
            }else{
                $this->message = mysqli_error($db);
                return;
            }
        }

        

        function updateBonusPerte() {
            include 'connexion.php';

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
                array_push($this->update_arr, (array( "idBonusPerte"=>$this->idBonusPerte,"idProduit"=>$this->idProduit, "quantitePerdu"=>$this->quantitePerdu, "quantiteGagne"=>$this->quantiteGagne, "date"=>$this->date, "motif"=>$this->motif)));
                $this->write()
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
                array_push($this->update_product_arr, (array("idProduit"=>$this->idProduit, "quantite_stock"=>$valeur)));
                $this->write();
            }else{
                $this->message = mysqli_error($db);
                return;
            }
        }
        function deleteBonusPerte() {
            include 'connexion.php';
            $this->rechercheProductAndUpdate("update");
            $delete = ("DELETE FROM BonusPerte WHERE idBonusPerte =$this->idBonusPerte");
            if (mysqli_query($db, $delete)){
                array_push($this->delete_arr, (array("idBonusPerte"=>$this->idBonusPerte)));
                $this->write();
            } else {
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
            $produit = new BonusPerte($tabC[0], $tabC[1], $tabC[2], $tabC[3], $tabC[4]);
            $produit->insererBonusPerte();
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
        $id = $tabC[5];
        if ($q !== "") {
            $hint = $q;
            $produit = new BonusPerte($tabC[0], $tabC[1], $tabC[2], $tabC[3], $tabC[4]);
            $produit->idBonusPerte = $id;
            $produit->updateBonusPerte();
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
            $salaire = new BonusPerte(1, 2, 3, 4,5);
            $salaire->idBonusPerte = $tabC[0];
            $salaire->deleteBonusPerte();
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