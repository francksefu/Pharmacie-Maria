<?php 
include 'identifiant.php';
?>

<?php
    include 'write_read_json.php';
    include 'true_classTraitementVente.php';

    $q = $_REQUEST["q"];
    $tabObj = explode("__:", $q);
    $autre = '';
    $hint = '';

    $insert_table = array();
    $update_table = array();
    $delete_table = array();

    if (end($tabObj) == "add" && $user != "") {
    for ($i = 0; $i < count($tabObj) - 1; $i += 1) {
        $tabElement = explode("::", $tabObj[$i]);
        $autre = '';
   
        if ($q !== "") {
            $hint = $q;
            $tracteur = new Ventes($tabElement[0], $tabElement[1], $tabElement[2], $tabElement[3], $tabElement[4], $tabElement[5], $tabElement[6], $tabElement[7], $tabElement[8], $tabElement[9], $tabElement[10], $tabElement[11], $tabElement[12], $tabElement[13], $tabElement[14], $tabElement[15]);
            $tracteur->insererVentes();
            array_push($insert_table, $tracteur);
            $autre = $tracteur->message;
            if( $tracteur->message) {
                $hint = $autre;
                echo '<div class="alert alert-danger" role="alert">
                Erreur '.$hint.'
              </div>';
                return;
            }
           
        }
    }
    $take_vente_tojson = new TakeVente($insert_table);
    $take_vente_tojson->write_insert();
    
    
        $sucess = '<div class="alert alert-success" role="alert">
        Insertion fait avec success
      </div>';
    
      $error = '<div class="alert alert-danger" role="alert">
      Erreur '.$autre.'
    </div>';
    echo $hint == $autre ? $error : $sucess;
    }

    if (end($tabObj) == "update" && $user != "") {
        for ($i = 0; $i < count($tabObj) - 1; $i += 1) {
            $tabElement = explode("::", $tabObj[$i]);
            $autre = '';
        /**
         * avant de update il faut dabord remettre le produit
         * ensuite supprimer la vente
         * et enfin inserer une nouvelle vente en se servant de l ancien numero d operation
         */
            if ($q !== "") {
                $hint = $q;
                $tracteur = new Ventes($tabElement[0], $tabElement[1], $tabElement[2], $tabElement[3], $tabElement[4], $tabElement[5], $tabElement[6], $tabElement[7], $tabElement[8], $tabElement[9], $tabElement[10], $tabElement[11], $tabElement[12], $tabElement[13], $tabElement[14], $tabElement[15]);
                if ($i == 0) {
                    $tracteur->findIDProduit($tabElement[5]);
                }
                $tracteur->updateVentes();
                array_push($update_table, $tracteur);
                $autre = $tracteur->message;
                if( $tracteur->message) {
                    $hint = $autre;
                    echo '<div class="alert alert-danger" role="alert">
                    Erreur fran '.$hint.'
                  </div>';
                    return;
                }
               
            }
        }
       
        for ($i = 0; $i < count($tabObj) - 1; $i += 1) {
            $tabElement = explode("::", $tabObj[$i]);
            $autre = '';
        /**
         * avant de update il faut dabord remettre le produit
         * ensuite supprimer la vente
         * et enfin inserer une nouvelle vente en se servant de l ancien numero d operation
         */
            if ($q !== "" && $user != "") {
                $hint = $q;
                $tracteur = new Ventes($tabElement[0], $tabElement[1], $tabElement[2], $tabElement[3], $tabElement[4], $tabElement[5], $tabElement[6], $tabElement[7], $tabElement[8], $tabElement[9], $tabElement[10], $tabElement[11], $tabElement[12], $tabElement[13], $tabElement[14], $tabElement[15]);
                $tracteur->insererVentes();
                $autre = $tracteur->message;
                if( $tracteur->message) {
                    $hint = $autre;
                    echo '<div class="alert alert-danger" role="alert">
                    Erreur fran '.$hint.'
                  </div>';
                    return;
                }
               
            }
        }
        
        $take_vente_tojson = new TakeVente($update_table);
        $take_vente_tojson->write_update();
        
        $sucess = '<div class="alert alert-success" role="alert">
        Modification fait avec success
      </div>';
    
      $error = '<div class="alert alert-danger" role="alert">
      Erreur '.$autre.'
    </div>';
        echo $hint == $autre ? $error : $sucess;
    }
    
    if (end($tabObj) == "delete") {
        if ($q !== "") {
            $hint = $q;
            
            $tracteur = new Ventes(0, 1, 2, 3, 4, 5, 6,7, 8, 9, 10, 11, 12, 13, 14, 15);
            $tracteur->operation = $tabObj[0];
            $tracteur->deleteVentes();
            array_push($delete_table, $tracteur);
            $autre = $tracteur->message;
            if( $tracteur->message) {
                $hint = $autre;
                echo '<div class="alert alert-danger" role="alert">
                Erreur '.$hint.'
              </div>';
                return;
            }
            
        }
        
        $take_vente_tojson = new TakeVente($delete_table);
        $take_vente_tojson->write_delete();
        
            $sucess = '<div class="alert alert-success" role="alert">
            Suppression fait avec success
          </div>';
        
          $error = '<div class="alert alert-danger" role="alert">
          Erreur '.$autre.'
        </div>';
        echo $hint == $autre ? $error : $sucess;
    } 

?>