@extends('layout.master')

@section('title')
    {{$categorie->name}}
@endsection

@section('style')
   <link rel="stylesheet" href="{{ asset('css/categories/show.css') }}">
@endsection

@section('content')
    <div class="container mt-5">
        <h3 class="fw-bold">Categorie : {{$categorie->name}}</h3>
        {{-- <h4 class="mt-4" style="color: #464646;font-family: sans-serif ;">Description</h4> --}}
        <p class="mt-2 mb-5">{{$categorie->description}}</p>
        {{-- Affichage de Produits de cette categorie --}}
            <x-display_produit :produits="$produits" :title="''" />
        {{-- fin d'affichage de Produits de cette categorie --}}
    </div>
@endsection