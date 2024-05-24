@extends('layout.master')

@section('title')
    Confirmation de commande
@endsection

@section('content')
    <div class="container mt-5 p-3">
        <h1 class="text-secondary text-center p-5 fw-bold" style="font-size: 70px;">Checkout</h1>
        <hr style="border: 2px solid #000 ;">
        <div>
            <p><span class="fw-bold">Merci.</span>Votre commande a été bien reçue</p>
            <div class="d-flex justify-content-between">
                <div>
                    <p>Numéro de commande:</p>
                    <p class="fw-bold">449</p>
                </div>
                <div>
                    <p>Date :</p>
                    <p class="fw-bold">{{ date('Y-m-d') }}</p>
                </div>
                <div>
                    <p>Email :</p>
                    <p class="fw-bold">{{session()->get('email')}}</p>
                </div>
                <div>
                    <p>Total :</p>
                    <p class="fw-bold">{{session()->get('total')}}DH</p>
                </div>
                <div>
                    <p>Méthode de paiement :</p>
                    <p class="fw-bold">{{session()->get('paiementMethod')}}</p>
                </div>
            </div>
        </div>
        {{-- Card des produits commandés --}}
        <div class="card mt-4">
            <h5 class="card-header">Détails de la commande</h5>
            <div class="card-body p-4">
                <h5 class="card-title d-flex justify-content-between">
                    <span>Produits</span>
                    <span>Prix</span>
                </h5>
                <hr>
                @if(isset($produits))
                    @foreach ($produits as $produit)
                        <div class="d-flex justify-content-between">
                            <span class="fs-6">{{$produit['produit']['title']}}<span class="fw-bold"> * {{$produit['quantite']}}</span></span>
                            <span class="fw-bold">{{$produit['produit']['prix'] * $produit['quantite']}}DH</span>
                        </div>
                    @endforeach
                @else
                    <div class="d-flex justify-content-between">
                        <span class="fs-6">{{$produit->title}}<span class="fw-bold"> * {{session()->get('quantite')}}</span></span>
                        <span class="fw-bold">{{$produit->prix * session()->get('quantite')}}DH</span>
                    </div>
                @endif
                <hr>
                <div class="d-flex justify-content-between mt-2">
                    <span class="fw-bold">Total</span>
                    <span class="fw-bold">{{session()->get('total')}}DH</span>
                </div>
                <p class="card-text"></p>
            </div>
        </div>
        {{-- Card des informations de facturation --}}
        <div class="card mt-4">
            <h5 class="card-header">Détails de la facturation</h5>
            <div class="card-body p-4 d-flex flex-column">
                <span>{{session()->get('nom')}}</span>
                <span>{{session()->get('prenom')}}</span>
                <span>{{session()->get('ville')}}</span>
                <span>{{session()->get('adresse')}}</span>
                <span>Maroc</span>
                <span>{{session()->get('n_tel')}}</span>
                <span>{{session()->get('email')}}</span>
            </div>
        </div>
        <form action="{{route('paiement.traitement')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary mt-5 fs-4">Confirmer la commande</button>
        </form>
    </div>

    <div style="margin-top: 100px;"></div>
@endsection
