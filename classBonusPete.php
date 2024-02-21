<?php 
include 'identifiant.php';
?>

<?php
    include 'write_read_json.php';
    include 'true_classBonusPete.php';

    $q = $_REQUEST["q"];
    $tabC = explode("::", $q);
    $autre = '';
    
    if (end($tabC) == 'add' && $user != "") {
        if ($q !== "") {
            
            $hint = $q;
            $produit = new BonusPerte($tabC[0], $tabC[1], $tabC[2], $tabC[3], $tabC[4]);
            $produit->insererBonusPerte();

            /*Update array must go in json file for host data*/
            $produit->write_insert();

            $autre = $produit->message;
            if( $produit->message) {
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
        $id = $tabC[5];
        if ($q !== "") {
            $hint = $q;
            $produit = new BonusPerte($tabC[0], $tabC[1], $tabC[2], $tabC[3], $tabC[4]);
            $produit->idBonusPerte = $id;
            $produit->updateBonusPerte();
            //write in json
            $produit->write_update();
            $autre = $produit->message;
            if( $produit->message) {
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
            $salaire = new BonusPerte(1, 2, 3, 4,5);
            $salaire->idBonusPerte = $tabC[0];
            $salaire->deleteBonusPerte();
            //write in json
            $salaire->write_delete();
            $autre = $salaire->message;
            if( $salaire->message) {
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