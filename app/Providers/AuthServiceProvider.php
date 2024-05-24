<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User ;
use App\Policies\CategoriePolicy;
use App\Policies\ProduitPolicy;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Produit::class => ProduitPolicy::class ,
        User::class => UserPolicy::class ,
        Categorie::class => CategoriePolicy::class 
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
