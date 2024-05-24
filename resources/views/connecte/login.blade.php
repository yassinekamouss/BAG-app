@extends('layout.login')

@section('form')
    <div class="container mt-5 w-md">
    <h2 class="h2 text-center titre fw-bold">Login</h2>
        <form action="{{ route('connecte.login') }}" method="POST" class="p-5 mt-5 rounded-4 form">
            @csrf
            <div class="mb-3"> 
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('email')}}">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                @error('email')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                @error('password')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn mt-3 form-control">Submit</button>
            <div id="" class="form-text d-flex justify-content-between mt-2">Vous n'avez pas encore du compte
                <a href="{{route('connecte.sign.show')}}" class="text-warning">Sing up</a>
            </div>
           
        </form> 
    </div> 
@endsection