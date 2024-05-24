@extends('layout.login')

@section('form')
    <div class="container mt-5 w-md">
    <h2 class="h2 text-center titre fw-bold">Sign In</h2>
        <form action=" {{route('connecte.sign') }} " method="POST" class="p-5 mt-5 rounded-4 form">
            @csrf
            <div class="mb-3"> 
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" id="nom" aria-describedby="emailHelp">
            </div>
            {{-- start display errors --}}
            @error('nom')
            <div class="text-danger">{{$message}}</div>
            @enderror
            {{-- end display errors --}}
            <div class="mb-3"> 
                <label for="prenom" class="form-label">Prenom</label>
                <input type="text" name="prenom" class="form-control" id="prenom" aria-describedby="emailHelp">
            </div>
            {{-- start display errors --}}
            @error('prenom')
            <div class="text-danger">{{$message}}</div>
            @enderror
            {{-- end display errors --}}
            <div class="mb-3"> 
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            {{-- start display errors --}}
            @error('email')
            <div class="text-danger">{{$message}}</div>
            @enderror
            {{-- end display errors --}}
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            {{-- start display errors --}}
            @error('password')
            <div class="text-danger">{{$message}}</div>
            @enderror
            {{-- end display errors --}}
            <div class="mb-3">
                <label for="exampleInputPassword2" class="form-label">Confirm password</label>
                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2">
            </div>
            {{-- start display errors --}}
            @error('password')
            <div class="text-danger">{{$message}}</div>
            @enderror
            {{-- end display errors --}}
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="Check" required>
                <label class="form-check-label" for="Check">En créant un compte,<span class="text-decoration-underline">j'accepte les conditions d'utilisation</span></label>
            </div>
            <button type="submit" class="btn mt-3 form-control">Submit</button>
        </form> 
    </div> 
@endsection