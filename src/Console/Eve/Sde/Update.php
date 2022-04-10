<?php


namespace LaravelEveTools\EveSeeder\Console\Eve\Sde;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use LaravelEveTools\EveSeeder\Models\SdeSettings;

class Update extends Command
{

    protected $signature = 'eve:sde:update 
                            {--force : Force update of SDE}';

    protected $description = 'Update database with Configured SDE Seeders';

    public function CheckForUpdate(){
        $version = config('eve-sde.version');
        $sde_seeders = config('eve-sde.seeders');

        if($version == 'latest'){
            $this->warn('(CheckForUpdate) - Using Latest: unable to determine if the current version is updated or not so reinstalling anyway');
            return true;
        }

        $setting = SdeSettings::latest()->first();
        if(is_null($setting)){
            $this->warn('(CheckForUpdate) - No Sde Setting: This indicated it is first run. Installing Sde');
            return true;
        }

        if($version != $setting->version){
            $this->warn('(CheckForUpdate) - Version Change: A version change in the SDE has been detected. Installing SDE');
            return true;
        }

        if(count(array_diff($sde_seeders, $setting->sde)) != 0){
            $this->warn('(CheckForUpdate) - SDE Change: A change has been detected in the required SDE\'s. Installing SDE');
            return true;
        }

        return false;
    }


    public function handle(){

        $sde_seeders = config('eve-sde.seeders');

        DB::connection()->getDatabaseName();

        if(!$this->confirm('Are you sure you want to update to latest SDE?', true)){

            $this->warn('Leaving');

            return;
        }

        if(!$this->Option('force') && !$this->CheckForUpdate()){
            $this->warn('No reason to update SDE');
            $this->warn('Use --force option if you want to force an update');
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
