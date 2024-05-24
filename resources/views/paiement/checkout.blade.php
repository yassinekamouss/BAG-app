@extends('layout.master')

@section('title')
    Checkout
@endsection

@section('content')
<style>
    body{
        background: #fdfdfd ;
    }
</style>
<div class="container mt-5">
    <h1 class="text-secondary text-center p-5 fw-bold" style="font-size: 70px;">Checkout</h1>
    <hr style="border: 2px solid #000 ;">
    <div class="row mt-5">
        <form action="{{route('paiement.confirm')}}" method="POST" class="d-flex">
            @csrf
            <div class="col-8">
                <div class="p-4">
                    <h5 class="fw-bold text-dark">Détails de la facturation</h5><hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input required type="text" name="nom" class="form-control" id="nom" value="{{auth()->user()->nom}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="prenom" class="form-label">Prenom</label>
                            <input required type="text" name="prenom" class="form-control" id="prenom" value="{{auth()->user()->prenom}}">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="ville" class="form-label">Ville</label>
                            <input required type="text" name="ville" class="form-control" id="ville" value="{{auth()->user()->ville}}">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="inputAddress" class="form-label">Address</label>
                            <input required type="text" name="adresse" class="form-control" id="inputAddress" value="{{auth()->user()->adresse}}">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="postcode" class="form-label">Postcode</label>
                            <input required name="postCode" type="text" class="form-control" id="postcode">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input required type="text" name="n_tel" class="form-control" id="phone" value="{{auth()->user()->n_tel}}">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input required type="text" name="email" class="form-control" id="email" value="{{auth()->user()->email}}">
                        </div>
                      </div>
                </div>
            </div>
            <div class="col-4 border border-2">
                <div class="p-4 text-secondary"> 
                    <h5 class="fw-bold text-dark">Votre commande</h5>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="fs-5 text-dark">Produits</span>
                        <span class="fs-5 text-dark">Prix</span>
                    </div>
                    <hr class="mt-3">
                    @if(isset($produits))
                        @foreach ($produits as $produit)
                            <div class="d-flex justify-content-between ">
                                <span class="fs-6">{{$produit['produit']['title']}}<span class="fw-bold"> * {{$produit['quantite']}}</span></span>
                                <span class="fw-bold">{{$produit['produit']['prix'] * $produit['quantite']}}DH</span>                      
                            </div>
                        @endforeach
                    @else
                        <div class="d-flex justify-content-between ">
                            <span class="fs-6">{{$produit->title}}<span class="fw-bold"> * {{session()->get('quantite')}}</span></span>
                            <span class="fw-bold">{{$produit->prix * session()->get('quantite')}}DH</span>     
                            <input type="hidden" name="total" value="{{session()->get('total')}}">                           
                        </div>
                    @endif
                    <div class="d-flex justify-content-between mt-4 text-dark">
                        <span class="fs-5">Total</span>
                        <span class="fw-bold">{{session()->get('total')}}DH</span>
                    </div>
                    <div class="mt-3">
                        <span class="text-dark">Moyen de paiement :</span>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" name="paiementMethod" id="flexRadioDefault1" value="A la livraison" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                À la livraison
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paiementMethod" id="flexRadioDefault2" value="En ligne" @if (!isset($produits) && $produit->quantite < 2) disabled  @endif>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Paiement en ligne
                            </label>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p>
                            Vos données personnelles seront utilisées pour traiter votre commande, soutenir votre expérience sur ce site Web et à d'autres fins décrites dans notre politique de confidentialité.
                        </p>
                    </div>
                    <button type="submit" class="btn btn-primary form-control fs-4 mt-2">Passer la commande</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div style="margin-top: 100px ;"></div>
@endsection
