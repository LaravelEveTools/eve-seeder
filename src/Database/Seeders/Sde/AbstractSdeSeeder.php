<?php


namespace LaravelEveTools\EveSeeder\Database\Seeders\Sde;


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use LaravelEveTools\EveSeeder\Mappings\Sde\AbstractSdeMapping;
use League\Flysystem\FileNotFoundException;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;


abstract class AbstractSdeSeeder extends Seeder
{

    /**
     * @throws FileNotFoundException
     */
    public function run(){
        $this->createTable();

        $this->seedTable();

        $this->after();
    }

    /**
     * Provide the SDE dump filename related to the active seeder
     * @return string
     */
    final static public function getSdeName(): string{
        $class_name = substr(static::class, strrpos(static::class, '\\') + 1);
        $filename = substr($class_name, 0, strpos($class_name, 'Seeder'));

        return Str::camel($filename);
    }

    abstract protected function getSdeTableDefinition(Blueprint $table): void;

    abstract protected function getMappingClass(): AbstractSdeMapping;

    /**
     * Hook function to fire after the seed has completed
     */
    protected function after():void {

    }

    /**
     * Recreates the table for the seed
     */
    final protected function createTable(): void{
        Schema::dropIfExists($this->getSdeName());

        Schema::create($this->getSdeName(), function(Blueprint $table){
            $this->getSdeTableDefinition($table);
        });
    }


    /**
     * Use SDE Dump related to seeder to seed the table
     * @throws FileNotFoundException
     */
    final protected function seedTable(): void{
        $sde_dump = $this->getSdeName();
        $path = storage_path("sde/$sde_dump.csv");

        if(!file_exists($path)){
            throw new FileNotFoundException("Unable to retrieve $path");
        }

        try{
            Excel::import($this->getMappingClass(), $path);
        } catch (ValidationException $e){
            $failures = $e->failures();

            foreach($failures as $failure){
                $this->command->error("An error has been encountered at row {$failure->row()}");

                foreach($failures->errors() as $error) {
                    $this->command->getOutput()->writeln($error);
                }
            }
        }
    }
}
