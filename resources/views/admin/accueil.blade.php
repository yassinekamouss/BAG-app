@extends('layout.admin')

@section('title')
    Acceuil
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/admin/accueil.css')}}">
@endsection

@section('content')

<div class="col">
    
    {{-- header  --}}
    <div class="row">
        <div class="col">
            <div class="teste px-4 py-5 mt-5 rounded-4 shadow d-flex justify-content-between align-items-center card-info carts-accueil">
                <div class="d-flex flex-column">
                    <span class="fs-2 fw-bold">{{count($users)}}</span>
                    <span class="fs-5">Clients</span>
                </div>
                <i class="fs-2 fa-solid fa-users"></i>
            </div>
        </div>
        <div class="col">
            <div class="teste px-4 py-5 mt-5 rounded-4 shadow d-flex justify-content-between align-items-center card-info  carts-accueil">
                <div class="d-flex flex-column">
                    <span class="fs-2 fw-bold">{{count($commandes)}}</span>
                    <span class="fs-5">Commade</span>
                </div>
                <i class="fs-2 fa-solid fa-cart-shopping"></i>
            </div>
        </div>
        <div class="col">
            <div class="teste px-4 py-5 mt-5 rounded-4 shadow d-flex justify-content-between align-items-center card-info  carts-accueil">
                <div class="d-flex flex-column">
                    <span class="fs-2 fw-bold">{{$produits}}</span>
                    <span class="fs-5">Produit</span>
                </div>
                <i class="fs-2 fa-solid fa-shop"></i>
            </div>
        </div>
        <div class="col">
            <div class="teste px-4 py-5 mt-5 rounded-4 shadow d-flex justify-content-between align-items-center card-info  carts-accueil">
                <div class="d-flex flex-column">
                    <span class="fs-2 fw-bold fs-2">{{$categories}}</span>
                    <span class="fs-5">Categorie</span>
                </div>
                <i class="fs-2 fa-solid fa-list"></i>
            </div>
        </div>
    </div>

    {{-- charts --}}
    <div class="row mt-5 px-4">
        <div class="col-12 col-lg-6 rounded-4 p-4">
            <canvas id="lineChart"></canvas>
        </div>
        <div class="col-12 col-lg-6 rounded-4 p-4 shadow">
            <canvas id="barChart" data-commandes-en-ligne="{{ json_encode($commandesEnLigneParJour) }}" data-commandes-a-la-livraison="{{ json_encode($commandesALaLivraisonParJour) }}"></canvas>
        </div>
    </div>

    {{-- Les nouvelles commandes et clients --}}
    <div class="row mt-5 gx-5 px-3">
        {{--Derniers commandes --}}
        <div class="col-12 col-lg-8 mb-lg-0 mb-5">
            <div class="rounded-4 p-4 shadow carts-accueil">
                <div class="d-flex justify-content-between">
                    <h3 class="">Dernières commandes</h3>
                    <a href="{{route('commandes.index')}}" class="btn btn-warning rounded-pill">Voir tous</a>
                </div>
                {{-- la tables des nouvelles commandes  --}}
                <div class="mt-5">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Client</th>
                            <th scope="col">Date de commande</th>
                            <th scope="col">Status</th>
                            <th scope="col">Détails</th>
                        </tr>
                        </thead>
                        <tbody id="tableau-commandes">
                            @foreach ($commandes->take(5) as $commande)
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <span class="">{!! $commande->client->prenom . ' ' . $commande->client->nom !!}</span>
                                    </td>
                                    <td>{{$commande->created_at}}</td>
                                    <td class="">
                                       {{$commande->etat}}
                                    </td>
                                    <td>
                                        <a href="{{route('commandes.edit' , $commande->id)}}" class="text-secondary text-decoration-none"><i class="fa-solid me-2 fa-pen"></i>Voir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
        {{--Derniers clients --}}
        <div class="col-12 col-lg-4">
            <div class=" rounded-4 p-4 shadow carts-accueil">
                <div class="d-flex justify-content-between">
                    <h3 class="">Nouveaux clients</h3>
                    <a href="{{route('users.index')}}" class="btn btn-warning rounded-pill">Voir tous</a>
                </div>
                {{-- liste des nouvelles clients  --}}
                <div class="mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Profile</th>
                                <th scope="col" colspan="2">Créer en</th>
                            </tr>
                        </thead>
                        <tbody id="tableau-clients">
                            @foreach ($users->take(5) as $user)
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <i class="fs-2 fa-solid fa-circle-user text-secondary me-2"></i>
                                        <span>{!!$user->prenom . ' ' . $user->nom!!}</span>
                                    </td>
                                    <td>
                                        <span>{{$user->created_at->format('Y-m-d')}}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection


@section('js')
    <script src="{{asset('js/admin/acceuil.js')}}"></script>
@endsection