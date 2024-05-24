<div class="col-12 col-lg-4 mb-4 mb-lg-" id="profileBare">
    <div class="position-sticky left-0 bg-light rounded-4" style="top : 100px ;">
        <ul class="nav flex-column w-100 p-4 taches_profile">
            <li class="nav-item mt-3 py-2">
                <div class="d-flex align-items-center">
                    <div class=""  id="profileId">
                        <i class="fa-solid fa-circle-user"></i>
                    </div>
                    <div class="ms-2 d-flex flex-column ">
                        <span class="fs-5">{{auth()->user()->prenom}} {{auth()->user()->nom}}</span>
                        <span class="">{{auth()->user()->email}}</span> 
                    </div> 
                </div>
            </li>
            <hr class="w-100">
            <li class="nav-item mt-3 py-2 d-flex justify-content-between align-items-center">
                <span  class="nav-link text-dark" id="accueilIcon">
                    <i class="fa-solid fs-5 me-3 fa-house-user p-3 rounded-circle"></i><span class="li-text d-sm-inline ">Accueil</span>
                </span>
            </li>
            <li class="nav-item mt-3 py-2 d-flex justify-content-between align-items-center">
                <span  class="nav-link text-dark" id="parametreIcon">
                    <i class="fa-solid fs-5 fa-gear me-3 p-3 rounded-circle"></i><span class="li-text d-sm-inline ">Paramètres du profil</span>
                </span>
            </li>
            <li class="nav-item mt-3 py-2 d-flex justify-content-between align-items-center">
                <span href="" class="nav-link text-dark" id="commandesIcon">
                    <i class="fa-solid fs-5 fa-clipboard me-3 p-3 rounded-circle"></i><span class="li-text d-sm-inline ">Commandes</span>
                </span>
            </li>
            <li class="nav-item mt-3 py-2 d-flex justify-content-between align-items-center">
                <a href="{{route('connecte.logout')}}" class="nav-link text-dark">
                    <i class="fa-solid fs-5 fa-right-from-bracket me-3 p-3 rounded-circle"></i><span class="li-text d-sm-inline ">Logout</span>
                </a>
                
            </li>
        </ul>
    </div>
</div>