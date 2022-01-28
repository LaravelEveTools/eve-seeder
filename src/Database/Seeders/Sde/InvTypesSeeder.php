<?php


namespace LaravelEveTools\EveSeeder\Database\Seeders\Sde;


use Illuminate\Database\Schema\Blueprint;
use LaravelEveTools\EveSeeder\Mappings\Sde\AbstractSdeMapping;
use LaravelEveTools\EveSeeder\Mappings\Sde\InvTypeMapping;

class InvTypesSeeder extends AbstractSdeSeeder
{

    protected function getSdeTableDefinition(Blueprint $table): void
    {
        $table->integer('typeID')->unsigned()->primary();
        $table->integer('groupID')->unsigned();
        $table->string('typeName');
        $table->text('description')->nullable();
        $table->double('mass')->nullable();
        $table->double('volume')->nullable();
        $table->double('capacity')->nullable();
        $table->integer('portionSize')->nullable();
        $table->integer('raceID')->nullable();
        $table->double('basePrice')->nullable();
        $table->boolean('published')->default(false);
        $table->integer('marketGroupId')->nullable();
        $table->integer('iconID')->nullable();
        $table->integer('graphicID')->nullable();
    }

    protected function getMappingClass(): AbstractSdeMapping
    {
        return new InvTypeMapping();
    }
}
