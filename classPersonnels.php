<?php 
include 'identifiant.php';
?>

<?php
    include 'write_read_json.php';
    include 'true_classPersonnels.php';

    $q = $_REQUEST["q"];
    $tabC = explode("::", $q);
    
    $autre = '';
    if (end($tabC) == 'add' && $user != "") {
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

    if (end($tabC) == 'delete' && $user != "") {
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