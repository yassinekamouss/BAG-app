<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProfileControler;
use App\Models\Produit;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//la route principale : 
Route::get('/', function () {
    //Recuperer les produits et categories : 
    $produits = Produit::latest()->paginate(24);

    return view('index', compact(['produits']));
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');
//Definir les routes pour login/sign-In
Route::name('connecte.')->prefix('/connecte')->group(function () {

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login.show');
        Route::post('/login', 'login')->name('login');
        Route::get('/sign', 'showSignupForm')->name('sign.show');
        Route::post('/sign', 'signup')->name('sign');
        Route::get('/logout', 'logout')->name('logout');
    });
});

//les routes pour le categories
Route::name('categories.')->prefix('/categories')->group(function () {
    Route::get('/', [CategorieController::class, 'index'])->name('index');
    Route::get('/search', [CategorieController::class, 'search'])->name('search');
    Route::get('/create', [CategorieController::class, 'create'])->name('create');
    Route::post('/store', [CategorieController::class, 'store'])->name('store');
    Route::get('/{categorie}', [CategorieController::class, 'show'])->name('show');
    Route::get('/{categorie}/edit', [CategorieController::class, 'edit'])->name('edit');
    Route::put('/{categorie}', [CategorieController::class, 'update'])->name('update');
    Route::delete('/{categorie}/delete', [CategorieController::class, 'destroy'])->name('destroy');
});

//les routes pour le produits
Route::name('produits.')->prefix('/produits')->group(function () {
    Route::get('/search', [ProduitController::class, 'search'])->name('search');
    Route::get('/', [ProduitController::class, 'index'])->name('index');
    Route::get('/create', [ProduitController::class, 'create'])->name('create');
    Route::post('/store', [ProduitController::class, 'store'])->name('store');
    Route::get('/{produit}', [ProduitController::class, 'show'])->name('show');
    Route::get('/{produit}/edit', [ProduitController::class, 'edit'])->name('edit');
    Route::put('/{produit}', [ProduitController::class, 'update'])->name('update');
    Route::delete('/{produit}/delete', [ProduitController::class, 'destroy'])->name('destroy');
});

//les routes pour le user
Route::name('users.')->prefix('/users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/search', [UserController::class, 'search'])->name('search');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}/delete', [UserController::class, 'destroy'])->name('destroy');
    Route::get('/profile', [ProfileControler::class, 'index'])->middleware('auth')->name('profile');
});

//les routes pour le commande
Route::name('commandes.')->prefix('/commandes')->group(function () {
    Route::get('/', [CommandeController::class, 'index'])->name('index');
    Route::get('/store', [CommandeController::class, 'store'])->name('store');
    Route::get('/{commande}/edit', [CommandeController::class, 'edit'])->name('edit');
    Route::put('/{commande}', [CommandeController::class, 'update'])->name('update');
    Route::delete('/{commande}/delete', [CommandeController::class, 'destroy'])->name('destroy');
    Route::get('/search', [CommandeController::class, 'search'])->name('search');
    Route::get('/telecharger-pdf', [CommandeController::class, 'generatePDF'])->name('telecharger-pdf');
});

//les routes pour le panier
Route::name('paniers.')->prefix('/paniers')->middleware('auth')->group(function () {
    Route::get('/', [PanierController::class, 'show'])->name('show');
    Route::post('/store', [PanierController::class, 'store'])->name('store');
    Route::put('/{details_panier}/edit', [PanierController::class, 'update'])->name('update');
    Route::delete('/{details_panier}/delete', [PanierController::class, 'destroy'])->name('destroy');
});

// les routes pour l'admin  :
Route::name('admin.')->prefix('/admin')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/produits', [AdminController::class, 'produits'])->name('produits');
    Route::get('/commandes', [AdminController::class, 'commandes'])->name('commandes');
});

//les routes de paiement : 
Route::name('paiement.')->prefix('/paiement')->group(function () {
    Route::get('/checkout', [PaiementController::class, 'checkout'])->name('checkout');
    Route::post('/traitement', [PaiementController::class, 'traitement'])->name('traitement');
    Route::post('/confirm', [PaiementController::class, 'confirm'])->name('confirm');
});

// Routes pour formulaire de contact :
Route::name('contact.')->prefix('/contact')->group(function () {
    Route::get('/', [ContactController::class, 'contact'])->name('form');
    Route::post('/', [ContactController::class, 'send'])->name('send');
});
