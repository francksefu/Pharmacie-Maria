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
    include 'true_classApprov.php'; // the location of class

    $q = $_REQUEST["q"];
    $tabObj = explode("__:", $q);
    $autre = '';
    $hint = '';


    if (end($tabObj) == "add" && $user != "") {
    for ($i = 0; $i < count($tabObj) - 1; $i += 1) {
        $tabElement = explode("::", $tabObj[$i]);
        $autre = '';
    
        if ($q !== "") {
            $hint = $q;
            $tracteur = new Approvisionnement($tabElement[0], $tabElement[1], $tabElement[2], $tabElement[3], $tabElement[4], $tabElement[5], $tabElement[6], $tabElement[7]);
            $tracteur->insererApprov();
            
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
                $tracteur = new Approvisionnement($tabElement[0], $tabElement[1], $tabElement[2], $tabElement[3], $tabElement[4], $tabElement[5], $tabElement[6], $tabElement[7]);
                if ($i == 0) {
                    $tracteur->findIDProduit($tabElement[4]);//commence par remettre ce qui etait dans le stock avant l operation
                }
                $tracteur->updateApprov();
                
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
            if ($q !== "") {
                $hint = $q;
                $tracteur = new Approvisionnement($tabElement[0], $tabElement[1], $tabElement[2], $tabElement[3], $tabElement[4], $tabElement[5], $tabElement[6], $tabElement[7]);
                $tracteur->insererApprov();
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
        
        $sucess = '<div class="alert alert-success" role="alert">
        Modification fait avec success
      </div>';
    
      $error = '<div class="alert alert-danger" role="alert">
      Erreur '.$autre.'
    </div>';
        echo $hint == $autre ? $error : $sucess;
    }
    
    if (end($tabObj) == "delete" && $user != "") {
        if ($q !== "") {
            $hint = $q;
            
            $tracteur = new Approvisionnement(0, 1, 2, 3, 4, 5, 6,7);
            $tracteur->operation = $tabObj[0];
            $tracteur->deleteVentes();
            
            $autre = $tracteur->message;
            if( $tracteur->message) {
                $hint = $autre;
                echo '<div class="alert alert-danger" role="alert">
                Erreur '.$hint.'
              </div>';
                return;
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