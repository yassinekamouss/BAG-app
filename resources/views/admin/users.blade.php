@extends('layout.admin')

@section('title')
    Admin-Users
@endsection

@section('content')
    <div class="col">
        <div class="mt-5 px-5">
            <div class="card border-0 shadow">
                <h4 class="card-header bg-secondary text-white">Liste des clients</h4>
                <div class="card-body p-4 borde">
                    <div class="input-group input-group-lg mb-3">
                        <input type="search" id="searchInput" class="form-control" placeholder="Search User by email" aria-label="Search" aria-describedby="button-addon2">
                        <button class="btn btn-secondary" id="button-addon2" type="button" ><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    <x-alert />
                    <table class="table table-hover text-center rounded-4 p-5  mt-5">
                        <thead>
                            <tr class="">
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Ville</th>
                                <th scope="col">N° Tel</th>
                                <th scope="col">Créé en</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="clients_table">
                            @foreach ($users as $user)
                                <tr>
                                    <th>{{$user->id}}</th>
                                    <td>{{$user->nom}}</td>
                                    <td>{{$user->prenom}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->ville ? $user->ville : 'null'}}</td>
                                    <td>{{$user->n_tel}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td style="cursor: pointer ;">
                                        <form action="{{route('users.destroy' , $user->id)}}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="border-0 bg-transparent" type="submit"><i class="fs-5 text-danger fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($users->total() > $users->perPage())
                        <div id="paginationLinks">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>    
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/admin/search_clients.js') }}"></script>
@endsection