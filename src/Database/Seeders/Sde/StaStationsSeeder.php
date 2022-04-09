<?php


namespace LaravelEveTools\EveSeeder\Database\Seeders\Sde;


use Illuminate\Database\Schema\Blueprint;
use LaravelEveTools\EveSeeder\Mappings\Sde\AbstractSdeMapping;
use LaravelEveTools\EveSeeder\Mappings\Sde\StaStationMapping;

class StaStationsSeeder extends AbstractSdeSeeder
{

    /**
     * StaStation Structure
     * @param Blueprint $table
     */
    protected function getSdeTableDefinition(Blueprint $table): void
    {
        $table->bigInteger('stationID')->unsigned()->primary();
        $table->double('security');
        $table->double('dockingCostPerVolume');
        $table->double('maxShipVolumeDockable');
        $table->double('officeRentalCost');
        $table->integer('operationID');
        $table->integer('stationTypeID');
        $table->bigInteger('corporationID');
        $table->integer('solarSystemID');
        $table->integer('constellationID');
        $table->integer('regionID');
        $table->string('stationName', 100);
        $table->double('x');
        $table->double('y');
        $table->double('z');
        $table->double('reprocessingEfficiency');
        $table->double('reprocessingStationsTake');
        $table->double('reprocessingHangarFlag');
    }

    /**
     * Data mapping instance
     * @return AbstractSdeMapping
     */
    protected function getMappingClass(): AbstractSdeMapping
    {
        return new StaStationMapping();
    }
}
