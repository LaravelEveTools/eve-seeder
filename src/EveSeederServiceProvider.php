<?php


namespace LaravelEveTools\EveSeeder;


use Illuminate\Support\ServiceProvider;

class EveSeederServiceProvider extends ServiceProvider
{

    public function register(){
        $this->mergeConfigFrom(
            __DIR__ . '/Config/eve-sde.php', 'eve-sde'
        );

        $this->commands([
            \LaravelEveTools\EveSeeder\Console\Eve\Sde\Update::class,
        ]);
    }

    public function boot(){
        $this->publishes([
            __DIR__ . '/Config/eve-sde.php' => config_path('eve-sde.php')
        ], ['config','sde']);
    }

}
