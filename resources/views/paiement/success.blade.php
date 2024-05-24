@extends('layout.master')

@section('title')
    Paiement success
@endsection

@section('content')
     
    <div class="container mt-5 mb-5 p-5 text-center">
        <img src="{{asset('Images/payment-success.png')}}" alt="">
        <p class="fs-4">Le paiement à été bien effectué</p>
       <a href="{{route('paniers.show')}}" class="btn btn-success px-4 mb-5">Back to card-page</a>
    </div>

@endsection