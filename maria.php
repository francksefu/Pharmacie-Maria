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
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
      include 'head.php';
    ?>
    <link rel="stylesheet" href="index.css">
    <style> img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] { display: none;} 
    </style>
    
</head>

<?php
function prediction($sql) {
    $data_input = 0;
    //$data_out = '';
    include 'connexion.php';
    //$sql= ("SELECT * FROM Ventes, Produit WHERE (Ventes.idProduit = Produit.idProduit)");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
        while($row= mysqli_fetch_assoc($result)){
            //echo"<option value='ID ::".$row["Operation"].":: date ::".$row["DatesVente"].":: client  ::".$row["NomClient"].":: Total facture ::".$row["TotalFacture"]."'>client = ".$row["NomClient"]." dette : ".$row["Dette"]."</option>"; 
            $data_input += $row["QuantiteVendu"];
            
        }
        
   }else{$data_input = 0;}
   
   return $data_input;
}
function dataProduct(){
    include 'connexion.php';
    $sql = ("SELECT * FROM Produit order by Nom asc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
        
        while($row= mysqli_fetch_assoc($result)){
            $id = $row["idProduit"];
            $sq= ("SELECT * FROM Ventes, Produit WHERE ( Ventes.idProduit = $id) and (Ventes.idProduit = Produit.idProduit)");
            $valeur = prediction($sq);
            echo'
            <div class=" border border-1 p-3   ms-2" style="width:200px; height: 200px;">
                <img src="banane.png" alt="Product-1" class="img-fluid rounded-3">
                <h6>'.$row["Nom"].'</h6>
                <p class="text-secondary">'.$valeur.' items</p>
            </div>';
        }
                
   }else{echo "Une erreur s est produite ";}  
   
}
?>
<body class="bg-light">
    <?php 
        if($user == "") {
            echo "<h1> Vous ne pouvez pas voir cette page sans autorisation</h1><br>";
            echo "<h1> Vous ne pouvez pas voir cette page sans autorisation</h1><br>";
            echo "<h1> Vous ne pouvez pas voir cette page sans autorisation</h1><br>";
        } else {
    ?>
     <main>
        <div class="container bg-transparent pt-5">
            <div class="row bg-transparent pt-5">
                <div class="col-md-5 bg-transparent m-2">
                    <h2>Hi <?php echo $user; ?>, Good Morning</h2>
                    <p class=" text-secondary pt-3">
                        Votre dashboard vous donne une vues sur vos performances ou l evolution
                         de votre busness
                    </p>
                </div>
                <div class="col-md-3 bg-transparent border border-1 pt-3 pb-3 d-flex flex-row m-2 rounded-3">
                    <div class="p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                          </svg>
                    </div>
                    <div class="p-3">
                        <p class="">Total vendues</p>
                        <h2 class="">look number of item</h2>
                        <a href='index.php?deconnexion=true' >Déconnexion</a>
                    </div>
                   
                </div>
                <div class="col-md-3 bg-transparent border border-1 pt-3 pb-3 d-flex flex-row m-2 rounded-3">
                    <div class="p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                            <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.501.501 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89L8 0ZM3.777 3h8.447L8 1 3.777 3ZM2 6v7h1V6H2Zm2 0v7h2.5V6H4Zm3.5 0v7h1V6h-1Zm2 0v7H12V6H9.5ZM13 6v7h1V6h-1Zm2-1V4H1v1h14Zm-.39 9H1.39l-.25 1h13.72l-.25-1Z"/>
                        </svg>
                    </div>
                    <div class="p-3">
                        <p class="">Total vendues</p>
                        <h2 class="">in top product</h2>
                    </div>
                    
                </div>
            </div>
    
            <div class=" p-3 mb-5 border border-1 rounded mt-5" id="sa">
                <h2 class="p-2">Top product</h2>
                <hr class="w-auto">
                <div class="d-flex flex-row ps-1 pe-1 pt-3 pb-3" style="width:100%; overflow-x: auto; overflow-y: hidden;">
                    <?php
                        dataProduct();
                    ?>
                </div>
            </div>
            
        </div>
     </main>

    

    <footer>
        <hr class="w-100">
        <p class="text-secondary text-center p-3">&copy; copyright Maria</p>
    </footer>
    <?php } ?>
    <!--<script  src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>-->
</body>
</html>