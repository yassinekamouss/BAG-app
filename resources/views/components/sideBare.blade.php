<div class="bg-dark col-auto side-bare vh-100 position-sticky left-0 top-0 shadow">
    <div class="bg-dark p-2">
        {{-- <i class="fa-solid fa-arrow-left fs-4 text-light ms-3 mt-5" id="display-sidebar"></i> --}}
        <i class="fa-solid fa-chevron-left fs-5 text-light ms-sm-4 mt-5" id="display-sidebar"></i>
        <div class="d-flex justify-content-center align-items-center text-decoration-none text-white">
            <span class="fs-3 mt-2 fw-bold d-none d-lg-inline ms-2 list-de-task-admin" id="list-de-task-admin">
                Admin page
            </span>
        </div>
        <ul class="nav nav-pills w-100 flex-column justify-content-center mt-4">
            <li class="nav-item mt-3 py-2 py-sm-0">
                <a href="{{route('admin.index')}}" class="nav-link text-white">
                    <i class="fs-5 fa-solid fa-house me-2"></i><span class="fs-5 d-none d-lg-inline list-de-task-admin">Accueil</span>
                </a>
            </li>
            <li class="nav-item w-100 py-2 py-sm-0">
                <a href="{{route('users.index')}}" class="nav-link text-white">
                    <i class="fa-solid fa-users fs-5 me-2"></i><span class="fs-5 d-none d-lg-inline list-de-task-admin">Clients</span><span id="clients-li" class="badge bg-danger rounded-pill ms-2" style="font-size:12px ;"></span>
                </a>
            </li>
            <li class="nav-item py-2 py-sm-0">
                <a href="{{route('produits.index')}}" class="nav-link text-white">
                    <i class="fs-5 fa-solid fa-shop me-2"></i><span class="fs-5 d-none d-lg-inline list-de-task-admin">Produits</span>
                </a>
            </li>
            <li class="nav-item py-2 py-sm-0">
                <a href="{{route('categories.index')}}" class="nav-link text-white">
                    <i class="fs-5 fa-solid fa-list me-2"></i><span class="fs-5  d-none d-lg-inline list-de-task-admin">Categories</span>
                </a>
            </li>
            <li class="nav-item py-2 py-sm-0">
                <a href="{{route('commandes.index')}}" class="nav-link text-white" >
                    <i class="fa-solid fa-clipboard fs-5 me-2"></i><span class="fs-5 d-none d-lg-inline list-de-task-admin">Commandes</span><span id="commandes-li" class="badge bg-danger rounded-pill ms-2" style="font-size:12px ;"></span>
                </a>
            </li>
        </ul>
        <ul class="nav nav-pills flex-column position-absolute bottom-0 mb-3">
            <li class="nav-item py-2 py-sm-0">
                <a href="" class="nav-link text-white">
                    <i class="fa-solid fa-user-tie fs-5 me-2"></i><span class="fs-5 d-none d-lg-inline list-de-task-admin" title="admin@gmail.com">Admin</span>
                </a>
            </li>
            <li class="nav-item py-2 py-sm-0">
                <a href="{{route('connecte.logout')}}" class="nav-link text-white">
                    <i class="fa-solid fa-right-from-bracket fs-5 me-2"></i><span class="fs-5 d-none d-lg-inline list-de-task-admin">Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="col-12 col-lg-4" data-auth-id="{{ Auth::id() }}" id="newClientsDiv"></div>
</div>
