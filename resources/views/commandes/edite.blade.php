@extends('layout.admin')

@section('title')
    Commande details
@endsection

@section('content')
    <div class="col">
        <div class="container mt-5">
            {{-- Calcul total de commande --}}
            @php
                $total = 0;
            @endphp

            @foreach ($commande->produits as $produit)
                @php
                    $total += $produit->prix * $produit->pivot->quantite;
                @endphp
            @endforeach
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <h1 class="text-secondary p-3 fw-bold">Détails de la commande</h1>
                    @if (count($commande->produits) === 1)
                        @if ($commande->produits->first()->quantite === 0)
                            <span class="text-danger fw-bold">(Commande fermée)</span>
                        @endif
                    @endif
                </div>
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#change-etat-modal">Changer l'etat de la commande</button>
                    <a href="{{ route('commandes.telecharger-pdf' , [ 'id' => $commande->id] ) }}" target="_blank" class="text-decoration-none">
                        <i class="fa-solid fa-download ms-3 fs-4 text-danger"></i><span class="fs-6 text-dark">Telecharcher</span>
                    </a>
                </div>
            </div>
            <hr style="border: 2px solid #000 ;">

            {{-- Info sur la commande --}}
            <div class="d-flex justify-content-between">
                <div>
                    <p>Numéro de commande:</p>
                    <p class="fw-bold">#{{$commande->id}}</p>
                </div>
                <div>
                    <p>Date de creation :</p>
                    <p class="fw-bold">{{ $commande->created_at}}</p>
                </div>
                <div>
                    <p>Total :</p>
                    <p class="fw-bold">{{$total}}DH</p>
                </div>
                <div>
                    <p>Méthode de paiement :</p>
                    <p class="fw-bold">{{$commande->paiementMethod}}</p>
                </div>
                <div>
                    <p>Etat de commande : </p>
                    <p class="fw-bold">{{$commande->etat}}</p>
                </div>
            </div>
        
            {{-- Card des produits commandés --}}
            <div class="card mt-5">
                <h5 class="card-header">produits commandés</h5>
                <div class="card-body p-4">
                    <h5 class="card-title d-flex justify-content-between">
                        <span>Produits</span>
                        <span>Prix</span>
                    </h5>
                    <hr>
                    @foreach ($commande->produits as $produit)
                        <div class="d-flex justify-content-between">
                            <span class="fs-6">
                                {{$produit->title}}
                                <span class="fw-bold">
                                     * {{$produit->pivot->quantite}}
                                    @if ($produit->quantite < 2)
                                        <span class="text-danger">( en rupture de stock "Commande fermée" )</span>
                                    @endif
                                </span>
                            </span>
                            <span class="fw-bold">{{$produit->prix * $produit->pivot->quantite}}DH</span>
                        </div>
                    @endforeach
                    
                    <div class="d-flex justify-content-between mt-3">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold">{{$total}}DH</span>
                    </div>
                    <p class="card-text"></p>
                </div>
            </div>

            {{-- Card des informations de facturation --}}
            <div class="card mt-5">
                <h5 class="card-header">Détails de la facturation</h5>
                <div class="card-body p-4 d-flex flex-column">
                    <span>{{$commande->client->nom}}</span>
                    <span>{{$commande->client->prenom}}</span>
                    <span>{{$commande->client->email}}</span>
                    <span>{{$commande->client->ville}}</span>
                    <span>{{$commande->client->adresse}}</span>
                    <span>Maroc</span>
                    <span>{{$commande->client->n_tel}}</span>
                </div>
            </div>

  
            <!-- Modifier l'etat d'une commande -->
            <div class="modal fade" id="change-etat-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier le statut de la commande {{$commande->id}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('commandes.update' , $commande->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <label for="etat" class="form-label">État de la commande :</label>
                            <select class="form-select" id="etat" name="etat">
                                <option value="En attente de traitement" selected>En attente de traitement</option>
                                <option value="En cours de traitement">En cours de traitement</option>
                                <option value="Annulée">Commande Annulée </option>
                                <option value="Livrée">Commande Livrée</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
                    </form>
                    
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    

    

@endsection