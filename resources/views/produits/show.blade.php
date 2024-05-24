@extends('layout.master')

@section('title')
    {{-- Produit {{$produit->id}} --}}
    produit
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/produits/show.css') }}">
@endsection

@section('content')
    

    {{-- Debut Partie d'affichage d'info de produit choisie --}}
    <div class="container overflow-hidden mt-5">
        <div class="row gx-5">
            {{-- partie d'image --}}
          <div class="col-12 col-lg-6">
            <div class="p-3">
                <img class="img-fluid" src="{{asset('storage/'.$produit->image)}}" alt="" style="width: 100% ; height : 100% ; object-fit : cover ;">
            </div>
          </div>
          {{-- details produits --}}
          <div class="col-12 col-lg-6">
            <div class="p-4">
                {{-- <h2 class="">Multigroomer All-in-One Trimmer Series 5000, 23 Piece Mens Grooming Kit</h2> --}}
                <h2>{{$produit->title}}</h2>
                <span id="del-price" class="fw-bold"><del>{{$produit->prix + 200}}</del></span>  
                <span id="price" class="fw-bold">{{$produit->prix}}dh</span>
                {{-- les caracteristique d'un produits --}}
                <div>
                    Principales caractéristiques
                    <ul>
                        <li>Garantie de satisfaction</li>
                        <li>Composants de première qualité</li>
                        <li>Performance supérieure</li>
                        <li>Prix compétitif</li>
                    </ul>
                    Models de voiture supporter 
                    <ul>
                        <li>Hyundai I10</li>
                        <li>Hyundai Kona</li>
                        <li>Hyundai Santa Fe</li>
                        <li>Hyundai Tucson</li>
                        <li>Hyundai Nexo</li>
                    </ul>
                </div>
                {{-- ajouter au panier --}}
                <div class="mt-5 ">
                    <form action="" method="POST" class="acheter-ajouter-form">
                        @csrf
                        <label class="" for="quantite">Quantite:</label>
                        <input type="hidden" name="id" value="{{$produit->id}}">
                        <input type="hidden" name="prix" value="{{$produit->prix}}">
                        <input class="p-2 rounded ms-2" id="quantite" name="quantite" type="number" value="1" min="1" max="99" autofocus>
                        @if ($produit->quantite < 2)
                        <div class="alert alert-warning mt-3" role="alert">
                            !!Ce produit est actuellement indisponible. Vous pouvez le commander en tant que commande fermée.
                        </div>
                        <button class="btn btn-danger form-control mt-3 mb-3 btn-acheter-ajouter" type="submit" name="action" value="acheter_maintenant">Commander maintenant</button>
                        @else
                            <button class="btn form-control mt-4 btn-danger btn-acheter-ajouter" type="submit" name="action" value="ajouter_panier">Ajouter au panier</button>
                            <button class="btn btn-warning form-control mt-3 mb-3 btn-acheter-ajouter" type="submit" name="action" value="acheter_maintenant">Acheter maintenant</button>
                        @endif
                    </form>
                </div>
                <div>
                    <hr>
                    Categorie : <span class="text-blue">{{$produit->categorie->name}}</span>
                </div>
            </div>
          </div>
        </div>
      </div>
      {{-- debut affichage de la description de produite  --}}
      <div class="container">
        <h2 class="mt-5 fw-bold">Plus d'info sur le produit</h2>
        <p class="fs-6" id="produit-description">{{$produit->description}}</p>
      </div>
      {{-- fin affichage de la description de produite  --}}
    {{-- Fin Partie d'affichage d'info de produit choisie --}}

    {{-- debut de partie d'affichage de produits similaires --}}
        <x-display_produit :produits="$produits" :title="'Découvrez d\'autres produits similaires'"/>
    {{-- fin partie d'affichage de produits similaires --}}
@endsection

@section('js')
    {{ asset('js/produit.js') }}
@endsection