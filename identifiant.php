<?php 
$user = "";
$post_user = "";
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
    $post_user = $_SESSION['username'];
}

function dataChercheurPersonnel($use){
    include 'connexion.php';
    $take = '';
    $sql = ("SELECT * FROM DataPersonnel WHERE (NomP = '".$use."') order by idDataPersonnel desc");
    $result = mysqli_query($db, $sql);
            
    if(mysqli_num_rows($result)>0){
                        
        while($row= mysqli_fetch_assoc($result)){
            $take .= $row["Poste"];
        }
               
   }else{$take = "Une erreur s est produite ";} 
   return $take;
  
  }

  if ($post_user != "") {
    $user = dataChercheurPersonnel($post_user);
  }
  
?>