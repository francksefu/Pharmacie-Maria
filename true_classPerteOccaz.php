<?php
include 'write_read_json.php';
    class PerteOccaz {
        public $idSortie;
        private $montant;
        private $motif;
        private $datesout;

        private $insert_arr = array();
        private $update_arr = array();
        private $delete_arr = array();
        
        
        public $message;

        function __construct($montant, $motif, $datesout) {
            $this->montant = $montant;
            $this->motif = $motif;
            $this->datesout = $datesout;
            $this->read();
        }

        function read() {
            read($this->insert_arr, $this->update_arr, $this->delete_arr, "data_perteOccaz.json");
        }

        function write() {
            write($this->insert_arr, $this->update_arr, $this->delete_arr, "data_perteOccaz.json");
        }

        function write_insert() {
            array_push($this->insert_arr, (array("montant"=>$this->montant, "motif"=>$this->motif, "datesout"=>$this->datesout)));
            $this->write();
        }

        function write_update() {
            array_push($this->update_arr, (array("idPerteOccaz"=> $this->idSortie, "montant"=>$this->montant, "motif"=>$this->motif, "datesout"=>$this->datesout)));
            $this->write();
        }

        function write_delete() {
            array_push($this->delete_arr, (array("idPerteOccaz"=> $this->idSortie)));
            $this->write();
        }

       
        function insererSortie() {
            include 'connexion.php';
            $sql = ("INSERT INTO PerteOccaz (Montant, Commentaire, Dates) values ('".$this->montant."', '".$this->motif."', '".$this->datesout."')");
            if(mysqli_query($db, $sql)){
                
            }else{
                $this->message = mysqli_error($db);
            }
        }

        function updateSortie() {
            include 'connexion.php';
            $updC= ("UPDATE `PerteOccaz` SET `Montant` = $this->montant WHERE idPerteOccaz =$this->idSortie");
            if(mysqli_query($db,$updC)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }

            $updC1= ("UPDATE `PerteOccaz` SET `Commentaire` = '".$this->motif."' WHERE idPerteOccaz =$this->idSortie");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            
            $updC3= ("UPDATE `PerteOccaz` SET `Dates` = '".$this->datesout."' WHERE idPerteOccaz =$this->idSortie");
            if(mysqli_query($db,$updC3)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
        }
        function deleteCaisse() {
            include 'connexion.php';
            $delete = ("DELETE FROM PerteOccaz WHERE idPerteOccaz =$this->idSortie");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = mysqli_error($db);
                return;
            }
        }
    }

    
?>