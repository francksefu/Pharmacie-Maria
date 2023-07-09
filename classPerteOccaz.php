<?php

    class PerteOccaz {
        public $idSortie;
        private $montant;
        private $motif;
        private $datesout;
        
        
        public $message;

        function __construct($montant, $motif, $datesout) {
            $this->montant = $montant;
            $this->motif = $motif;
            $this->datesout = $datesout;
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

    $q = $_REQUEST["q"];
    $tabC = explode("::", $q);
    $autre = '';
    if (end($tabC) == 'add') {
        if ($q !== "") {
            $hint = $q;
            $salaire = new PerteOccaz($tabC[0], $tabC[1], $tabC[2]);
            $salaire->insererSortie();
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
            $salaire = new PerteOccaz($tabC[0], $tabC[1], $tabC[2]);
            $salaire->idSortie = $idCaisse;
            $salaire->updateSortie();
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
            $salaire = new PerteOccaz(1, 2, 3);
            $salaire->idSortie = $tabC[0];
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