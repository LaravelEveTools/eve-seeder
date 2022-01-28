<?php

namespace LaravelEveTools\EveSeeder\Database\Seeders\Sde;


use Illuminate\Database\Schema\Blueprint;
use LaravelEveTools\EveSeeder\Mappings\Sde\AbstractSdeMapping;
use LaravelEveTools\EveSeeder\Mappings\Sde\MapSolarSystemsJumpsMapping;

class MapSolarSystemJumpsSeeder extends AbstractSdeSeeder
{

    protected function getSdeTableDefinition(Blueprint $table): void
    {

        $table->bigInteger('fromRegionID')->unsigned();
        $table->bigInteger('fromConstellationID')->unsigned();
        $table->bigInteger('fromSolarSystemID')->unsigned();
        $table->bigInteger('toSolarSystemID')->unsigned();
        $table->bigInteger('toConstellationID')->unsigned();
        $table->bigInteger('toRegionID')->unsigned();

        $table->index(['fromSolarSystemID']);
        $table->index(['toSolarSystemID']);
    }

    protected function getMappingClass(): AbstractSdeMapping
    {
        return new MapSolarSystemsJumpsMapping();
    }
}
