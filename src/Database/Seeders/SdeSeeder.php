<?php


namespace LaravelEveTools\EveSeeder\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use LaravelEveTools\EveSeeder\Database\Seeders\Sde\AbstractSdeSeeder;
use LaravelEveTools\EveSeeder\Exceptions\DirectoryNotAccessibleException;
use LaravelEveTools\EveSeeder\Exceptions\InvalidSdeConfiguration;
use LaravelEveTools\EveSeeder\Exceptions\InvalidSdeSeederException;

class SdeSeeder extends Seeder
{

    /**
     * @var string
     */
    private string $sde_repository = 'https://www.fuzzwork.co.uk/dump/:version/';

    /**
     * @var string
     */
    private string $version;

    public function __construct()
    {
        $this->version = config('eve-sde.version', 'latest');
    }


    /**
     * @throws DirectoryNotAccessibleException
     * @throws InvalidSdeConfiguration
     */
    public function run()
    {
        $sde_seeders = config('eve-sde.seeders', []);

        if(!is_array($sde_seeders))
            throw new InvalidSdeConfiguration("Config eve-sde.seeders must be an array of Sde Seeder Classes");

        if (!$this->isStorageOK())
            throw new DirectoryNotAccessibleException("Storage path isn't Accessible. Check Permissions to the sde folder inside storage");

        $this->command->info('Seeding....');
        $this->downloadSdeFiles($sde_seeders);

        $this->command->info('Seeding SDE into Database...');
        $this->call($sde_seeders);
    }

    private function downloadSdeFiles(array $sde_seeders){

        foreach($sde_seeders as $seeder){

            $this->command->info("<comment>Currently Seeding: </comment> {$seeder::getSdeName()}");
            if(! is_subclass_of($seeder, AbstractSdeSeeder::class)){
                throw new InvalidSdeSeederException($seeder . 'must extend '. AbstractSdeSeeder::class .'to be used with Sde Seeder');
            }

            $url = $this->getSdeFileRemoteUri($seeder);
            $destination = $this->getSdeFileLocalUri($seeder);

            $file_handler = fopen($destination, 'w');

            $result = Http::withOptions([
                'sink' => $file_handler
            ])->get($url);

            fclose($file_handler);

            if($result->status() == 200){
                $this->command->getOutput()->writeln("<comment>Downloaded: </comment> {$seeder::getSdeName()}");
                continue;
            }

            $this->command->error(sprintf("Unable to download: %s. The HTTP response was: %s", $url, $result->status()));

        }
    }

    /**
     * Get remote URI for the provided Seeder
     *
     * @param string $seeder
     * @return string
     */
    private function getSdeFileRemoteUri(string $seeder): string {
        return str_replace(':version', $this->version, $this->sde_repository) . $seeder::getSdeName() . '.csv';
    }

    /**
     * Get Local uri for provided Seeder
     *
     * @param string $seeder
     * @return string
     */
    private function getSdeFileLocalUri(string $seeder): string {
        return storage_path('sde/'.$seeder::getSdeName().'.csv');
    }

    /**
     * Checks the SDE storage path is writable
     * @return bool
     */
    private function isStorageOk(): bool
    {
        $storage = storage_path('sde/');
        $this->command->getOutput()->writeln("<comment>SDE storage path is: </comment> {$storage}");

        if (!File::isWritable(storage_path())) return false;

        if (!File::exists($storage))
            File::makeDirectory($storage, 0755, true);

        return true;
    }


}
