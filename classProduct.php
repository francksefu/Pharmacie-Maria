<?php 
include 'identifiant.php';
?>

<?php
    include 'write_read_json.php';
    include 'true_classProduct.php';

    $q = $_REQUEST["q"];
    $tabC = explode("::", $q);
    $autre = '';
    if (end($tabC) == 'add' && $user != "") {
        if ($q !== "") {
            $hint = $q;
            $produit = new Produit($tabC[0], $tabC[1], $tabC[2], $tabC[3], $tabC[4], $tabC[5], $tabC[6]);
            $produit->insererProduct();
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
    if(end($tabC) == 'update' && $user == "Administrateur") {
        $id= $tabC[7];
        if ($q !== "") {
            $hint = $q;
            $produit = new Produit($tabC[0], $tabC[1], $tabC[2], $tabC[3], $tabC[4], $tabC[5], $tabC[6]);
            $produit->idProduit = $id;
            $produit->updateProduct();
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
            $salaire = new Produit(1, 2, 3, 4,5,6,7);
            $salaire->idProduit = $tabC[0];
            $salaire->deleteProduct();
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