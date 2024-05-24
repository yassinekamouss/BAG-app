@extends('layout.admin')

@section('title')
    Edit Produit
@endsection

@section('content')

    <div class="col">
        <div class="container" style="max-width: 800px ;">
            <h1 class="mt-5 text-decoration-underline text-center">Modifier le produit {{$produit->id}}.</h1>
        {{-- form pour l'ajout de produits --}}
            <form action="{{route('produits.update' , $produit->id)}}" method="POST" class="row gy-3 mt-4 form px-5" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{$produit->title}}">
                </div>
                <div class="col-12">
                    <label for="prix" class="form-label">Prix</label>
                    <input type="text" class="form-control" id="prix" name="prix" value="{{$produit->prix}}">
                </div>
                <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="5">{{$produit->description}}</textarea>
                </div>
                <div class="col-12">
                    <label for="quantite" class="form-label">Quantite</label>
                    <input type="number" class="form-control" min="1" id="quantite" name="quantite" value="{{$produit->quantite}}">
                </div>
                <div class="col-12">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" id="image" type="file" name="image">
                </div>
                <div class="col-12">
                    <label for="categorie" class="form-label">Categorie</label>
                    <select class="form-select" id="categorie" name="categorie_id" aria-label=".form-select-sm example">
                        @foreach ($categories as $categorie)
                            @if ($categorie->id === $produit->categorie_id)
                                <option value="{{ $categorie->id }}" selected>{{ $categorie->name }}</option>
                            @else
                                <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label for="cars_id" class="form-label">Models</label>
                    <select class="form-control selectpicker" multiple id="cars_id" name="cars_id[]">
                        @foreach ($carModels as $carModel)
                            <option value="{{ $carModel->id }}" {{ $produit->carModels->contains($carModel) ? 'selected' : '' }}>
                                {{ $carModel->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary rounded-3 form-control mt-4" type="submit">
                        Update
                    </button>
                </div>
            </form>
        {{-- fin form pour l'ajout de produits --}}
        </div>
    </div>

@endsection