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

        function read() {
            read($this->insert_arr, $this->update_arr, $this->delete_arr, "data_caisse_out.json");
        }

        function write() {
            write($this->insert_arr, $this->update_arr, $this->delete_arr, "data_caisse_out.json");
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
            include 'connexion.php';
            $sql = ("INSERT INTO Sortie (Montant, il_pris_quoi, `TypeD`, DatesD) values ('".$this->montant."', '".$this->motif."', '".$this->type."', '".$this->datesout."')");
            if(mysqli_query($db, $sql)){
                
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
            
        }
        function deleteCaisse() {
            include 'connexion.php';
            $delete = ("DELETE FROM Sortie WHERE idSortie =$this->idSortie");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = mysqli_error($db);
                return;
            }
            
        }
    }

    $q = $_REQUEST["q"];
    $tabC = explode("::", $q);
    $autre = '';
    if (end($tabC) == 'add' && $user != "") {
        if ($q !== "") {
            $hint = $q;
            $salaire = new Sortie($tabC[0], $tabC[1], $tabC[2], $tabC[3]);
            $salaire->insererSortie();
            $salaire->write_insert();
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
    if(end($tabC) == 'update' && $user != "") {
        $idCaisse = $tabC[4];
        if ($q !== "") {
            $hint = $q;
            $salaire = new Sortie($tabC[0], $tabC[1], $tabC[2], $tabC[3]);
            $salaire->idSortie = $idCaisse;
            $salaire->updateSortie();
            $salaire->write_update();
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

    if(end($tabC) == 'delete' && $user != "") {
        
        if ($q !== "") {
            $hint = $q;
            $salaire = new Sortie(1, 2, 3, 4);
            $salaire->idSortie = $tabC[0];
            $salaire->deleteCaisse();
            $salaire->write_delete();
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