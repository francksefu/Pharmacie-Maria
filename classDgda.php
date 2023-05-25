<?php

    class Dgda {
        public $idDgda;
        private $nom;
        private $motif;
        private $datesout;
        
        
        public $message;

        function __construct($nom, $motif, $datesout) {
            $this->nom = $nom;
            $this->motif = $motif;
            $this->datesout = $datesout;
        }

       
        function insererDgda() {
            include 'connexion.php';
            $sql = ("INSERT INTO Dgda (Nom, `Description`, Dates) values ('".$this->nom."', '".$this->motif."', '".$this->datesout."')");
            if(mysqli_query($db, $sql)){
                
            }else{
                $this->message = mysqli_error($db);
            }
        }

        function updateDgda() {
            include 'connexion.php';
            $updC= ("UPDATE `Dgda` SET `Nom` = '".$this->nom."' WHERE idDgda =$this->idDgda");
            if(mysqli_query($db,$updC)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }

            $updC1= ("UPDATE `Dgda` SET `Description` = '".$this->motif."' WHERE idDgda =$this->idDgda");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            
            $updC3= ("UPDATE `Dgda` SET `Dates` = '".$this->datesout."' WHERE idDgda =$this->idDgda");
            if(mysqli_query($db,$updC3)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
        }
        function deleteCaisse() {
            include 'connexion.php';
            $delete = ("DELETE FROM `Dgda` WHERE idDgda =$this->idDgda");
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
            $salaire = new Dgda($tabC[0], $tabC[1], $tabC[2]);
            $salaire->insererDgda();
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
        $idCaisse = $tabC[3];
        if ($q !== "") {
            $hint = $q;
            $salaire = new Dgda($tabC[0], $tabC[1], $tabC[2]);
            $salaire->idDgda = $idCaisse;
            $salaire->updateDgda();
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
        
        if ($q !== "") {
            $hint = $q;
            $salaire = new Dgda(1, 2, 3);
            $salaire->idDgda = $tabC[0];
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