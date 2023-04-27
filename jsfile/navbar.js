const main = document.querySelector('main');
function navbar() {
  const header = document.createElement('header');
  const nav = document.createElement('nav');


  header.classList.add('position-fixed', 'w-100', 'shadow');
  nav.classList.add('navbar', 'navbar-expand-sm', 'navbar-dark', 'bg-dark');
  nav.innerHTML = `<div class="container-fluid">
  <a class="navbar-brand" href="index.php">Gedeon</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="mynavbar">
    <ul class="navbar-nav me-auto">
      <li class="nav-item pe-3 dropdown" >
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
           
            Besoin du tracteur
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="tracteur.php">Liste les besoins</a></li>
            <li><a class="dropdown-item" href="addBesoin.php">Ajouter un besoin</a></li>
            <li><a class="dropdown-item" href="updateBesoin.php">Modifier un besoin</a></li>
          </ul>
      </li>
     
      <li class="nav-item pe-3 dropdown" >
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
              </svg>
            Travail
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="champs.php">Liste des champs cultivé ou tours</a></li>
            <li><a class="dropdown-item" href="addChamps.php">Ajouter champs cultivé ou tours</a></li>
            <li><a class="dropdown-item" href="updateChamps.php">Modifier champs cultivé ou tours</a></li>
            <li><a class="dropdown-item" href="ventes.php">Liste des ventes et interets</a></li>
            <li><a class="dropdown-item" href="addVentes.php">Ajoutez ventes</a></li>
            <li><a class="dropdown-item" href="updateVentes.php">Modifier ventes</a></li>
          </ul>
      </li>
      <li class="nav-item pe-3 dropdown" >
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-emoji-heart-eyes-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zM4.756 4.566c.763-1.424 4.02-.12.952 3.434-4.496-1.596-2.35-4.298-.952-3.434zm6.559 5.448a.5.5 0 0 1 .548.736A4.498 4.498 0 0 1 7.965 13a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .548-.736h.005l.017.005.067.015.252.055c.215.046.515.108.857.169.693.124 1.522.242 2.152.242.63 0 1.46-.118 2.152-.242a26.58 26.58 0 0 0 1.109-.224l.067-.015.017-.004.005-.002zm-.07-5.448c1.397-.864 3.543 1.838-.953 3.434-3.067-3.554.19-4.858.952-3.434z"/>
              </svg>
            Peoples
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="personnels.php">lister les personnels</a></li>
            <li><a class="dropdown-item" href="addPersonnels.php">Ajoutez personnels</a></li>
            <li><a class="dropdown-item" href="definirSalaire.php">Liste des salaires</a></li>
            <li><a class="dropdown-item" href="addSalaire.php">Ajoutez salaire</a></li>
            <li><a class="dropdown-item" href="donnerSalaire.php">Liste les paiements</a></li>
            <li><a class="dropdown-item" href="addPaiements.php">Ajoutez paiements</a></li>
          </ul>
      </li>

      <li class="nav-item pe-3 dropdown" >
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
              </svg>
            Caisse
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="caisseOut.php">Listez les sorties dans caisse</a></li>
            <li><a class="dropdown-item" href="addCaisseout.php">Ajoutez sortie dans caisse</a></li>
            <li><a class="dropdown-item" href="updateCaisseOut.php">Modifier sortie dans caisse</a></li>
            <li><a class="dropdown-item" href="caisseIn.php">Listez les entrer dans caisse</a></li>
            <li><a class="dropdown-item" href="addCaissein.php">Ajoutez entrer dans caisse</a></li>
            <li><a class="dropdown-item" href="updateCaisseIn.php">Modifier entrer dans caisse</a></li>
          </ul>
      </li>

      <li class="nav-item pe-3 dropdown" >
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-scooter" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M9 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-.39l1.4 7a2.5 2.5 0 1 1-.98.195l-.189-.938-2.43 3.527A.5.5 0 0 1 9.5 13H4.95a2.5 2.5 0 1 1 0-1h4.287l2.831-4.11L11.09 3H9.5a.5.5 0 0 1-.5-.5ZM3.915 12a1.5 1.5 0 1 0 0 1H2.5a.5.5 0 0 1 0-1h1.415Zm8.817-.789A1.499 1.499 0 0 0 13.5 14a1.5 1.5 0 0 0 .213-2.985l.277 1.387a.5.5 0 0 1-.98.196l-.278-1.387Z"/>
        </svg>
            Autres
        </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="depot.php">Listez les depots</a></li>
                <li><a class="dropdown-item" href="addDepot.php">Ajoutez dans depot</a></li>
            </ul>
        </li>

      <li class="nav-item pe-3">
        <a class="nav-link" href="rapport.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-text" viewBox="0 0 16 16">
                <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
              </svg>
            Reports
        </a>
      </li>
    </ul>
    
  </div>
</div>
`;

  document.body.insertBefore(header, main);
  header.appendChild(nav);
  
}

window.addEventListener('load', navbar);