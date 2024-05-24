@extends('layout.admin')

@section('title')
    Creation de Commandees
@endsection

@section('content')
<!-- Inclure les fichiers CSS et JavaScript de Select2 -->
 <div class="col">
        <div class="container" style="max-width: 800px ;">
            <h3 class="mt-5 text-decoration-underline text-center">Créez une nouvelle commande</h3>
            {{-- form pour l'ajout d'une commande --}}
            <form action="{{route('commandes.store')}}" method="POST" class="row gy-3 mt-4 form px-5">
                @csrf
                <div class="col-12">
                    <label for="date_de_livraison" class="form-label">Date de Creation</label>
                    <input type="date" class="form-control" name="date_de_livraison" id="date_de_livraison">
                </div>
                <div class="col-12">
                    <label for="produit_commande" class="form-label">Produits</label>
                    <input type="search" class="form-control" name="produit" id="search-input">
                    <div id="produits_de_suggestion" class="mx-auto" style="z-index:100 ; width:700px ;"></div>
                </div>
            </form>
            {{-- form pour l'ajout d'une commande --}}
        </div>
    </div>
@endsection