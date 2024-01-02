<?php 
include 'identifiant.php';
?>

<?php
    include 'write_read_json.php';
    include 'true_classPersoPaie.php';

    $q = $_REQUEST["q"];
    $tabC = explode("::", $q);
    $autre = '';
    if (end($tabC) == 'add' && $user != "") {
        if ($q !== "") {
            $hint = $q;
            $salaire = new PersoPaie($tabC[0], $tabC[1], $tabC[2], $tabC[3], $tabC[4], $tabC[5]);
            $salaire->insererPersonnelPaie();
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
    if(end($tabC) == 'update' && $user == "Administrateur") {
        $idCaisse = $tabC[6];
        if ($q !== "") {
            $hint = $q;
            $salaire = new PersoPaie($tabC[0], $tabC[1], $tabC[2], $tabC[3], $tabC[4], $tabC[5]);
            $salaire->idPersoPaie = $idCaisse;
            $salaire->updatePersonnelPaie();
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
            $salaire = new PersoPaie(1, 2, 3, 4, 5,6);
            $salaire->idPersoPaie = $tabC[0];
            $salaire->deletePersonnelPaie();
            $salaire->write_delete();
            $autre = $salaire->message;
            if( $salaire->message) {
                $hint = $autre;
            }
            
        }
        $sucess = '<div class="alert alert-success" role="alert">
    Suppression fait avec success fait avec success
  </div>';

  $error = '<div class="alert alert-danger" role="alert">
  Erreur '.$autre.'
</div>';
    echo $hint == $autre ? $error : $sucess;
    }
?>