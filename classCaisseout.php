<?php

    class Sortie {
        public $idSortie;
        private $montant;
        private $motif;
        private $type;
        private $datesout;

        //table for contain json 

        private $insert_arr = array();
        private $update_arr = array();
        private $delete_arr = array();
        
        
        public $message;

        function __construct($montant, $motif, $type, $datesout) {
            $this->montant = $montant;
            $this->motif = $motif;
            $this->datesout = $datesout;
            $this->type = $type;
            $this->read();
        }

        function write () {
            $myfile = fopen("data.json", "w") or die("Unable to open file!");
            $txt = json_encode(array("insert_arr"=>$this->insert_arr, "update_arr"=>$this->update_arr, "delete_arr"=>$this->delete_arr));
            fwrite($myfile, $txt);
            
            fclose($myfile);
        }

        function read() {
            $myfile = fopen("data.json", "r") or die("Unable to open file!");
            $big_arrjs = fread($myfile,filesize("data.json"));
            $big_arr = json_decode($big_arrjs, true);
            $this->insert_arr = $big_arr['insert_arr'];
            $this->update_arr =  $big_arr['update_arr'];
            $this->delete_arr = $big_arr['delete_arr'];
            fclose($myfile);
        }

      
        function insererSortie() {
            include 'connexion.php';
            $sql = ("INSERT INTO Sortie (Montant, il_pris_quoi, `TypeD`, DatesD) values ('".$this->montant."', '".$this->motif."', '".$this->type."', '".$this->datesout."')");
            if(mysqli_query($db, $sql)){
                array_push($this->insert_arr, (array("montant"=>$this->montant, "motif"=>$this->motif, "type"=>$this->type, "datesout"=>$this->datesout)));
                $this->write();
            }else{
                $this->message = mysqli_error($db);
            }
        }

        function updateSortie() {
            include 'connexion.php';
            $updC= ("UPDATE `Sortie` SET `Montant` = $this->montant WHERE idSortie =$this->idSortie");
            if(mysqli_query($db,$updC)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }

            $updC1= ("UPDATE `Sortie` SET `il_pris_quoi` = '".$this->motif."' WHERE idSortie =$this->idSortie");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC2= ("UPDATE `Sortie` SET `TypeD` = '".$this->type."' WHERE idSortie =$this->idSortie");
            if(mysqli_query($db,$updC2)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC3= ("UPDATE `Sortie` SET `DatesD` = '".$this->datesout."' WHERE idSortie =$this->idSortie");
            if(mysqli_query($db,$updC3)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            array_push($this->update_arr, (array("idSortie"=> $this->idSortie, "montant"=>$this->montant, "motif"=>$this->motif, "type"=>$this->type, "datesout"=>$this->datesout)));
            $this->write();
        }
        function deleteCaisse() {
            include 'connexion.php';
            $delete = ("DELETE FROM Sortie WHERE idSortie =$this->idSortie");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = mysqli_error($db);
                return;
            }
            array_push($this->update_arr, (array("idSortie"=> $this->idSortie)));
            $this->write();
        }
    }

    $q = $_REQUEST["q"];
    $tabC = explode("::", $q);
    $autre = '';
    if (end($tabC) == 'add') {
        if ($q !== "") {
            $hint = $q;
            $salaire = new Sortie($tabC[0], $tabC[1], $tabC[2], $tabC[3]);
            $salaire->insererSortie();
            $autre = $salaire->message;
            if( $salaire->message) {
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
        $idCaisse = $tabC[4];
        if ($q !== "") {
            $hint = $q;
            $salaire = new Sortie($tabC[0], $tabC[1], $tabC[2], $tabC[3]);
            $salaire->idSortie = $idCaisse;
            $salaire->updateSortie();
            $autre = $salaire->message;
            if( $salaire->message) {
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
            $salaire = new Sortie(1, 2, 3, 4);
            $salaire->idSortie = $tabC[0];
            $salaire->deleteCaisse();
            $autre = $salaire->message;
            if( $salaire->message) {
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
?>