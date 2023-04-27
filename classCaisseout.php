<?php

    class CaisseOut {
        public $idCaisseOut;
        private $montant;
        private $motif;
        private $type;
        private $datesout;
        
        
        public $message;

        function __construct($montant, $motif, $type, $datesout) {
            $this->montant = $montant;
            $this->motif = $motif;
            $this->datesout = $datesout;
            $this->type = $type;
        }

       
        function insererCaisseOut() {
            include 'connexion.php';
            $sql = ("INSERT INTO CaisseOut (MontantOut, Commentaire, `Type`, DatesOut) values ('".$this->montant."', '".$this->motif."', '".$this->type."', '".$this->datesout."')");
            if(mysqli_query($db, $sql)){
                
            }else{
                $this->message = mysqli_error($db);
            }
        }

        function updateCaisseOut() {
            include 'connexion.php';
            $updC= ("UPDATE `CaisseOut` SET `MontantOut` = $this->montant WHERE idCaisseOut =$this->idCaisseOut");
            if(mysqli_query($db,$updC)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }

            $updC1= ("UPDATE `CaisseOut` SET `Commentaire` = '".$this->motif."' WHERE idCaisseOut =$this->idCaisseOut");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC2= ("UPDATE `CaisseOut` SET `Type` = '".$this->type."' WHERE idCaisseOut =$this->idCaisseOut");
            if(mysqli_query($db,$updC2)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC3= ("UPDATE `CaisseOut` SET `DatesOut` = '".$this->datesout."' WHERE idCaisseOut =$this->idCaisseOut");
            if(mysqli_query($db,$updC3)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
        }
        function deleteCaisse() {
            include 'connexion.php';
            $delete = ("DELETE FROM CaisseOut WHERE idCaisseOut =$this->idCaisseOut");
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
            $salaire = new CaisseOut($tabC[0], $tabC[1], $tabC[2], $tabC[3]);
            $salaire->insererCaisseOut();
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
            $salaire = new CaisseOut($tabC[0], $tabC[1], $tabC[2], $tabC[3]);
            $salaire->idCaisseOut = $idCaisse;
            $salaire->updateCaisseIn();
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
            $salaire = new CaisseOut(1, 2, 3, 4);
            $salaire->idCaisseOut = $tabC[0];
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