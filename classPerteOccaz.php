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
    include 'true_classPerteOccaz.php';

    $q = $_REQUEST["q"];
    $tabC = explode("::", $q);
    $autre = '';
    if (end($tabC) == 'add' && $user != "") {
        if ($q !== "") {
            $hint = $q;
            $salaire = new PerteOccaz($tabC[0], $tabC[1], $tabC[2]);
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
        $idCaisse = $tabC[3];
        if ($q !== "") {
            $hint = $q;
            $salaire = new PerteOccaz($tabC[0], $tabC[1], $tabC[2]);
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
            $salaire = new PerteOccaz(1, 2, 3);
            $salaire->idSortie = $tabC[0];
            $salaire->deleteCaisse();
            $salaire->write_delete();
            $autre = $salaire->message;
            if( $salaire->message) {
                $hint = $autre;
            }
            
        }
        $sucess = '<div class="alert alert-success" role="alert">
    suppression fait avec success
  </div>';

  $error = '<div class="alert alert-danger" role="alert">
  Erreur '.$autre.'
</div>';
    echo $hint == $autre ? $error : $sucess;
    }
?>