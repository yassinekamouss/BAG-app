@extends('layout.admin')

@section('title')
    Categorie Edite
@endsection

@section('content')
    
    <div class="col">
        <div class="container" style="max-width: 800px ;">
            <h1 class="mt-5 text-decoration-underline text-center">Modifier la cotegorie {{$categorie->id}}.</h1>
        {{-- form pour l'ajout de produits --}}
            <form action="{{route('categories.update' , $categorie->id)}}" method="POST" class="row gy-3 mt-4 form px-5" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="name" id="title" value="{{$categorie->name}}">
                </div>
                <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="5">{{$categorie->description}}</textarea>
                </div>
                <div class="col-12">
                    <label for="image" class="form-label">Image</label>
                    <div class="mt-3 mb-3">
                        <img src="{{ asset('storage/'.$categorie->image) }}" alt="" style="width: 100px ; height : 60px ; object-fit: cover ;">
                    </div>
                    <input class="form-control" id="image" type="file" name="image">
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