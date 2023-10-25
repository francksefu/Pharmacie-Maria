<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion</title>
    <link rel="stylesheet" href="accueil.css" media="screen" type="text/css" />
    <style>
        a{
            text-decoration: none;background-color: #555;
            color:white; 
            text-align: center;
            font-size: 18px; 
        }
        a:hover{
            background-color: #223366;
            color: white;

        }
        h1{
            color:blanchedalmond;
        }
    </style>

</head>

<body style="background: url(imageAlim2.png) no-repeat center fixed; background-size:cover">

    
        <div >
        <?php
                session_start();
                if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  
                      session_unset();
                      header("location:index.php");
                   }
                }
                else if($_SESSION['username'] !== ""){
                    $user = $_SESSION['username'];
                    // afficher un message
                    echo "<h1>Bonjour $user, vous êtes connectés</h1>";
                }
        ?>
            <!-- zone de connexion -->
            
            <form>
                <h1 style="text-align: center;margin: 20px 0;color:black;">Bienvenu...</h1>
                
            <a href='accueilEntreprise.php?deconnexion=true' >Déconnexion</a>
            <a href="produitb.php" >Produit</a>
             <a href="bonusPerte.php"  >Bonus et Perte</a>
            <a href="sortie.php"  >Sorties</a>
            <a href="diminution.php"  >Diminution</a>
            <a href="Client.php"  >Client</a>
            <a href="detteClient.php"  >Dettes clients</a>
            <a href="detteEntreprise.php" >Dette Entreprise</a>
            <a href="etats.php"  >Les Etats</a>
            <a href="caisse.php" >Caisse</a>
            </form>
        </div>
    
</body>
</html>