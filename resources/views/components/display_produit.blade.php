<div class="container mb-5">
    <h4 class="justify-content-center mt-5">{{$title}}</h4>
    <div>
        <hr class="mt-4 mb-5">    
        @if (!$produits->isEmpty())
            <div class="row row-cols-lg-6">
                @foreach ($produits as $produit)
                <div class="col-6 p-3 rounded-4 prod hoverable">
                    <a href="{{ route('produits.show', $produit->id) }}" class="card-link text-decoration-none">
                        <img src="{{ asset('storage/'.$produit->image) }}" class="card-img-top w-100" alt=" ">
                        <div class="card-body mt-3">
                            <p class="product-title">{{Str::limit($produit->description, 30).'...' }}</p>
                            <span class="text-center">
                                <del id="del-price" class="fw-bold ms-2">{{$produit->prix + 100}}Dh</del>    
                                <span class="fw-bold ms-2" id="price">{{$produit->prix}}Dh</span>
                            </span>
                            @if ($produit->quantite < 2 )
                                <p class="text-danger">Pas dans le stock</p>
                            @endif
                            <div class="mt-4 text-center button">
                                <a href="{{route('produits.show' , $produit->id)}}" class="btn btn-dark rounded-3 px-3 w-100 hidden">Apperçu</a>
                                @auth
                                <form action="{{route('paniers.store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$produit->id}}">
                                    @if ($produit->quantite < 2)
                                        <button type="submit" class="btn disabled btn-dark rounded-3 px-3 w-100 mt-2 hidden">Ajouter<i class="fs-7 fa-solid fa-cart-shopping"></i></button>                                            
                                    @else
                                        <button type="submit" class="btn btn-dark rounded-3 px-3 w-100 mt-2 hidden">Ajouter<i class="fs-7 fa-solid fa-cart-shopping"></i></button>                                            
                                    @endif
                                </form>
                                @endauth                                          
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        @else
            <div class="container d-flex justify-content-center">
                {{-- <img src="{{ asset('Images/empty-set.jpeg') }}" alt="" style="width: 200px ; height : 200px ;"> --}}
                <h4 class="mt-4 mb-5 p-5">Pas d'elements dans cette categorie!!</h4>
            </div>

        @endif
    </div>
</div>