@extends('layout.admin')

@section('title')
    Admin-commandes
@endsection


@section('content')

    <div class="col">
        <div class="px-5 mt-5">
            <div class="card border-0 shadow">
                <h4 class="card-header bg-secondary text-light">Liste des Commandes</h4>
                <div class="card-body p-4">
                    <div class="input-group input-group-lg mb-3">
                        <input type="search" id="searchInput" class="form-control" placeholder="Search Commande by Code , by client email" aria-label="Search" aria-describedby="button-addon2">
                        <button class="btn btn-secondary" id="button-addon2" type="button" ><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    <x-alert />
    
                    <table class="table table-hover text-center rounded-4 p-5 mt-5">
                        <thead>
                            <tr class="">
                                <th scope="col">#</th>
                                <th scope="col">Date de creation</th>
                                <th scope="col">Date de livraison </th>
                                <th scope="col">Client</th>
                                {{-- <th scope="col">Produits Commandees</th> --}}
                                <th scope="col">Etat</th>
                                <th scope="col">Total</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="commandes_table" >
                            @foreach ($commandes as $commande)
                                {{--Calcule Total de la commande--}}
                                @php
                                    $total = 0;
                                @endphp
    
                                @foreach ($commande->produits as $produit)
                                    @php
                                        $total += $produit->prix * $produit->pivot->quantite;
                                    @endphp
                                @endforeach
                                <tr class="align-items-center justify-content-center">
                                    <th>{{$commande->id}}</th>
                                    <td>{{$commande->created_at}}</td>
                                    <td>{{$commande->date_de_livraison}}</td>
                                    <td>{{$commande->client->email}}</td>
                                    <td>
                                        @if ($commande->etat === 'En attente de traitement')
                                            <span class="badge bg-danger">En attente</span>
                                        @elseif($commande->etat === 'En cours de traitement')
                                            <span class="badge bg-primary">En cours</span>
                                        @elseif($commande->etat === 'Livrée')
                                            <span class="badge bg-success">Livrée</span>
                                        @elseif($commande->etat === 'Annulée')
                                            <span class="badge bg-secondary">Annulée</span>
                                        @endif
                                    </td>
                                    <td>{{$total}}DH</td>
                                    <td style="cursor: pointer ;">
                                        <form action="{{route('commandes.destroy' , $commande->id)}}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="border-0 bg-transparent" type="submit"><i class="fs-5 text-danger fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                    <td style="cursor: pointer ;">
                                        <a href="{{route('commandes.edit' , $commande->id)}}">
                                            <i class="fs-5 text-success fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Afficher la pagination seulement s'il y a plus d'une page --}}
                    @if ($commandes->total() > $commandes->perPage())
                        <div id="paginationLinks">
                            {{ $commandes->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/admin/search_commandes.js') }}"></script>
@endsection