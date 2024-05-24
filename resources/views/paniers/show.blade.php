@extends('layout.master')

@section('title')
    Pnier de {{Auth::user()->nom}}
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/panier.css')}}">
@endsection

@section('content')
    <div class="container mt-5 mb-4 p-4 ">
        @if (count($details_panier)  < 1)
            <div class="container">
                <div class="p-5 d-flex justify-content-center align-items-center">
                    <img src=" {{ asset('Images/panier.jpg') }}" alt="" id="panier_img">
                    <div class="text-center">
                        <h4 class="fs-4">Vous ne trouvez pas d'articles ? Continuez votre shopping pour en découvrir plus<h4> 
                        <button class="btn btn-warning rounded-4 mt-4">Parcourir les articles</button>
                    </div>
                    
                </div>
            </div>
        @else
        <div class="row gx-3">
            <div class="col-md-8 p-4 shadow-sm">
                <div>
                    <div class="d-flex justify-content-between">
                        <h3><i class="fs-7 fa-solid fa-cart-shopping"></i>  Panier</h3>
                        <span class="fs-5">Prix</span>
                    </div>
                    
                    <hr class="mt-4 mb-4">
                    {{-- Produit details --}}
                    @php
                        $prixTotal = 0 ;
                        $nbrProduits = 0 ;
                    @endphp
                    @foreach ($details_panier as $details)
                        <div class="row mt-3">
                            <div class="col">
                                <a href="{{route('produits.show' , $details->produit->id)}}">
                                    <img src="{{asset('storage/'.$details->produit->image)}}" alt=""  class="mb-3 produit_panier_img">
                                </a>
                            </div>
                            <div class="col">
                                <div class="d-flex justify-content-between">
                                    <h4 class="fs-5">{{$details->produit->title}}</h4>
                                    <span class="text-decoration-underline"><strong>{{$details->produit->prix}}Dh</strong></span>
                                    @php
                                        $prixTotal += $details->quantite * $details->produit->prix ;
                                        $nbrProduits += $details->quantite ;
                                    @endphp
                                </div>
                                    @if ($details->produit->quantite > 0)
                                        <p class="text-success fs-6">En Stock</p>
                                    @else
                                        <p class="text-danger">Pas dans le Stock</p>
                                    @endif   
                                    <div class="d-flex justify-conent-between align-items-center">
                                        <form method="POST" action="{{ route('paniers.update',$details->id) }}" class="quantite_component">
                                            @csrf
                                            @method('PUT')
                                            <label class="" for="quantite">Quantite:</label>
                                            <input class="form-control-sm rounded ms-2 quantite_input" id="quantite" name="quantite" type="number" value="{{$details->quantite}}" min="1" max="99">
                                            <button type="submit" class="text-decoration-none text-black bg-success rounded-3 p-1 mt-3 d-none" id="update_btn">Changer</button>

                                        </form>
                                        <form action="{{route('paniers.destroy', $details->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="rounded-4 text-decoration-none border-0 bg-transparent text-danger fs-8 ms-4" type="submit"><i class="fs-7 fa-solid fa-trash"></i>Delete</button>
                                        </form>              
                                    </div>
                            </div>
                            
                            <hr class="mt-4 mb-4">
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-end p-4">
                        <span>Total</span> ({{$nbrProduits}} produits) : <strong class="ms-3">{{$prixTotal}}.00DH</strong>
                    </div>
                    {{-- Fin Produit details --}}
                </div>   
            </div>
            <div class="col">
                <div class="shadow-sm ms-4 p-4 text-center">
                    <span class="fs-5">Le Totale ({{$nbrProduits}} produits) : </span><strong class="ms-3">{{$prixTotal}}.00DH</strong>
                    <form action="{{route('paiement.checkout')}}" method="GET">
                        @csrf
                        <input type="hidden" name="panier" value="{{auth()->user()->panier}}">
                        <input type="hidden" name="panierDetails" value="{{$details_panier}}">
                        <input type="hidden" name="prix" value="{{$prixTotal}}">
                        <input type="hidden" name="detailsPanier " value="{{count($details_panier)}}">
                        <button class="btn btn-warning border-0 rounded-3 mt-3 w-100" type="submit">Passer à la caisse</button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- Affichage des produits de suggestion :  --}}
        <x-display_produit :produits="$produits" :title="'Vous pourriez également être intéressé par ce qui suit :'" />
        <div class="container mt-5 mb-5">
            {{$produits->links()}}
        </div>
    {{-- fin Affichage des produits de suggestion :  --}}
@endsection

@section('js')
    {{ asset('js/panier.js') }}
@endsection