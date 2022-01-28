<?php


namespace LaravelEveTools\EveSeeder\Database\Seeders\Sde;


use Illuminate\Database\Schema\Blueprint;
use LaravelEveTools\EveSeeder\Mappings\Sde\AbstractSdeMapping;
use LaravelEveTools\EveSeeder\Mappings\Sde\InvCategoryMapping;

class InvCategoriesSeeder extends AbstractSdeSeeder
{

    protected function getSdeTableDefinition(Blueprint $table): void
    {
        $table->integer('categoryID')->nullable()->primary();
        $table->string('categoryName');
        $table->integer('iconID')->nullable();
        $table->boolean('published')->default(false);
    }

    protected function getMappingClass(): AbstractSdeMapping
    {
        return new InvCategoryMapping();
    }
}
