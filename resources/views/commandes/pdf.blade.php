<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        h1{
            color: rgb(108, 117, 125)  ;
            font-size: 3rem ;
            text-align: center ;
        }
        .fw-bold{
            font-weight: 200 ;
        }
        .text-danger{
            color: red ;
        }
    h4 {
    margin: 0;
    }
.w-full {
    width: 100%;
}
    </style>
</head>
<body>

    @php
        $total = 0;
    @endphp

    @foreach ($commande->produits as $produit)
        @php
            $total += $produit->prix * $produit->pivot->quantite;
        @endphp
    @endforeach
    <table style="width : 100% ;">
        <tr>
            <td style="text-align: left ;">
                <span class="align-left fw-bold" style="font-size: 1.9rem; color: rgb(90, 97, 104);">Détails de la commande</span>
                @if (count($commande->produits) === 1)
                    @if ($commande->produits->first()->quantite < 1)
                        <span class="text-danger fw-bold">(Commande fermée)</span>
                    @endif
                @endif
            </td>
            <td style="text-align: right ; ">
                <img src="{{ public_path('Images/stickers-hyundai-ref-9-auto-tuning-amortisseur-4x4-tout-terrain-auto-camion-competition-rallye-autocollant-min.jpeg') }}" alt="logo" style="width: 130px; height: 70px;">
            </td>
        </tr>
    </table>
    
    <hr style="margin-top:20px ;">
    <div class="margin-top" style="margin-top: 70px ;">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div><p class="">N de commande:</p></div>
                    <div class="fw-bold">#{{$commande->id}}</div>
                </td>
                <td class="w-half">
                    <div><p class="">Date de creation :</p></div>
                    <div class="fw-bold">{{ date("Y-m-d", strtotime($commande->created_at))}}</div>
                </td>
                <td class="w-half">
                    <div><p class="">Total :</p></div>
                    <div class="fw-bold">{{$total}}DH</div>
                </td>
                <td class="w-half">
                    <div><p class="">Méthode :</p></div>
                    <div class="fw-bold">{{$commande->paiementMethod}}</div>
                </td>
                <td class="w-half">
                    <div><p class="">Etat :</p></div>
                    <div class="fw-bold">En attente</div>
                </td>
            </tr>
        </table>
    </div>

    <div style="margin-top : 40px ; text-align: left;font-weight: bold;font-size: 1.25rem; padding : 10px 10px; background-color : rgb(33, 37, 41 , 0.05) ; font-family :cursive">Produits commandés</div>
    <div style="padding : 10px ;">
        <table style="width: 100%;margin-top: 20px ;">
            <tr>
                <td style="text-align: left;font-weight: bold;font-size: 1.2rem;font-family :cursive">Produits</td>
                <td style="text-align: right;font-weight: bold;font-size: 1.2rem;font-family :cursive">Prix</td>
            </tr>
        </table>
        <hr style="height: 1px; background-color: rgb(209, 209, 209); border: none; margin: 10px 0;">
        @foreach ($commande->produits as $produit)
        <table style="width: 100%;margin-top: 20px ;font-size: 1rem;">
            <td style="text-align:left">
                <span>{{ $produit->title }}</span> 
                <span style="font-weight: bold;">* {{ $produit->pivot->quantite }}</span>
                @if ($produit->quantite < 1)
                <span style="color: red;">( en rupture de stock "Commande fermée" )</span>
                @endif
            </td>
            <td style="text-align: right ; ">
                <span style="font-weight: bold;">{{ $produit->prix * $produit->pivot->quantite }}DH</span>
            </td>
        </table>
        @endforeach
        <table style="width: 100%;margin-top: 20px ; ">
            <tr>
                <td style="text-align: left;font-weight: bold; font-size: 1.1rem;" rowspan="2">Total</td>
                <td style="text-align: right;font-weight: bold; font-size: 1.1rem;" rowspan="2">{{ $total }}DH</td>
            </tr>
        </table>
    </div>

        <div style="margin-top : 40px ; text-align: left;font-weight: bold;font-size: 1.25rem; padding : 10px 10px; background-color : rgb(33, 37, 41 , 0.05); font-family :cursive">Détails de la facturation</div>
        <table style="margin-top : 10px ; padding: 10px ;">
            <tr> <td>{{$commande->client->nom}}</td> </tr>
            <tr> <td>{{$commande->client->prenom}}</td> </tr>
            <tr> <td>{{$commande->client->email}}</td> </tr>
            <tr> <td{{$commande->client->ville}}></td> </tr>
            <tr> <td>{{$commande->client->adresse}}</td> </tr>
            <tr> <td>Maroc</td> </tr>
            <tr> <td>{{$commande->client->n_tel}}</td> </tr>
        </table>
</body>
</html>