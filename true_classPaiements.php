<?php
include 'write_read_json.php';
    class  Paiements {
        public $idPaiements;
        private $dates;
        private $montant;
        private $operation;
        private $stock;
        
        //table for contain json 

        private $insert_arr = array();
        private $update_arr = array();
        private $delete_arr = array();

        public $message;

        function __construct($dates, $montant, $operation, $stock) {
       
            $this->dates = $dates;
            $this->montant = $montant;
            $this->operation = $operation;
            $this->stock = $stock;
            //$this->read();
        }

        function read() {
            read($this->insert_arr, $this->update_arr, $this->delete_arr, "data_paiement_vente.json");
        }

        function write() {
           // write($this->insert_arr, $this->update_arr, $this->delete_arr, "data_paiement_vente.json");
        }

        function write_insert() {
            array_push($this->insert_arr, (array("dates"=>$this->dates, "montant"=>$this->montant, "operation"=>$this->operation)));
            $this->write();
        }

        function write_update() {
            array_push($this->update_arr, (array("idPaiements"=>$this->idPaiements ,"dates"=>$this->dates, "montant"=>$this->montant, "operation"=>$this->operation)));
            $this->write();
        }

        function write_delete() {
            array_push($this->delete_arr, (array("idPaiements"=> $this->idPaiements)));
            $this->write();
        }

        function updateDette($operation) {
            include 'connexion.php';
            if ($this->stock == 'stock1') {
                $sql = ("SELECT * FROM Ventes WHERE (Operation = $operation) GROUP BY Operation  limit 1");
            } else {
                $sql = ("SELECT * FROM Ventes2 WHERE (Operation = $operation) GROUP BY Operation  limit 1");
            }
            
            $result = mysqli_query($db, $sql);
            $montant = 0;
            $total_facture = 1;
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    $montant = $row["MontantPaye"];
                    $total_facture = $row["TotalFacture"];
                }

                if ($montant == $total_facture) {
                    if ($this->stock == 'stock1') {
                        $updC6= ("UPDATE `Ventes` SET Dette = 'Non' WHERE Operation = $operation");
                        if(mysqli_query($db,$updC6)){echo"";}else{
                            $this->message = mysqli_error($db);
                            return;
                        } 
                    } else {
                        $updC6= ("UPDATE `Ventes2` SET Dette = 'Non' WHERE Operation = $operation");
                        if(mysqli_query($db,$updC6)){echo"";}else{
                            $this->message = mysqli_error($db);
                            return;
                        } 
                    }
                    
                } else {
                    if ($this->stock == 'stock1') {
                        $updC6= ("UPDATE `Ventes` SET Dette = 'Oui' WHERE Operation = $operation");
                        if(mysqli_query($db,$updC6)){echo"";}else{
                            $this->message = mysqli_error($db);
                            return;
                        }
                    } else {
                        $updC6= ("UPDATE `Ventes2` SET Dette = 'Oui' WHERE Operation = $operation");
                        if(mysqli_query($db,$updC6)){echo"";}else{
                            $this->message = mysqli_error($db);
                            return;
                        }
                    }
                     
                }
                      
           }else{echo "Une erreur s est produite 1 ";}

        }
        function enleveVentes($idPaiements) {
            include 'connexion.php';
            $operationA = 0;
            $montantA = 0;
            if ($this->stock == 'stock1'){
                $sql1 = ("SELECT * FROM Paiements WHERE (idPaiements = $idPaiements)");
            } else {
                $sql1 = ("SELECT * FROM Paiements2 WHERE (idPaiements = $idPaiements)");
            }
            
            $result1 = mysqli_query($db, $sql1);
                    
            if(mysqli_num_rows($result1)>0){
                                
                while($row1= mysqli_fetch_assoc($result1)){
                    $operationA = $row1["Operation"];
                    $montantA = $row1["Montant"];
                }
 
           }else{$this->message = "Une erreur s est produite ";}
            if ($this->stock == 'stock1') {
                $sql = ("SELECT * FROM Ventes WHERE (Operation = $operationA) GROUP BY Operation  limit 1");
            } else {
                $sql = ("SELECT * FROM Ventes2 WHERE (Operation = $operationA) GROUP BY Operation  limit 1");
            }
            
            $result = mysqli_query($db, $sql);
            $valeur = 0;
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    $valeur = $row["MontantPaye"];
                }
                if ($this->stock == 'stock1') {
                    $updC6= ("UPDATE `Ventes` SET MontantPaye = $valeur - $montantA WHERE (Operation = $operationA)");
                    if(mysqli_query($db,$updC6)){echo"";}else{
                        $this->message = mysqli_error($db);
                        return;
                    }
                } else {
                    $updC6= ("UPDATE `Ventes2` SET MontantPaye = $valeur - $montantA WHERE (Operation = $operationA)");
                    if(mysqli_query($db,$updC6)){echo"";}else{
                        $this->message = mysqli_error($db);
                        return;
                    }
                }
                       
           }else{$this->message = "Une erreur s est produite 2";}

        }
        function ventes($operation) {
            include 'connexion.php';
            if ($this->stock == 'stock1') {
                $sql = ("SELECT * FROM Ventes WHERE (Operation = $operation) GROUP BY Operation  limit 1");
            } else {
                $sql = ("SELECT * FROM Ventes2 WHERE (Operation = $operation) GROUP BY Operation  limit 1");
            }
            
            $result = mysqli_query($db, $sql);
            $valeur = 0;
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    $valeur = $row["MontantPaye"];
                }
                if ($this->stock == 'stock1') {
                    $updC6= ("UPDATE `Ventes` SET MontantPaye = $valeur + $this->montant WHERE Operation = $operation");
                    if(mysqli_query($db,$updC6)){echo"";}else{
                        $this->message = mysqli_error($db);
                        return;
                    } 
                } else {
                    $updC6= ("UPDATE `Ventes2` SET MontantPaye = $valeur + $this->montant WHERE Operation = $operation");
                    if(mysqli_query($db,$updC6)){echo"";}else{
                        $this->message = mysqli_error($db);
                        return;
                    } 
                }
                      
           }else{echo "Une erreur s est produite 3";}

        }
        function insererPaiements() {
            include 'connexion.php';
            if ($this->stock == 'stock1') {
                $sql = ("INSERT INTO Paiements ( DatesPaie, Montant, Operation) values ('".$this->dates."', $this->montant, $this->operation)");
            } else {
                $sql = ("INSERT INTO Paiements2 ( DatesPaie, Montant, Operation) values ('".$this->dates."', $this->montant, $this->operation)");
            }
            
            if(mysqli_query($db, $sql)){
                }else{
                $this->message = mysqli_error($db);
            }
            $this->ventes($this->operation);
            $this->updateDette($this->operation);
        }
       function updatePaiements() {
            include 'connexion.php';
            $this->enleveVentes($this->idPaiements);

            if ($this->stock == 'stock1') {
                $updC1= ("UPDATE `Paiements` SET `DatesPaie` ='".$this->dates."' WHERE idPaiements =$this->idPaiements");
                if(mysqli_query($db,$updC1)){echo"";}else{
                    $this->message = mysqli_error($db);
                    return;
                }
                $updC2= ("UPDATE `Paiements` SET `Operation` = $this->operation WHERE idPaiements =$this->idPaiements");
                if(mysqli_query($db,$updC2)){echo"";}else{
                    $this->message = mysqli_error($db);
                    return;
                }
                $updC3= ("UPDATE `Paiements` SET `Montant` = $this->montant WHERE idPaiements =$this->idPaiements");
                if(mysqli_query($db,$updC3)){echo"";}else{
                    $this->message = mysqli_error($db);
                    return;
                }
            } else {
                $updC1= ("UPDATE `Paiements2` SET `DatesPaie` ='".$this->dates."' WHERE idPaiements =$this->idPaiements");
                if(mysqli_query($db,$updC1)){echo"";}else{
                    $this->message = mysqli_error($db);
                    return;
                }
                $updC2= ("UPDATE `Paiements2` SET `Operation` = $this->operation WHERE idPaiements =$this->idPaiements");
                if(mysqli_query($db,$updC2)){echo"";}else{
                    $this->message = mysqli_error($db);
                    return;
                }
                $updC3= ("UPDATE `Paiements2` SET `Montant` = $this->montant WHERE idPaiements =$this->idPaiements");
                if(mysqli_query($db,$updC3)){echo"";}else{
                    $this->message = mysqli_error($db);
                    return;
                }
            }
            
            $this->ventes($this->operation);
            $this->updateDette($this->operation);
        }

        function deletePaiements() {
            include 'connexion.php';
            $this->enleveVentes($this->idPaiements);
            $delete = ("DELETE FROM Paiements WHERE idPaiements =$this->idPaiements");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = mysqli_error($db) .'ici';
                return;
            }
        }

        function deletePaiements2() {
            include 'connexion.php';
            $this->enleveVentes($this->idPaiements);
            $delete = ("DELETE FROM Paiements2 WHERE idPaiements =$this->idPaiements");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = mysqli_error($db);
                return;
            }
        }

    }

    
?>