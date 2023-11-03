<?php
    class PersoPaie {
        public $idPersoPaie;
        private $montant;
        private $idDataPerso;
        private $motif;
        private $mois;
        private $datesout;
        
        //table for contain json 

        private $insert_arr = array();
        private $update_arr = array();
        private $delete_arr = array();
        
        public $message;
        public $remote = false;

        function __construct($montant, $motif, $mois, $datesout, $idDataPerso) {
            $this->montant = $montant;
            $this->idDataPerso = $idDataPerso;
            $this->motif = $motif;
            $this->datesout = $datesout;
            $this->mois = $mois;
            $this->read();
        }

        function read() {
            read($this->insert_arr, $this->update_arr, $this->delete_arr, "data_persopaie.json");
        }

        function write() {
            write($this->insert_arr, $this->update_arr, $this->delete_arr, "data_persopaie.json");
        }

        function write_insert() {
            array_push($this->insert_arr, (array("montant"=>$this->montant, "motif"=>$this->motif, "mois"=>$this->mois, "datesout"=>$this->datesout, "idDataPerso"=>$this->idDataPerso)));
            $this->write();
        }

        function write_update() {
            array_push($this->update_arr, (array("idPersoPaie"=>$this->idPersoPaie ,"montant"=>$this->montant, "motif"=>$this->motif, "mois"=>$this->mois, "datesout"=>$this->datesout, "idDataPerso"=>$this->idDataPerso)));
            $this->write();
        }

        function write_delete() {
            array_push($this->delete_arr, (array("idPersoPaie"=>$this->idPersoPaie)));
            $this->write();
        }
       
        function insererPersonnelPaie() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }

            $sql = ("INSERT INTO PersonnelPaie (idDataPersonnel, `Date`, `Mois`, Montant, Observation) values ('".$this->idDataPerso."', '".$this->datesout."', '".$this->mois."', '".$this->montant."', '".$this->motif."')");
            if(mysqli_query($db, $sql)){
                
            }else{
                $this->message = mysqli_error($db);
            }
        }

        function updatePersonnelPaie() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
            $updC= ("UPDATE `PersonnelPaie` SET `Montant` = $this->montant WHERE idPersonnelPaie =$this->idPersoPaie");
            if(mysqli_query($db,$updC)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }

            $updC1= ("UPDATE `PersonnelPaie` SET Observation = '".$this->motif."' WHERE idPersonnelPaie =$this->idPersoPaie");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC2= ("UPDATE `PersonnelPaie` SET Mois = '".$this->mois."' WHERE idPersonnelPaie =$this->idPersoPaie");
            if(mysqli_query($db,$updC2)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC3= ("UPDATE `PersonnelPaie` SET `Date` = '".$this->datesout."' WHERE idPersonnelPaie =$this->idPersoPaie");
            if(mysqli_query($db,$updC3)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC4= ("UPDATE `PersonnelPaie` SET idDataPersonnel = $this->idDataPerso WHERE idPersonnelPaie =$this->idPersoPaie");
            if(mysqli_query($db,$updC4)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
        }
        function deletePersonnelPaie() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
            $delete = ("DELETE FROM PersonnelPaie WHERE idPersonnelPaie =$this->idPersoPaie");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = mysqli_error($db);
                return;
            }
        }
    }

    
?>