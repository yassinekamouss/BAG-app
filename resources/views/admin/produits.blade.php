@extends('layout.admin')

@section('title')
    Admin-Produits
@endsection

@section('content')
    
    <div class="col">
        <div class="mt-5 px-5">
            <div class="card border-0 shadow">
                <h4 class="card-header bg-secondary text-white">Liste des Produits</h4>
                <div class="card-body p-4 borde">
                    <div class="input-group input-group-lg mb-3">
                        <input type="search" id="searchInput" class="form-control" placeholder="Search Product by Title" aria-label="Search" aria-describedby="button-addon2">
                        <button class="btn btn-secondary" id="button-addon2" type="button" ><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    <div class="text-end">
                        <a href="{{route('produits.create')}}" class="btn btn-success px-4 align-items-center justify-content-around shadow ajouter">
                            <i class="fs-5 fa-solid fa-plus me-3"></i>
                            <span>Ajouter</span>
                        </a>
                    </div>
                    <x-alert />
                    <table class="table table-hover text-center rounded-4 p-5  mt-5">
                        <thead>
                            <tr class="">
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Image</th>
                                <th scope="col">Description</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Quantite</th>
                                <th scope="col">Categorie</th>
                                <th scope="col">Créé en</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="produits_table">
                            @foreach ($produits as $produit)
                                <tr>
                                    <th>{{$produit->id}}</th>
                                    <td>{{Str::limit($produit->title, 20).'...' }}</td>
                                    <td><img src="{{ asset('storage/'.$produit->image) }}" alt="" style="width: 100px ;height : 60px ;object-fit : fill "></td>
                                    <td>{{Str::limit($produit->description, 20).'...' }}</td>
                                    <td>{{$produit->prix}}Dh</td>
                                    <td>{{$produit->quantite}}</td>
                                    <td>{{$produit->categorie->name}}</td>
                                    <td>{{$produit->created_at}}</td>
                                    <td style="cursor: pointer ;">
                                        <form action="{{route('produits.destroy' , $produit->id)}}" method="POST" class="delete-form" onsubmit="confirmDelete(this); return false;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="border-0 bg-transparent" type="submit"><i class="fs-5 text-danger fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                    <td style="cursor: pointer ;">
                                        <a href="{{route('produits.edit' , $produit->id)}}">
                                            <i class="fs-5 text-success fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($produits->total() > $produits->perPage())
                        <div id="paginationLinks">
                            {{ $produits->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>   
    </div>    

@endsection

@section('js')
    <script src="{{ asset('js/admin/search_produits.js') }}"></script>
@endsection