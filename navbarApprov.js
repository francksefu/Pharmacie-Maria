const main = document.querySelector('main');
function navbar() {
  const header = document.createElement('header');
  const nav = document.createElement('nav');


  header.classList.add('position-fixed', 'w-100', 'shadow');
  nav.classList.add('navbar', 'navbar-expand-sm', 'navbar-dark', 'bg-dark');
  nav.innerHTML = `<div class="container-fluid">
  <a class="navbar-brand" href="maria.php">Maria</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="mynavbar">
    <ul class="navbar-nav me-auto">
      
     
      
      

      

      <li class="nav-item pe-3 dropdown" >
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-emoji-heart-eyes-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zM4.756 4.566c.763-1.424 4.02-.12.952 3.434-4.496-1.596-2.35-4.298-.952-3.434zm6.559 5.448a.5.5 0 0 1 .548.736A4.498 4.498 0 0 1 7.965 13a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .548-.736h.005l.017.005.067.015.252.055c.215.046.515.108.857.169.693.124 1.522.242 2.152.242.63 0 1.46-.118 2.152-.242a26.58 26.58 0 0 0 1.109-.224l.067-.015.017-.004.005-.002zm-.07-5.448c1.397-.864 3.543 1.838-.953 3.434-3.067-3.554.19-4.858.952-3.434z"/>
              </svg>
            Approvisionnements
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="approvisionnement.php">Listez les approvisionnement</a></li>
          <li><a class="dropdown-item" href="addApprovisionnement.php">Ajoutez les approvisionnements</a></li>
        </ul>
      </li>

      

      
    </ul>
    
  </div>
</div>
`;

  document.body.insertBefore(header, main);
  header.appendChild(nav);
  
}

window.addEventListener('load', navbar);