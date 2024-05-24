@extends('layout.admin')

@section('title')
    Admin-Categories
@endsection

@section('content')
    <div class="col">
        <div class="mt-5 px-5">
            <div class="card border-0 shadow">
                <h4 class="card-header bg-secondary text-white">Liste des categories</h4>
                <div class="card-body p-4 borde">
                    <div class="input-group input-group-lg mb-3">
                        <input type="search" id="searchInput" class="form-control" placeholder="Search Categories by name" aria-label="Search" aria-describedby="button-addon2">
                        <button class="btn btn-secondary" id="button-addon2" type="button" ><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    <div class="text-end">
                        <a href="{{route('categories.create')}}" class="btn btn-success px-4 align-items-center justify-content-around shadow ajouter">
                            <i class="fs-5 fa-solid fa-plus me-3"></i>
                            <span>Ajouter</span>
                        </a>
                    </div>
                    <x-alert />
                    <table class="table table-hover text-center rounded-4 p-5  mt-5">
                        <thead>
                            <tr class="">
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Description</th>
                                <th scope="col">Nbr produits</th>
                                <th scope="col">Créé en</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="categories_table">
                            @foreach ($categories as $categorie)
                                <tr class="align-items-center justify-content-center">
                                    <th>{{$categorie->id}}</th>
                                    <td>{{$categorie->name}}</td>
                                    <td><img src="{{ asset('storage/'.$categorie->image) }}" alt="" style="width: 100px ; height: 50px ; object-fit : cover ;"></td>
                                    <td>{{Str::limit($categorie->description, 30).'...' }}</td>
                                    <td>{{$categorie->produits_count}}</td>
                                    <td>{{$categorie->created_at}}</td>
                                    <td style="cursor: pointer ;">
                                        <form action="{{route('categories.destroy' , $categorie->id)}}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="border-0 bg-transparent" type="submit"><i class="fs-5 text-danger fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                    <td style="cursor: pointer ;">
                                        <a href="{{route('categories.edit' , $categorie->id)}}">
                                            <i class="fs-5 text-success fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($categories->total() > $categories->perPage())
                        <div id="paginationLinks">
                            {{ $categories->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/admin/search_categories.js') }}"></script>
@endsection