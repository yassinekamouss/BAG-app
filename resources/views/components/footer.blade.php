@guest
<div class="container-fluid mt-5 mb-5">
    <div class="border-top border-bottom p-3 text-center">
        <div class="" style="font-size: 13px ;">Decouvrir des produit base sur votre model de voiture</div>
        <a href="{{route('connecte.login.show')}}" class="btn btn-warning rounded-3 mb-2 mt-2 px-5">Se connecter</a>
        <div class="" style="font-size: 12px ;">Vous etes nouveau ? <a href="{{route('connecte.sign.show')}}" class="text-decoration-underline text-secondary">Commencez d'ici</a></div>
    </div>
</div>
@endguest
<footer class="footer " style="position: relative ; bottom : 0 ;">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-2 col-sm-12 first">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex flex-column text-center">
                        <img src="{{ asset('Images/Hyundai-logo.jpeg')}}" alt="" class="mb-4">
                        <p>Vous n'avez pas encore de compte ?</p>
                        <a href="{{ route('connecte.sign.show') }}" id="singup-btn" class="mb-5 btn btn-warning"><span>rejoignez nous</span></a>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-8 col-sm-12 border-start border-end medium">
                <div class="row">
                    <div class="col-12 col-lg mb-sm-4">
                        <div class="d-flex flex-column footer_items">
                            <a href="#" class="text-decoration-none text-white fw-bold mb-4">Accueil</a>
                        </div>
                    </div>
                    <div class="col-12 col-lg mb-sm-4">
                        <div class="d-flex flex-column footer_items">
                            <a href="#" class="text-decoration-none text-white fw-bold mb-4">A propos</a>
                        </div>
                    </div>
                    <div class="col-12 col-lg mb-sm-4">
                        <div class="d-flex flex-column footer_items">
                            <a href="#" class="text-decoration-none text-white fw-bold mb-4">Categories</a>
                            <a href="#" class="text-decoration-none fw-light mb-3">Batterie</a>
                            <a href="#" class="text-decoration-none fw-light mb-3">Pièces moteur</a>
                            <a href="#" class="text-decoration-none fw-light mb-3">Produits de nettoyage</a>
                            <a href="#" class="text-decoration-none fw-light mb-3">Huile moteur</a>
                            <a href="#" class="text-decoration-none fw-light mb-3">Accessoires Voiture</a>
                            <a href="#" class="text-decoration-none fw-light mb-3">Ampoules</a>
                            <a href="#" class="text-decoration-none fw-light mb-3">Pneus</a>
                        </div>
                    </div>
                    <div class="col-12 col-lg mb-sm-4">
                        <div class="d-flex flex-column footer_items">
                            <a href="#" class="text-decoration-none text-white fw-bold mb-4">Actualite</a>
                            <a href="#" class="text-decoration-none fw-light mb-3">Nouveaux</a>
                            <a href="#" class="text-decoration-none fw-light mb-3">Produits</a>
                        </div>
                    </div>
                    <div class="col-12 col-lg mb-sm-4">
                        <div class="d-flex flex-column footer_items">
                            <a href="{{ route('contact.form') }}" class="text-decoration-none text-white fw-bold mb-4">Contact</a>
                            <a href="mailto:contact@notresite.com" class="text-decoration-none fw-light mb-3"><i class="fa-solid fa-envelope"></i> <span class="text-decoration-underline">Email</span></a>
                            <a href="#" class="text-decoration-none fw-light mb-3"><i class="fa-solid fa-phone"></i> <span class="text-decoration-underline">+212987654325</span></a>
                            <a href="#" class="text-decoration-none fw-light mb-3"><i class="fa-solid fa-location-dot"></i> <span class="text-decoration-underline">Location</span></a>
                            {{-- <a href="#" class="text-decoration-none fw-light mb-3"><span class="text-decoration-underline">7j/7-24h/24</span></a> --}}
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-12 text-center end">
                <div class="row">
                    <p>Suivez nous sur : </p>
                    <div class="d-flex flex-md-column flex-wrap justify-content-around icons">
                        <i class="fa-brands fa-facebook my-2"></i>
                        <i class="fa-brands fa-linkedin my-2"></i>
                        <i class="fa-brands fa-square-x-twitter my-2"></i>
                        <i class="fa-brands fa-square-instagram my-2"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 text-center">
            <div class="col">
                &copy;Copyright 2024 <span class="fw-bold">Hyundai</span>.All rights reserved.
            </div>
        </div>        
    </div>
</footer>