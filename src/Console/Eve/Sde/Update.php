<?php


namespace LaravelEveTools\EveSeeder\Console\Eve\Sde;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use LaravelEveTools\EveSeeder\Models\SdeSettings;

class Update extends Command
{

    protected $signature = 'eve:sde:update';

    protected $description = 'Update database with Configured SDE Seeders';


    public function handle(){

        $sde_seeders = config('eve-sde.seeders');

        DB::connection()->getDatabaseName();

        if(!$this->confirm('Are you sure you want to update to latest SDE?', true)){

            $this->warn('Leaving');

            return;
        }


        $seederClasses = collect($sde_seeders)->map(function($seeder){
            return $seeder::getSdeName();
        });

        $this->line("You are about to load the following seeders");

        $seederClasses->each(function($seeder){
            $this->line("<comment> - $seeder</comment>");
        });

        $this->call('db:seed', [
            '--class' => \LaravelEveTools\EveSeeder\Database\Seeders\SdeSeeder::class
        ]);
    }

}
