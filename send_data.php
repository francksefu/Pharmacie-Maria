<?php
  include 'true_classCaisseout.php';
  $insert_caisse = array();
  $update_caisse = array();
  $delete_caisse = array();

  read($insert_caisse, $update_caisse, $delete_caisse, "data_caisse_out.json");

  for ($i = 0; $i < count($insert_caisse); $i ++) {
    $caisse = new Sortie($insert_caisse[$i]['montant'], $insert_caisse[$i]['motif'], $insert_caisse[$i]['type'], $insert_caisse[$i]['datesout']);
    $caisse->remote = true;
    $caisse->insererSortie();
    echo "Insertion fait avec sucess";
  }

  for ($i = 0; $i < count($update_caisse); $i ++) {
    $salaire = new Sortie($update_caisse[$i]['montant'], $update_caisse[$i]['motif'], $update_caisse[$i]['type'], $update_caisse[$i]['datesout']);
    $salaire->remote = true;
    $salaire->idSortie = $update_caisse[$i]['idSortie'];
    $salaire->updateSortie();
    echo "Insertion fait avec sucess";
  }

  //write(array(), array(), array(), "data_caisse_out.json");

  for ($i = 0; $i < count($delete_caisse); $i ++) {
    $caisse = new Sortie(0, 1, 2, 3);
    $caisse->remote = true;
    $caisse->idSortie = $delete_caisse[$i]['idSortie'];
    $caisse->deleteCaisse();
    echo "Insertion fait avec sucess";
  }

  write(array(), array(), array(), "data_caisse_out.json");
?>