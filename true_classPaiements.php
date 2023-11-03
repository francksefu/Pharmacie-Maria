<?php
include 'write_read_json.php';
    class  Paiements {
        public $idPaiements;
        private $dates;
        private $montant;
        private $operation;
        
        //table for contain json 

        private $insert_arr = array();
        private $update_arr = array();
        private $delete_arr = array();

        public $message;

        function __construct($dates, $montant, $operation) {
        
            $this->dates = $dates;
            $this->montant = $montant;
            $this->operation = $operation;
            $this->read();
        }

        function read() {
            read($this->insert_arr, $this->update_arr, $this->delete_arr, "data_paiement_vente.json");
        }

        function write() {
            write($this->insert_arr, $this->update_arr, $this->delete_arr, "data_paiement_vente.json");
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
            $sql = ("SELECT * FROM Ventes WHERE (Operation = $operation) GROUP BY Operation  limit 1");
            $result = mysqli_query($db, $sql);
            $montant = 0;
            $total_facture = 1;
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    $montant = $row["MontantPaye"];
                    $total_facture = $row["TotalFacture"];
                }

                if ($montant == $total_facture) {
                    $updC6= ("UPDATE `Ventes` SET Dette = 'Non' WHERE Operation = $operation");
                    if(mysqli_query($db,$updC6)){echo"";}else{
                        $this->message = mysqli_error($db);
                        return;
                    } 
                } else {
                    $updC6= ("UPDATE `Ventes` SET Dette = 'Oui' WHERE Operation = $operation");
                    if(mysqli_query($db,$updC6)){echo"";}else{
                        $this->message = mysqli_error($db);
                        return;
                    } 
                }
                      
           }else{echo "Une erreur s est produite ";}

        }
        function enleveVentes($idPaiements) {
            include 'connexion.php';
            $operationA = 0;
            $montantA = 0;
            $sql1 = ("SELECT * FROM Paiements WHERE (idPaiements = $idPaiements)");
            $result1 = mysqli_query($db, $sql1);
                    
            if(mysqli_num_rows($result1)>0){
                                
                while($row1= mysqli_fetch_assoc($result1)){
                    $operationA = $row1["Operation"];
                    $montantA = $row1["Montant"];
                }
 
           }else{$this->message = "Une erreur s est produite ";}

            $sql = ("SELECT * FROM Ventes WHERE (Operation = $operationA) GROUP BY Operation  limit 1");
            $result = mysqli_query($db, $sql);
            $valeur = 0;
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    $valeur = $row["MontantPaye"];
                }
                $updC6= ("UPDATE `Ventes` SET MontantPaye = $valeur - $montantA WHERE (Operation = $operationA)");
                if(mysqli_query($db,$updC6)){echo"";}else{
                    $this->message = mysqli_error($db);
                    return;
                }       
           }else{$this->message = "Une erreur s est produite ";}

        }
        function ventes($operation) {
            include 'connexion.php';
            $sql = ("SELECT * FROM Ventes WHERE (Operation = $operation) GROUP BY Operation  limit 1");
            $result = mysqli_query($db, $sql);
            $valeur = 0;
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    $valeur = $row["MontantPaye"];
                }
                $updC6= ("UPDATE `Ventes` SET MontantPaye = $valeur + $this->montant WHERE Operation = $operation");
                if(mysqli_query($db,$updC6)){echo"";}else{
                    $this->message = mysqli_error($db);
                    return;
                }       
           }else{echo "Une erreur s est produite ";}

        }
        function insererPaiements() {
            include 'connexion.php';
            $sql = ("INSERT INTO Paiements ( DatesPaie, Montant, Operation) values ('".$this->dates."', $this->montant, $this->operation)");
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
            $this->ventes($this->operation);
            $this->updateDette($this->operation);
        }

        function deletePaiements() {
            include 'connexion.php';
            $this->enleveVentes($this->idPaiements);
            $delete = ("DELETE FROM Paiements WHERE idPaiements =$this->idPaiements");
            if (mysqli_query($db, $delete)){echo"";} else {
                $this->message = mysqli_error($db);
                return;
            }
        }

    }

    
?>