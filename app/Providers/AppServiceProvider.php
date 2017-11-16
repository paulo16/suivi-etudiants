<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::resourceVerbs([
            'create' => 'creer',
            'edit' => 'editer',
            'show' => 'afficher',
            'update' => 'mise-a-jour',
            'delete' => 'supprimer',
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\EtudiantService', 'App\Services\Impl\EtudiantServiceImpl');
        $this->app->bind('App\Services\UserService', 'App\Services\Impl\UserServiceImpl');
        $this->app->bind('App\Services\FiliereService', 'App\Services\Impl\FiliereServiceImpl');
        $this->app->bind('App\Services\EtablissementService', 'App\Services\Impl\EtablissementServiceImpl');
        $this->app->bind('App\Services\AccueilService', 'App\Services\Impl\AccueilServiceImpl');
        $this->app->bind('App\Services\EvolutionService', 'App\Services\Impl\EvolutionServiceImpl');
    }
}
