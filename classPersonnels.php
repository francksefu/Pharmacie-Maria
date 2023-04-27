<?php

    class Personnels {
        public $idPersonnel;
        private $poste;
        private $nom;
        private $telephone;
        
        
        public $message;

        function __construct( $poste, $nom, $telephone) {
            
            $this->poste = $poste;
            $this->nom = $nom;
            $this->telephone = $telephone;
        }

        
        function insererPersonnel() {
            include 'connexion.php';
            $sql = ("INSERT INTO Personnel (Poste, Nom, Telephone) values ('".$this->poste."', '".$this->nom."', '".$this->telephone."')");
            if(mysqli_query($db, $sql)){
                //echo"<small style='color: green'>insertion fait</small>";
                }else{
                //echo "<small style='color: red;'>error : ".mysqli_error($db). " desolee</small>";
                //return 'error'.mysqli_error($db);
                $this->message = mysqli_error($db);
            }
        }
        function updatePersonnel() {
            include 'connexion.php';
            $updC= ("UPDATE `Personnel` SET `Poste` = '".$this->poste."' WHERE idPersonnel =$this->idPersonnel");
            if(mysqli_query($db,$updC)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }

            $updC1= ("UPDATE `Personnel` SET `Nom` ='".$this->nom."' WHERE idPersonnel =$this->idPersonnel");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC2= ("UPDATE `Personnel` SET `Telephone` = '".$this->telephone."' WHERE idPersonnel =$this->idPersonnel");
            if(mysqli_query($db,$updC2)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
        }

        function deletePersonnel() {
            include 'connexion.php';
            $delete = ("DELETE FROM Personnel WHERE idPersonnel =$this->idPersonnel");
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
            $tracteur = new Personnels($tabC[0], $tabC[1], $tabC[2]);
            $tracteur->insererPersonnel();
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
            $tracteur = new Personnels($tabC[0], $tabC[1], $tabC[2]);
            $tracteur->idPersonnel = $tabC[3];
            $tracteur->updatePersonnel();
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
            $tracteur = new Personnels(0, 1, 2);
            $tracteur->idPersonnel = $tabC[0];
            $tracteur->deletePersonnel();
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