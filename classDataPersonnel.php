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
    include 'true_classDataPersonnel.php';
    $q = $_REQUEST["q"];
    $tabC = explode("::", $q);
   
    $autre = '';
    if (end($tabC) == 'add' && $user != "") {
        if ($q !== "") {
            $hint = $q;
            $tracteur = new Personnel($tabC[0], $tabC[1], $tabC[2], $tabC[3]);
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
    if (end($tabC) == 'update' && $user != "") {
        if ($q !== "") {
            $hint = $q;
            $tracteur = new Personnel($tabC[0], $tabC[1], $tabC[2], $tabC[3]);
            $tracteur->idClient = $tabC[3];
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
            $tracteur = new Personnel(0, 1, 2, 3);
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