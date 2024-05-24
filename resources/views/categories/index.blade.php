@extends('layout.master')

@section('title')
    Categories
@endsection

@section('style')
<link rel="stylesheet" href="{{asset('css/categories/index.css')}}">
@endsection

@section('content')


    {{-- afficher les categories : --}}
    <div class="container-fluid mt-5" style="position: sticky ; top : -25px ;">
        <div class="">
            <fieldset>
                <div class="text-center">
                    <legend>
                        <h3 class="fw-bold fs-4 d-inline">Notre Sélection de catégories</h3>
                        <p class="fs-6">Explorer les catégories qui vous intéressent ??</p>
                    </legend>
                </div>
                <ul class="d-flex bg-light p-4  justify-content-between mt-5 categorie-bar">
                    @foreach ($categories as $categorie)
                        <li class="nav-item d-inline nav-link">
                            <a href="#{{$categorie->id}}" class="nav-link fw-bold text-secondary">
                                {{$categorie->name}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </fieldset>
        </div>
    </div>

    {{-- afficher les categories :  --}}
    <div class="container mt-5">
        <div class="row px-5 categorie">
            @foreach ($categories as $categorie)
                <div class="col-12 border mt-5">
                    @if ($categorie->id % 2 == 0)
                        <div class="bg-light row" id="{{$categorie->id}}">
                            <img src="{{ asset('storage/'.$categorie->image) }}" class="col-6" alt="" style="height: 300px ; object-fit : cover ;">
                            <div class="col-6 p-4">
                                <h3 class="fw-bold mt-4">{{$categorie->name}}</h3>
                                <p>{{Str::limit($categorie->description , 300).'...'}}</p>
                                <div class="d-flex justify-content-end mt-4">
                                    <a href="{{route('categories.show' , $categorie->id )}}" class="btn btn-warning rounded-3 px-3">Voir details</a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-light row" id="{{$categorie->id}}">
                            <div class="col-6 p-4">
                                <h3 class="fw-bold mt-4">{{$categorie->name}}</h3>
                                <p>{{Str::limit($categorie->description , 300).'...'}}</p>
                                <div class="d-flex justify-content-end mt-4">
                                    <a href="{{route('categories.show' ,  $categorie->id )}}" class="btn btn-warning rounded-3 px-3">Voir details</a>
                                </div>
                            </div>
                            <img src="{{ asset('storage/'.$categorie->image) }}" class="col-6" alt="" style="height: 300px ; object-fit : cover ;">
                        </div>
                    @endif
                    
                </div> 
            @endforeach
           
        </div>
    </div>
    {{-- afficher les categories :  --}}
    


    {{-- Affichage des produits les plus vendus --}}
        <x-display_produit :produits="$produits" :title="'Vous pourriez également être intéressé par ce qui suit :'" />
        <div class="container mt-5 mb-5">
            {{$produits->links()}}
        </div>
    {{-- fin d'Affichage des produits les plus vendus --}}

    <div style="height: 100px ;"></div>
@endsection 

{{-- L'envoi de fichier de script JS --}}
@section('js')
    {{asset('js/categorie_swiper.js')}}
@endsection