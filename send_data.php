<?php
  include 'write_read_json.php';
  include 'true_classCaisseout.php';
  include 'true_classProduct.php';
  include 'true_classApprov.php';
// produit
  $insert_arr = array();
  $update_arr = array();
  $delete_arr = array();

  read($insert_arr, $update_arr, $delete_arr, "data_stock.json");

  for ($i = 0; $i < count($insert_arr); $i ++) {
    $produit = new Produit($insert_arr[$i]['nom'], $insert_arr[$i]['pa'], $insert_arr[$i]['pv'], $insert_arr[$i]['pvmin'], $insert_arr[$i]['quantite'], $insert_arr[$i]['quantiteMin'], $insert_arr[$i]['description']);
    $produit->remote = true;
    $produit->insererProduct();
    echo "Insertion fait avec sucess";
  }

  for ($i = 0; $i < count($update_arr); $i ++) {
    $produit = new Produit($update_arr[$i]['nom'], $update_arr[$i]['pa'], $update_arr[$i]['pv'], $update_arr[$i]['pvmin'], $update_arr[$i]['quantite'], $update_arr[$i]['quantiteMin'], $update_arr[$i]['description']);
    $produit->remote = true;
    $produit->idProduit = $update_arr[$i]['idProduit'];
    $produit->updateProduct();
    echo "Insertion fait avec sucess";
  }

  for ($i = 0; $i < count($delete_arr); $i ++) {
    $produit = new Produit(1, 2, 3, 4,5,6,7);
    $produit->remote = true;
    $produit->idProduit = $delete_arr[$i]['idProduit'];
    $produit->deleteProduct();
    echo "Insertion fait avec sucess";
  }

  write(array(), array(), array(), "data_stock.json");
// fin produit
//Debut Approvisionnement
  $take_approv = new TakeApprov([1, 2]);
  for ($i = 0; $i < count($take_approv->insert_arr); $i++){
    $tracteur = new Approvisionnement($take_approv->insert_arr[$i]['idProduit'], $take_approv->insert_arr[$i]['quantite'], $take_approv->insert_arr[$i]['pu'], $take_approv->insert_arr[$i]['date'], $take_approv->insert_arr[$i]['operation'], $take_approv->insert_arr[$i]['total_facture'], $take_approv->insert_arr[$i]['source'], $take_approv->insert_arr[$i]['destination']);
    $tracteur->remote = true;
    $tracteur->insererApprov();
    echo 'Insertion Approv fait';
  }
// Debut update
  for ($i = 0; $i < count($take_approv->update_arr); $i++){
    $tracteur = new Approvisionnement($take_approv->update_arr[$i]['idProduit'], $take_approv->update_arr[$i]['quantite'], $take_approv->update_arr[$i]['pu'], $take_approv->update_arr[$i]['date'], $take_approv->update_arr[$i]['operation'], $take_approv->update_arr[$i]['total_facture'], $take_approv->update_arr[$i]['source'], $take_approv->update_arr[$i]['destination']);
    $tracteur->remote = true;
    if ($i == 0) {
      $tracteur->findIDProduit($take_approv->update_arr[$i]['operation']);//commence par remettre ce qui etait dans le stock avant l operation
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
    echo 'Remise Approv fait';
  }
  // fin de remise de produit et de suppression, maintenant faut mettre les nouvelles approvisionnement dans la table d approvisionnements
  for ($i = 0; $i < count($take_approv->update_arr); $i++){
    $tracteur = new Approvisionnement($take_approv->update_arr[$i]['idProduit'], $take_approv->update_arr[$i]['quantite'], $take_approv->update_arr[$i]['pu'], $take_approv->update_arr[$i]['date'], $take_approv->update_arr[$i]['operation'], $take_approv->update_arr[$i]['total_facture'], $take_approv->update_arr[$i]['source'], $take_approv->update_arr[$i]['destination']);
    $tracteur->remote = true;
    $tracteur->insererApprov();
    $autre = $tracteur->message;
    if( $tracteur->message) {
      $hint = $autre;
      echo '<div class="alert alert-danger" role="alert">
        Erreur fran '.$hint.'
        </div>';
      return;
    }
    echo 'Insertion Approv fait';
  }
  //Debut suppression
  for ($i = 0; $i < count($take_approv->delete_arr); $i++) {
    $tracteur = new Approvisionnement(0, 1, 2, 3, 4, 5, 6,7);
    $tracteur->remote = true;
    $tracteur->operation = $take_approv->delete_arr[$i]['operation'];
    $tracteur->deleteVentes();
    $autre = $tracteur->message;
    if( $tracteur->message) {
      $hint = $autre;
      echo '<div class="alert alert-danger" role="alert">
            Erreur '.$hint.'
      </div>';
      return;
    }
    echo 'Insertion Approv fait';
  }

  write(array(), array(), array(), "data_approv.json");

//Fin Approvisionnement
  // Caisse ou sortie
  $insert_arr = array();
  $update_arr = array();
  $delete_arr = array();

  read($insert_arr, $update_arr, $delete_arr, "data_caisse_out.json");

  for ($i = 0; $i < count($insert_arr); $i ++) {
    $caisse = new Sortie($insert_arr[$i]['montant'], $insert_arr[$i]['motif'], $insert_arr[$i]['type'], $insert_arr[$i]['datesout']);
    $caisse->remote = true;
    $caisse->insererSortie();
    echo "Insertion fait avec sucess";
  }

  for ($i = 0; $i < count($update_arr); $i ++) {
    $salaire = new Sortie($update_arr[$i]['montant'], $update_arr[$i]['motif'], $update_arr[$i]['type'], $update_arr[$i]['datesout']);
    $salaire->remote = true;
    $salaire->idSortie = $update_arr[$i]['idSortie'];
    $salaire->updateSortie();
    echo "Insertion fait avec sucess";
  }

  for ($i = 0; $i < count($delete_arr); $i ++) {
    $caisse = new Sortie(0, 1, 2, 3);
    $caisse->remote = true;
    $caisse->idSortie = $delete_arr[$i]['idSortie'];
    $caisse->deleteCaisse();
    echo "Insertion fait avec sucess";
  }

  write(array(), array(), array(), "data_caisse_out.json");
  // Caisse ou sortie 
?>