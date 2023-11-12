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
    include 'true_classPaiements.php';

    $q = $_REQUEST["q"];
    $tabC = explode("::", $q);
    
    $autre = '';
    //check the session
    if (end($tabC) == 'add' && $user != "") {
        if ($q !== "") {
            $hint = $q;
            $tracteur = new Paiements($tabC[0], $tabC[1], $tabC[2]);
            $tracteur->insererPaiements();
            
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
    if (end($tabC) == 'update' && $user != "") {
        if ($q !== "") {
            $hint = $q;
            $tracteur = new Paiements($tabC[0], $tabC[1], $tabC[2]);
            $tracteur->idPaiements = $tabC[3];
            $tracteur->updatePaiements();
            
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

    if (end($tabC) == 'delete' && $user != "") {
        if ($q !== "") {
            $hint = $q;
            $tracteur = new Paiements(0, 1,2);
            $tracteur->idPaiements = $tabC[0];
            $tracteur->deletePaiements();
            
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