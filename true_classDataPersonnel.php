<?php

    class Personnel {
        public $idClient;
        private $nom;
        private $telephone;
        private $salaire;
        public $poste;
        
        //table for contain json 

        private $insert_arr = array();
        private $update_arr = array();
        private $delete_arr = array();
        
        public $message;
        public $remote = false;

        function __construct($nom, $telephone, $salaire, $poste) {
           
            $this->nom = $nom;
            $this->telephone = $telephone;
            $this->salaire = $salaire;
            $this->poste = $poste;
            //$this->read();
        }

        function read() {
            read($this->insert_arr, $this->update_arr, $this->delete_arr, "data_personnel.json");
        }

        function write() {
            //write($this->insert_arr, $this->update_arr, $this->delete_arr, "data_personnel.json");
        }

        function write_insert() {
            array_push($this->insert_arr, (array("nom"=>$this->nom, "telephone"=>$this->telephone)));
            $this->write();
        }

        function write_update() {
            array_push($this->update_arr, (array("idClient"=> $this->idClient ,"nom"=>$this->nom, "telephone"=>$this->telephone)));
            $this->write();
        }

        function write_delete() {
            array_push($this->delete_arr, (array("idClient"=> $this->idClient)));
            $this->write();
        }
        
        function insererClient() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
            $sql = ("INSERT INTO DataPersonnel ( NomP, Telephone, SalaireDeBase, Poste) values ('".$this->nom."','".$this->telephone."','".$this->salaire."', '".$this->poste."')");
            if(mysqli_query($db, $sql)){
                //echo"<small style='color: green'>insertion fait</small>";
                }else{
                //echo "<small style='color: red;'>error : ".mysqli_error($db). " desolee</small>";
                //return 'error'.mysqli_error($db);
                $this->message = mysqli_error($db);
            }
        }
        function updateClient() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }

            $updC1= ("UPDATE `DataPersonnel` SET `NomP` ='".$this->nom."' WHERE idDataPersonnel =$this->idClient");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC2= ("UPDATE `DataPersonnel` SET `Telephone` = '".$this->telephone."' WHERE idDataPersonnel =$this->idClient");
            if(mysqli_query($db,$updC2)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }

            $updC3= ("UPDATE `DataPersonnel` SET `SalaireDeBase` = '".$this->salaire."' WHERE idDataPersonnel =$this->idClient");
            if(mysqli_query($db,$updC3)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }

            $updC4= ("UPDATE `DataPersonnel` SET `Poste` = '".$this->poste."' WHERE idDataPersonnel =$this->idClient");
            if(mysqli_query($db,$updC4)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
        }

        function deleteClient() {
            if ($this->remote) {
                include 'remote_connexion.php';
            } else {
                include 'connexion.php';
            }
            $delete = ("DELETE FROM DataPersonnel WHERE idDataPersonnel =$this->idClient");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = mysqli_error($db);
                return;
            }
        }

    }

    
?>