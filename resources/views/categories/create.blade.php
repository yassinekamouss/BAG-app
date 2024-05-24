@extends('layout.admin')

@section('title')
    Creation de Categorie
@endsection

@section('content')
<div class="col">
    <div class="container" style="max-width: 800px ;">
        <h1 class="mt-5 text-decoration-underline text-center">Créez un nouvelle Categorie.</h1>
    {{-- form pour l'ajout de produits --}}
        <form action="{{route('categories.store')}}" method="POST" class="row gy-3 mt-4 form px-5" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
                <label for="title" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="title">
            </div>
            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="description" cols="30" rows="5"></textarea>
            </div>
            <div class="col-12">
                <label for="image" class="form-label">Image</label>
                <input class="form-control" id="image" type="file" name="image">
            </div>
            <div class="col-12">
                <button class="btn btn-primary rounded-3 form-control mt-4" type="submit">
                    Ajouter
                </button>
            </div>
        </form>
    {{-- fin form pour l'ajout de produits --}}
    </div>
</div>
@endsection