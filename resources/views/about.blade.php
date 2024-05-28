@extends('layout.master')

@section('title')
    About page
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endsection

@section('content')

<div class="acceuil_img d-flex align-items-center" style="height: 350px ;">
    <div class="container content p-4 text-white">
        <h1 class="fw-bold"> 
            À propos
        </h1>
        <p class="fs-5">Bienvenue sur notre plateforme de vente de pièces automobiles ! ,Nous sommes passionnés par l'automobile et nous nous engageons à fournir à nos clients une expérience de shopping exceptionnelle pour leurs besoins en pièces automobiles.</p>    
    </div>
</div>

<div class="container p-4" style="margin-top : 100px ;">
    <h2 class="fw-bold">
        Notre Histoire
    </h2>
    <p class="fs-5">
        Fondée en [année de fondation], [Nom de l'entreprise] est née de la volonté de faciliter l'accès à des pièces de qualité pour les amateurs d'automobiles. Depuis nos débuts modestes, nous avons connu une croissance constante grâce à notre engagement envers la qualité, le service client et l'innovation.
    </p>

    <h2 class="fw-bold mt-5">
        Notre Mission
    </h2>
    <p class="fs-5">
        Notre mission chez [Nom de l'entreprise] est de devenir le partenaire de confiance de nos clients pour leurs besoins en pièces automobiles. Nous nous efforçons de fournir une sélection complète de pièces de qualité supérieure, associée à un service client exceptionnel et à une expérience de magasinage sans tracas.
    </p>

    <h2 class="fw-bold mt-5">
        Nos Produits
    </h2>
    <p class="fs-5">
        Nous proposons une vaste gamme de pièces automobiles pour une variété de marques et de modèles. Que vous ayez besoin de pièces de moteur, de suspension, d'éclairage ou d'autres accessoires, nous avons ce qu'il vous faut. Nous travaillons en étroite collaboration avec des fournisseurs de confiance pour vous offrir des produits de qualité supérieure à des prix compétitifs.
    </p>

    <h2 class="fw-bold mt-5">
        Engagement envers la Qualité
    </h2>
    <p class="fs-5">
        Chez [Nom de l'entreprise], la qualité est notre priorité. Nous nous engageons à fournir uniquement des pièces automobiles de qualité supérieure, rigoureusement testées et certifiées pour garantir la sécurité et la fiabilité sur la route.
    </p>

    <h2 class="fw-bold mt-5">
        Contactez-nous
    </h2>
    <p class="fs-5 mb-5">
        Nous sommes là pour vous aider ! Si vous avez des questions, des commentaires ou des préoccupations, n'hésitez pas à nous contacter. Notre équipe amicale est disponible pour vous aider du lundi au vendredi, de <strong>08:00</strong> à <strong>17:00</strong>.
    </p>


</div>

@endsection