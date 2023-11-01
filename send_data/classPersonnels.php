<?php 
    $user = "";
    session_start();
    if(isset($_GET['deconnexion']))
    { 
    if($_GET['deconnexion']==true)
    {  
        session_destroy();
        header("location:index.php");
    }
    }
    else if($_SESSION['username'] !== ""){
        $user = $_SESSION['username'];
    }
?>

<?php
include 'write_read_json.php';
    class Clients {
        public $idClient;
        private $nom;
        private $telephone;
        //table for contain json 

        private $insert_arr = array();
        private $update_arr = array();
        private $delete_arr = array();
        
        
        public $message;

        function __construct($nom, $telephone) {
            
            $this->nom = $nom;
            $this->telephone = $telephone;
            $this->read();
        }

        function read() {
            read($this->insert_arr, $this->update_arr, $this->delete_arr, "data_client.json");
        }

        function write() {
            write($this->insert_arr, $this->update_arr, $this->delete_arr, "data_client.json");
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
            include 'connexion.php';
            $sql = ("INSERT INTO Client ( NomClient, Telephone) values ('".$this->nom."', '".$this->telephone."')");
            if(mysqli_query($db, $sql)){
                //echo"<small style='color: green'>insertion fait</small>";
                }else{
                //echo "<small style='color: red;'>error : ".mysqli_error($db). " desolee</small>";
                //return 'error'.mysqli_error($db);
                $this->message = mysqli_error($db);
            }
        }
        function updateClient() {
            include 'connexion.php';

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
        }

        function deleteClient() {
            include 'connexion.php';
            $delete = ("DELETE FROM Client WHERE idClient =$this->idClient");
            if (mysqli_query($db, $delete)){echo"";} else {
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
            $tracteur = new Clients($tabC[0], $tabC[1]);
            $tracteur->insererClient();
            $tracteur->write_insert();
            $autre = $tracteur->message;
            if( $tracteur->message) {
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
    if (end($tabC) == 'update') {
        if ($q !== "") {
            $hint = $q;
            $tracteur = new Clients($tabC[0], $tabC[1]);
            $tracteur->idClient = $tabC[2];
            $tracteur->updateClient();
            $tracteur->write_update();
            $autre = $tracteur->message;
            if( $tracteur->message) {
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

    if (end($tabC) == 'delete') {
        if ($q !== "") {
            $hint = $q;
            $tracteur = new Clients(0, 1);
            $tracteur->idClient = $tabC[0];
            $tracteur->deleteClient();
            $tracteur->write_delete();
            $autre = $tracteur->message;
            if( $tracteur->message) {
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