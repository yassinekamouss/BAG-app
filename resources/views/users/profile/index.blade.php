@extends('layout.master')

@section('title')
    Profile page
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
@endsection

@section('content')

<div class="container p-5 mt-5">
    <div class="row p-3" style="background-color: #fff ;">
            
            {{-- Inclure le component de profile bare --}}
            <x-profileBare />
            {{-- fin d'Inclure le component de profile bare --}}

        <div class="col-12 col-lg-8 mt-5 mt-md-0">
            {{-- partie accueil profil --}}
            <x-alert />
            <div class="p-4" id="acceuil_text">
                <h1>Bienvenue sur votre profil, Yassine !</h1>
                <p>Sur cette page, vous pouvez consulter et mettre à jour vos informations personnelles.</p>
                <p>N'hésitez pas à parcourir les différentes sections pour modifier vos paramètres, consulter vos commandes ou effectuer d'autres actions liées à votre compte.</p>
                <p>Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter. Nous sommes là pour vous aider !</p>
            </div>

            {{-- partie commandes realiser par l'utilisateur --}}
            <div class="p-4 d-none" id="commande_container">
                <h2>Vos commandes</h2>
                @if(count($commandes) < 1 )
                    <div class="fs-5 text-danger">0!! commandes , vous n'avez pas encore effectué des commandes </div>
                @endif
                @foreach($commandes as $commande)
                    {{-- Calcule du total pour chaque commande --}}
                    @php
                        $total = 0 ;
                    @endphp
                    @foreach ($commande->produits as $produit)
                        @php
                            $total += $produit->prix * $produit->pivot->quantite;
                        @endphp
                    @endforeach
                    <div class="shadow-sm p-4 mt-4" style="background-color: #fff ;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0">Commande</p>
                                <p class="">#{{$commande->id}}</p>
                            </div>
                            <div>
                                <p class="fw-bold mb-0">Date</p>
                                <p class="">{{$commande->created_at}}</p>
                            </div>
                            <div>
                                <p class="fw-bold mb-0">Total</p>
                                <p class="">{{$total}}DH</p>
                            </div>
                            <div>
                                <p class="fw-bold mb-0">Etat</p>
                                <p class="text-danger">{{$commande->etat}}</p>
                            </div>
                        </div>
                        {{-- Affichage de produits: --}}
                        <div class=" d-none" id="{{$commande->id}}">
                            @foreach ($commande->produits as $produit)
                                <div class="d-flex justify-content-between">
                                    <span>{{$produit->title}} <span class="fw-bold text-secondary">*{{$produit->pivot->quantite}}</span></span>
                                    <span>{{$produit->prix}}DH</span>
                                </div>
                            @endforeach
                        </div>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total</span>
                                <span class="fw-bold">{{$total}}Dh</span>
                            </div>
                        <div class="d-flex justify-content-end">
                            <button id="btn" class="btn btn-success rounded-3 mt-3" onclick="showDetails({{$commande->id}})"><i class="fas fa-info-circle me-2"></i>Details</button>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- partie details profile  --}}
            <div class="d-none justify-content-center" id="parametre_container">
                <div class="p-0 p-lg-5" id="parametre_profile_container">
                    <div class="d-flex justify-content-between align-items-center cursor-pointer">
                        <h5 class="fw-bold text-dark">Détails du profile</h5>
                        <span class="text-success" title="Apliquer les modifications"><i class="fa-solid fa-pen-to-square fs-3" id="editIcon"></i></span>
                    </div>
                    <hr>
                    <form class="" id="form" action="{{route('users.update' , auth()->user()->id)}}" method="POST">
                        <div class="row">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6 mb-3">
                                <label for="nom" class="form-label text-secondary">Nom</label>
                                <input required type="text" name="nom" class="form-control-plaintext border-bottom border-1" id="nom" value="{{auth()->user()->nom}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenom" class="form-label text-secondary">Prenom</label>
                                <input required type="text" name="prenom" class="form-control-plaintext border-bottom border-1" id="prenom" value="{{auth()->user()->prenom}}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="ville" class="form-label text-secondary">Ville</label>
                                <input required type="text" name="ville" class="form-control-plaintext border-bottom border-1" id="ville" value="{{auth()->user()->ville}}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="inputAddress" class="form-label text-secondary">Address</label>
                                <input required type="text" name="adresse" class="form-control-plaintext border-bottom border-1" id="inputAddress" value="{{auth()->user()->adresse}}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="postcode" class="form-label text-secondary">Postcode</label>
                                <input required name="" type="text" class="form-control-plaintext border-bottom border-1" id="postcode">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="phone" class="form-label text-secondary">Phone</label>
                                <input required type="text" name="n_tel" class="form-control-plaintext border-bottom border-1" id="phone" value="{{auth()->user()->n_tel}}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="email" class="form-label text-secondary">Email</label>
                                <input required type="text" name="email" class="form-control-plaintext border-bottom border-1" id="email" value="{{auth()->user()->email}}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    <div style="height: 100px ;"></div>
@endsection

@section('js')
    {{asset('js/profile.js')}}
@endsection