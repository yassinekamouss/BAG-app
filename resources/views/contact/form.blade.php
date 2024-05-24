@extends('layout.master')

@section('title')
    Contact Us
@endsection

@section('content')
    <div class="p-5 text-center shadow-sm">
        <h1 class="fw-bold fs-1 text-dark">Contactez-nous</h1>
    </div>
    {{-- affichage de message lors d'un envoie avec success de la form --}}
    <x-alert />
    <div class="container mb-5">
        <div class="row mt-5">

            <div class="col">
                <div class="p-5">
                    <h4>Nous sommes là pour vous aider</h4>
                    <p>Nous sommes toujours heureux d'entendre parler de nos clients. Que vous ayez une question, un commentaire ou une préoccupation, n'hésitez pas à nous contacter en utilisant le formulaire ci-dessous. Nous vous répondrons dans les plus brefs délais.</p>
                    <h4 class="mt-5">Informations de Contact</h4>
                    <ul class="list-unstyled ms-3 mt-3">
                        <li class="list-group-item"><span class="fw-bold fs-5 me-3"><i class="fa-solid fa-location-dot"></i></span>123 Rue Fictive,Ville Imaginaire, Pays des Rêves.</li>
                        <li class="list-group-item"><span class="fw-bold fs-5 me-3"><i class="fa-solid fa-phone-volume"></i></span> +212987654325</li>
                        <li class="list-group-item"><span class="fw-bold fs-5 me-3"><i class="fa-solid fa-envelope"></i></span> Example_email@gmail.com</li>
                    </ul>
                </div>
            </div>
        
            <div class="col">
                <div class="shadow-sm p-5">
                    <h3 class="">Formulaire de contact</h3>
                    <hr class="mt-4 mb-4">
                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom">
                            @error('nom')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input type="email" class="form-control" id="email" name="email">
                            @error('email')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="sujet" class="form-label">Sujet</label>
                            <input type="text" class="form-control" id="sujet" name="sujet">
                            @error('sujet')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                            @error('message')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <button type="submit" class="btn btn-warning form-control mt-3">Envoyer</button>
                    </form>
                </div>    
            </div>
        </div>
    </div>


@endsection