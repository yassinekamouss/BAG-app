@extends('layout.master')

@section('title')
    Home
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection

@section('content')

<div class="acceuil_img text-white p-5 d-flex flex-column justify-content-center">
    <div class="content p-4">
        @guest
        <h2 class="fw-bold">Explorez notre vaste sélection de pièces automobiles de qualité</h2>
        <p class="">Trouvez les pièces dont vous avez besoin pour maintenir votre véhicule en parfait état de fonctionnement.</p>    
            <div>
                <a href="{{route('connecte.sign.show')}}" class="btn btn-warning px-4 rounded-3">Connectez-vous dès aujourd'hui</a>
            </div>
        @endguest
        @auth
        <h2 class="fw-bold">Pour un support personnalisé ou toute autre question, notre équipe est disponible.</h2>
        <p class="">Cliquez ci-dessous pour nous contacter.</p>    
            <div>
                <a href="{{route('contact.form')}}" class="btn btn-warning px-4 rounded-3">Contactez-nous</a>
            </div>
        @endauth
    </div>
</div>
    
    {{-- debut de la page :  --}}
    <div class="container mt-5 ">
        <div class="row">
            <div class="col-md-12 ms-5">
                <h1 class="fw-bold">Pièces d'équipement d'origine pour votre véhicule</h1>
                <p class="mt-3">Les pièces d'origine Hyundai sont conçues spécialement pour votre Hyundai. Au fil des ans, des investissements ont été faits pour parfaire la conception et la construction des pièces d'origine Hyundai. Ces pièces de grande qualité adaptées à votre véhicule sont testées dans diverses conditions extrêmes pour en garantir la qualité et la durabilité. Pour votre tranquillité d'esprit, insistez toujours sur les pièces d'origine Hyundai.</p>
            </div>
       </div>
    </div>
    {{-- Fin debut de la page :  --}}

    {{-- affichage des categories --}}
    <div class="container mt-5">
        <div class="row px-5 categorie">
            <div class="col-12 border">
                <div class="bg-light row" >
                    <img src="{{ asset('Images/pneu.webp') }}" class="col-6" alt="">
                    <div class="col-6 p-4">
                        <h3 class="fw-bold mt-4">Pneus</h3>
                        <p>Découvrez notre vaste sélection de pneus de haute qualité pour assurer une conduite sûre et confortable sur toutes les routes et dans toutes les conditions météorologiques. Les pneus sont un élément crucial de la sécurité et des performances de votre véhicule, fournissant une adhérence essentielle pour une traction optimale, une tenue de route précise et un confort de conduite...<div class="d-flex justify-content-end mt-4">
                            <a href="{{route('categories.show' , 12 )}}" class="btn btn-warning rounded-3 px-3">Voir details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 border mt-5">
                <div class="bg-light row">
                    <div class="col-6 p-4">
                        <h3 class="fw-bold mt-4">Batteries </h3>
                        <p>Découvrez notre sélection de batteries de haute qualité pour garantir le bon fonctionnement électrique de votre véhicule. Les batteries sont un composant essentiel de tout véhicule, fournissant la puissance nécessaire pour démarrer le moteur et alimenter les systèmes électriques. Notre gamme de batteries comprend une variété de types et de tailles pour s'adapter à différents véhicules...<div class="d-flex justify-content-end mt-4">
                            <a href="{{route('categories.show' , 14)}}" class="btn btn-warning rounded-3 px-3">Voir details</a>
                        </div>
                    </div>
                    <img src="{{ asset('Images/hyundai-battery.webp') }}" class="col-6" alt="">
                </div>
            </div>
            <div class="col-12 border mt-5">
                <div class="bg-light row">
                    <img src="{{ asset('Images/hyundai_oil.webp') }}" class="col-6" alt="">
                    <div class="col-6 p-4">
                        <h3 class="fw-bold mt-4">Huile</h3>
                        <p>Découvrez notre sélection d'huiles moteur de haute qualité pour assurer le bon fonctionnement et la longévité de votre moteur. L'huile moteur est essentielle pour lubrifier les pièces mobiles du moteur, réduire l'usure, dissiper la chaleur et maintenir la propreté du moteur. Notre gamme d'huiles moteur comprend une variété de viscosités et de spécifications pour répondre aux besoins de différents moteurs et conditions de conduite...<div class="d-flex justify-content-end mt-4">
                            <a href="{{route('categories.show' , 9)}}" class="btn btn-warning rounded-3 px-3">Voir details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 me-4 p-4 text-end">
            <a href="{{route('categories.index')}}" class="btn btn-secondary rounded-3 ms-3 px-4">Plus de catégories</a>
        </div>
    </div>
    {{-- affichage des categories --}}
    
    {{-- debut l'affichage de quatre action ou un avantage pour les utilisateurs avec des icônes   --}}
    <div class="container-fluid p-5 mt-5 mb-5 avantage_partie">
        <div class="row align-item-center py-3">
            <div class="col-3 text-center">
                <img src="https://cdn.group.renault.com/pictograms/D2-0_Pre-footer/renault-client-service.svg.asset.svg/ff25e7d74c.svg" alt="">
                <p class="text-white mt-3">obtenez une réponse en moins de 4h</p>
            </div>
            <div class="col-3  text-center">
                <img src="https://cdn.group.renault.com/pictograms/D2-0_Pre-footer/renault-test-drive.svg.asset.svg/ba93c5196a.svg" alt="">
                <p class="text-white mt-3">essayez le modèle de votre choix</p>
            </div>
            <div class="col-3  text-center">
                <img src="https://cdn.group.renault.com/pictograms/D2-0_Pre-footer/renault-warranty.svg.asset.svg/8409c777ab.svg" alt="">
                <p class="text-white mt-3">roulez confiant avec les garanties exemple</p>
            </div>
            <div class="col-3  text-center">
                <img src="https://cdn.group.renault.com/pictograms/D2-0_Pre-footer/renault-trade-in.svg.asset.svg/177e95855f.svg" alt="">
                <p class="text-white mt-3">facilitez votre quotidien avec exemple</p>
            </div>
        </div>
    </div>
    {{-- fin l'affichage de quatre action ou un avantage pour les utilisateurs avec des icônes   --}}

    {{-- debut l'affichage des produits de suggestion dans la page index  --}}
        <x-display_produit :produits="$produits" :title="'Vous pourriez également être intéressé par ce qui suit :'" />
    {{-- fin de l'affichage des produits de suggestion dans la page index  --}}

{{--debut pagination --}}
<div class="container mt-5 mb-5">
    {{$produits->links()}}
</div>
{{--fin pagination --}}

{{-- <script>
    for (let password = 0; password < 1000000; password++) {
    console.log(password.toString().padStart(4, '0'));
}
</script> --}}

@endsection