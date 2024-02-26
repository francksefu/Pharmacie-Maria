<?php

    class Clients {
        public $idClient;
        private $nom;
        private $telephone;
        private $adresse;
        private $code_postale;
        private $email;
        //table for contain json 

        private $insert_arr = array();
        private $update_arr = array();
        private $delete_arr = array();
        
        public $remote = false;
        public $message;

        function __construct($nom, $telephone, $adresse, $code_postale, $email) {
           
            $this->nom = $nom;
            $this->telephone = $telephone;
            $this->adresse = $adresse;
            $this->code_postale = $code_postale;
            $this->email = $email;
            //$this->read();
        }

        function read() {
            read($this->insert_arr, $this->update_arr, $this->delete_arr, "data_client.json");
        }

        function write() {
            //write($this->insert_arr, $this->update_arr, $this->delete_arr, "data_client.json");
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
            $sql = ("INSERT INTO Client ( NomClient, Telephone, Adresse, CodePostale, Email) values ('".$this->nom."', '".$this->telephone."', '".$this->adresse."', '".$this->code_postale."', '".$this->email."')");
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

            $updC1= ("UPDATE `Client` SET `NomClient` ='".$this->nom."' WHERE idClient =$this->idClient");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC2= ("UPDATE `Client` SET `Telephone` = '".$this->telephone."' WHERE idClient =$this->idClient");
            if(mysqli_query($db,$updC2)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }

            $updC3= ("UPDATE `Client` SET `Adresse` = '".$this->adresse."' WHERE idClient =$this->idClient");
            if(mysqli_query($db,$updC3)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }

            $updC4= ("UPDATE `Client` SET `CodePostale` = '".$this->code_postale."' WHERE idClient =$this->idClient");
            if(mysqli_query($db,$updC4)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }

            $updC4= ("UPDATE `Client` SET `Email` = '".$this->email."' WHERE idClient =$this->idClient");
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
            $delete = ("DELETE FROM Client WHERE idClient =$this->idClient");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = mysqli_error($db);
                return;
            }
        }

    }

?>