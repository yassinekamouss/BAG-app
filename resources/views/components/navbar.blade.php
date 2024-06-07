<nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="navbar">
  <div class="container">
    <a class="navbar-brand" href="{{route('home')}}">
      <img src="{{ asset('Images/Hyundai-Logo-PNG-Transparent.png') }}" alt=""> 
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse ms-lg-3" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('home')}}">Acceuil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('about') }}">A propos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('contact.form') }}">Contact</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Catégories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('categories.show' , 6) }}">Transmission</a></li>
            <li><a class="dropdown-item" href="{{ route('categories.show' , 2) }}">Moteurs</a></li>
            <li><a class="dropdown-item" href="{{ route('categories.show' , 5) }}">Electrique</a></li>
            <li><a class="dropdown-item" href="{{ route('categories.show' , 4) }}">Chasseries</a></li>
            <li><a class="dropdown-item" href="{{ route('categories.show' , 3) }}">Carrosserie et Garniture</a></li>
            <li><a class="dropdown-item" href="{{ route('categories.show' , 1) }}">Accessoires Voiture</a></li>
            <li><a class="dropdown-item" href="{{ route('categories.show' , 8) }}">Disque de frien</a></li>
            <li><a class="dropdown-item" href="{{ route('categories.show' , 7) }}">Ampoules</a></li>
            <li><a class="dropdown-item" href="{{ route('categories.show' , 13) }}">Produits de nettoyage</a></li>
            <li><a class="dropdown-item" href="{{ route('categories.show' , 12) }}">Pneus</a></li>
            <li><a class="dropdown-item" href="{{ route('categories.show' , 10) }}">Pièces moteur</a></li>
            <li><a class="dropdown-item" href="{{ route('categories.show' , 9) }}">Huile moteur</a></li>
            <li><a class="dropdown-item" href="{{ route('categories.show' , 11) }}">Plaquette de frein</a></li>
            <li><a class="dropdown-item" href="{{ route('categories.show' , 14) }}">Batterie</a></li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <div class="search-container d-none">
            <form class="d-flex search-form m-auto position-relative  left-50 w-lg-100" >
              <input id="search-input" class="form-control rounded-4 search-input me-2" type="search" placeholder="Search" aria-label="Search" autofocus>
              <div class="position-absolute top-100 w-100">
                <div id="produits_de_suggestion" class=""></div>
              </div>
            </form>  
          </div>
        </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-solid fa-magnifying-glass" id="search-icon"></i> 
            </a>
          </li>
          @auth
            <li class="nav-item">
              <a href="{{route('users.profile')}}" class="nav-link" role="button">
                <i class="fa-solid fa-user"></i>Profile
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('connecte.logout')}}" class="nav-link" role="button">
                <i class="fa-solid fa-right-from-bracket"></i>Logout
              </a>
            </li>
          @endauth
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="https://www.google.com/maps/place/Florida+centre+park/@33.519589,-7.635095,15z/data=!4m6!3m5!1s0xda62dba5bf1c4fd:0xf10f650ef3b3315e!8m2!3d33.5215084!4d-7.6363821!16s%2Fg%2F11m_kvc6jm?hl=fr&entry=ttu">
              <i class="fa-solid fa-location-dot text-center"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('paniers.show')}}">
              <i class="fa-solid fa-cart-shopping"></i>
                @auth
                  @if(auth()->user()->panier()->exists())
                    <span>({{ count(auth()->user()->panier->detailsPanier) }})</span>
                  @else
                    <span>(0)</span>
                  @endif
                @endauth
                @guest
                  <span>(0)</span>
                @endguest
            </a>
          </li>
          @guest
          <li class="nav-item ms-3">
            <a href="{{route('connecte.login.show')}}" class="nav-link text-decoration-none">
              Se connecter
            </a>
          </li>
            <li class="nav-item ms-3">
              <a href="{{route('connecte.sign.show')}}" class="nav-link btn btn-warning bg-warning rounded-4 text-white">Sign In</a>
            </li>
          @endguest 
      </ul>
    </div>
  </div>
</nav>