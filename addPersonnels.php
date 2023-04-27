<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap-grid.rtl.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap-reboot.rtl.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap-utilities.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap-utilities.rtl.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap-utilities.rtl.min.css">
    
    <script defer src="bootstrap-5.0.2-dist/js/bootstrap.js"></script>
    <script defer src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <script defer  src="bootstrap-5.0.2-dist/js/bootstrap.bundle.js"></script>
    <script defer src="./jsfile/navbar.js"></script>
    <script defer src="./jsfile/takePersonnels.js"></script>
    <link rel="stylesheet" href="index.css">
</head>

<body class="bg-light">

    <main>
    
        <div class="container bg-transparent pt-5">
            <div class=" p-3 mb-5 border border-1 rounded mt-5" id="sa">
                <h2 class="p-2">Add personnels</h2>
                <hr class="w-auto">
                <div class="ps-1 pe-1 pt-3 pb-3">
                <input required type="hidden" value="n" id="identifiantM" class="form-control w-50" placeholder="entrer identifiant" aria-label="Username" aria-describedby="nom" >
                    
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <div class="input-group ">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="nom">Nom du personnel*</span>
                                    <input type="text"  name="nom" id="nomPersonnel" class="form-control" placeholder="Entrer nom du personnel" aria-label="Username" aria-describedby="nom" >
                                </div>
                            </div>
                            <small id="nomVide"></small>
                        </div>

                        <div class="col-md-7 mb-3">
                            <div class="input-group ">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="nom">Telephone*</span>
                                    <input type="text"  name="nom" id="telephone" class="form-control" placeholder="Entrer numero de telephone" aria-label="Username" aria-describedby="nom" >
                                </div>
                            </div>
                            <small id="telephoneVide"></small>
                        </div>

                        <div class="col-md-7 mb-3">
                            <div class="input-group ">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="posteP">Poste*</span>
                                    <input type="text"   id="poste" class="form-control" placeholder="Entrer nom du personnel" aria-label="Username" aria-describedby="nom" >
                                </div>
                            </div>
                            <small id="posteVide"></small>
                        </div> 
                    </div>
                   
                    <p id="txtHint"></p>
                    <input type="hidden" value="add" id="typeFormulaire">
                    <button id='envoie' class="btn btn-primary p-3 fs-4 mt-4 w-25">Ajoutez</button>
                     
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