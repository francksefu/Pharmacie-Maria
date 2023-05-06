<?php

    class Change {
        public $idChange;
        private $chilling;
        private $rwandais;
        private $cdf;
        
        
        public $message;

        function __construct($idChange, $chilling, $rwandais, $cdf) {
            $this->idChange = $idChange;
            $this->chilling = $chilling;
            $this->rwandais = $rwandais;
            $this->cdf = $cdf;
        }

       
        

        function updateTaux() {
            include 'connexion.php';
            $updC= ("UPDATE `Change` SET `Chilling` = $this->chilling WHERE idChange =$this->idChange");
            if(mysqli_query($db,$updC)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }

            $updC1= ("UPDATE `Change` SET `Rwandais` = $this->rwandais WHERE idChange =$this->idChange");
            if(mysqli_query($db,$updC1)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
            $updC2= ("UPDATE `Change` SET `CDF` = $this->cdf WHERE idChange =$this->idChange");
            if(mysqli_query($db,$updC2)){echo"";}else{
                $this->message = mysqli_error($db);
                return;
            }
        }
    }

    $q = $_REQUEST["q"];
    $tabC = explode("::", $q);
    $autre = '';

    if(end($tabC) == 'update') {
        if ($q !== "") {
            $hint = $q;
            $salaire = new Change($tabC[0], $tabC[1], $tabC[2], $tabC[3]);
            $salaire->updateTaux();
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