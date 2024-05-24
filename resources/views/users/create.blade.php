{{-- @extends('layout.admin')

@section('title')
    Create User
@endsection

@section('content')
    

    <div class="col">
        <div class="container mt-5" style="max-width: 800px ;">
            <h1 class="text-center text-decoration-underline">Créez un nouveau utilisateur.</h1>
            <form action="{{route('users.store')}}" method="POST" class="row gy-3 mt-4 px-5">
                @csrf
                <div class="col-12 mb-3">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control">
                </div>
                <div class="col-12 mb-3">
                    <label for="prenom">Prenom</label>
                    <input type="text" id="prenom" name="prenom" class="form-control">
                </div>
                <div class="col-12 mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>
                <div class="col-12 mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <div class="col-12 mb-3">
                    <label for="ville">Ville</label>
                    <input type="text" id="ville" name="ville" class="form-control">
                </div>
                <div class="col-12 mb-3">
                    <label for="tel">N° Tel</label>
                    <input type="number" id="tel" name="n_tel" class="form-control">
                </div>
                <div class="col-12 mb-3">
                    <button class="btn btn-primary form-control rounded-3" type="submit">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
        

@endsection --}}