<?php

namespace Dvornikov\TQ;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class TQServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }
        $this->loadViewsFrom(__DIR__.'/views', 'tq');
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/dvornikov/tq'),
        ]);

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'tq');

        $this->publishes([
        __DIR__.'/../migrations/' => database_path('migrations')
        ], 'migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        config([
            'laravellocalization.supportedLocales' => [
                'en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English'],
                'ru' => ['name' => 'Russian', 'script' => 'Cyrl', 'native' => 'русский', 'regional' => 'ru_RU']
            ],

            'laravellocalization.useAcceptLanguageHeader' => true,

            'laravellocalization.hideDefaultLocaleInURL' => true
        ]);

        App::register(\Collective\Html\HtmlServiceProvider::class);
        App::register(\Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider::class);
        $loader = AliasLoader::getInstance();
        $loader->alias('Form', 'Collective\Html\FormFacade');
        $loader->alias('HTML', 'Collective\Html\HtmlFacade');
        $loader->alias('LaravelLocalization', \Mcamara\LaravelLocalization\Facades\LaravelLocalization::class);
    }
}
