<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css" media="screen" type="text/css" />
</head>

<body style="background: url(imageAlim.png) no-repeat center fixed; background-size:cover">

    
        <div id="">
            <!-- zone de connexion -->
            
            <form action="<?php echo htmlspecialchars("verifionConnexion.php")?>" method="post">
                <h1 style="text-align: center;margin: 20px 0">Bienvenu...</h1>
                
                <label><b style="margin: 0 10%;">Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <label><b style="margin: 0 10%;">Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                 <input type="submit" id='submit' value='LOGIN' >
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
                ?>
            </form>
        </div>
    
</body>
</html>