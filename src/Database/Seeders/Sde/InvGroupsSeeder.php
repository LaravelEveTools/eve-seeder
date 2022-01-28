<?php


namespace LaravelEveTools\EveSeeder\Database\Seeders\Sde;


use Illuminate\Database\Schema\Blueprint;
use LaravelEveTools\EveSeeder\Mappings\Sde\AbstractSdeMapping;

class InvGroupsSeeder extends AbstractSdeSeeder
{

    protected function getSdeTableDefinition(Blueprint $table): void
    {
        $table->integer('groupID')->primary();
        $table->integer('categoryID');
        $table->string('groupName', 100);
        $table->integer('iconID')->nullable();
        $table->boolean('useBasePrice');
        $table->boolean('anchored');
        $table->boolean('anchorable');
        $table->boolean('fittableNonSingleton');
        $table->boolean('published');
    }

    protected function getMappingClass(): AbstractSdeMapping
    {
        // TODO: Implement getMappingClass() method.
    }
}
