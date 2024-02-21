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
        public $remote = false;

        function __construct($montant, $motif, $type, $datesout) {
            $this->montant = $montant;
            $this->motif = $motif;
            $this->datesout = $datesout;
            $this->type = $type;
            //$this->read();
        }

        function read() {
            read($this->insert_arr, $this->update_arr, $this->delete_arr, "data_caisse_out.json");
        }

        function write() {
            //write($this->insert_arr, $this->update_arr, $this->delete_arr, "data_caisse_out.json");
        }

        function write_insert() {
            array_push($this->insert_arr, (array("montant"=>$this->montant, "motif"=>$this->motif, "type"=>$this->type, "datesout"=>$this->datesout)));
            $this->write();
        }

        function write_update() {
            array_push($this->update_arr, (array("idSortie"=> $this->idSortie, "montant"=>$this->montant, "motif"=>$this->motif, "type"=>$this->type, "datesout"=>$this->datesout)));
            $this->write();
        }

        function write_delete() {
            array_push($this->delete_arr, (array("idSortie"=> $this->idSortie)));
            $this->write();
        }
      
        function insererSortie() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
            
            $sql = ("INSERT INTO Sortie (Montant, il_pris_quoi, `TypeD`, DatesD) values ('".$this->montant."', '".$this->motif."', '".$this->type."', '".$this->datesout."')");
            if(mysqli_query($db, $sql)){
                
            }else{
                $this->message = mysqli_error($db);
            }
        }

        function updateSortie() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
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
            
        }
        function deleteCaisse() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
            $delete = ("DELETE FROM Sortie WHERE idSortie =$this->idSortie");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = mysqli_error($db);
                return;
            }
            
        }
    }

    
?>