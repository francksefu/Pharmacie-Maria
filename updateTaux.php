<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'head.php'; ?>
    <script defer src="./jsfile/taux.js"></script>
    <link rel="stylesheet" href="index.css">
</head>
<?php
  function data(){
    include 'connexion.php';
    $sql = ("SELECT * FROM `Change` order by idChange desc limit 1");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            echo"<option value='ID ::".$row["idChange"].":: 1$ = ::".$row["Chilling"].":: chilling =  ::".$row["Rwandais"].":: rwandais= ::".$row["CDF"].":: Fc'>montant = ".$row["CDF"]." Fc = ".$row["Dollar"]."$</option>"; 
        }       
   }  
}

?>
<body class="back">

    <main>
    
        <div class="container bg-transparent pt-5">
            <div class=" p-3 mb-5 border border-1 rounded mt-5" id="sa">
                <h2 class="p-2">Modifier taux de change</h2>
                <hr class="w-auto">
                <div class="ps-1 pe-1 pt-3 pb-3">
                <div class="input-group mb-3  mx-auto d-block">
                        <span class="input-group-text " id="id">Identifiant*</span>
                        <input required type="text" list="dataBesoin" id="identifiantM" class="form-control w-50" placeholder="entrer identifiant" aria-label="Username" aria-describedby="nom" >
                            <datalist id="dataBesoin">
                                <?php 
                                  data();
                                ?>
                            </datalist>
                    </div>
                    <div class="row">
                        <div class="col-md-7 mb-4">
                            <div class="input-group ">
                                <span class="input-group-text">Chilling*</span>
                                <input required type="float" id="chilling" name="CM" class="form-control" placeholder="entrer cout_Mazout" aria-label="Amount (to the nearest cdf)">
                                <span class="input-group-text">Ch</span>
                            </div>
                            <small id="chillingVide"></small> 
                        </div>
                        <div class="col-md-7 mb-4">
                            <div class="input-group ">
                                <span class="input-group-text">Rwandais*</span>
                                <input required type="float" id="rwandais" name="CM" class="form-control" placeholder="entrer cout_Mazout" aria-label="Amount (to the nearest cdf)">
                                <span class="input-group-text">RWF</span>
                            </div>
                            <small id="rwandaisVide"></small> 
                        </div>
                        <div class="col-md-7 mb-4">
                            <div class="input-group ">
                                <span class="input-group-text">Congolais*</span>
                                <input required type="float" id="cdf" name="CM" class="form-control" placeholder="entrer cout_Mazout" aria-label="Amount (to the nearest cdf)">
                                <span class="input-group-text">Fc</span>
                            </div>
                            <small id="cdfVide"></small> 
                        </div>
                    </div>
                   
                    <p id="txtHint"></p>
                    <input type="hidden" value="update" id="typeFormulaire">
                    <button id='envoie' class="btn btn-primary p-3 fs-4 mt-4 w-25">Modifier</button>
                     
                </div>    
                
            </div>
            
        </div>
    
    </main>

    <footer>
        <hr class="w-100">
        <p class="text-secondary text-center p-3">&copy; copyright franck</p>
    </footer>
    
</body>
</html>