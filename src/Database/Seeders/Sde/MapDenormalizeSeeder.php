<?php


namespace LaravelEveTools\EveSeeder\Database\Seeders\Sde;


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use LaravelEveTools\EveSeeder\Mappings\Sde\AbstractSdeMapping;
use LaravelEveTools\EveSeeder\Mappings\Sde\MapDenormalizeMapping;
use LaravelEveTools\EveSeeder\Models\Sde\MapDenormalize;

class MapDenormalizeSeeder extends AbstractSdeSeeder
{
    /**
     * Define seeder related SDE table structure.
     *
     * @param \Illuminate\Database\Schema\Blueprint $table
     * @return void
     */
    protected function getSdeTableDefinition(Blueprint $table): void
    {
        $table->integer('itemID')->primary();
        $table->integer('typeID')->nullable();
        $table->integer('groupID')->nullable();
        $table->integer('solarSystemID')->nullable();
        $table->integer('constellationID')->nullable();
        $table->integer('regionID')->nullable();
        $table->integer('orbitID')->nullable();
        $table->double('x')->nullable();
        $table->double('y')->nullable();
        $table->double('z')->nullable();
        $table->double('radius')->nullable();
        $table->string('itemName', 100)->nullable();
        $table->double('security')->nullable();
        $table->integer('celestialIndex')->nullable();
        $table->integer('orbitIndex')->nullable();
    }

    /**
     * The mapping instance which must be used to seed table with SDE dump.
     *
     */
    protected function getMappingClass(): AbstractSdeMapping
    {
        return new MapDenormalizeMapping();
    }

    /**
     * Determine actions which have to be executed after the seeding process.
     *
     * @return void
     */
    protected function after(): void
    {

        $this->explodeMap();
    }

    /**
     * Explode mapDenormalize table into celestial sub-tables.
     */
    private function explodeMap()
    {
        // extract regions
        $this->seedRegionsTable();

        // extract constellations
        $this->seedConstellationsTable();

        // extract solar systems
        $this->seedSolarSystemsTable();

        // extract stars
        $this->seedStarsTable();

        // extract planets
        $this->seedPlanetsTable();

        // extract moons
        $this->seedMoonsTable();
    }

    /**
     * Extract regions from SDE table.
     *
     * @return void
     */
    private function seedRegionsTable()
    {
        Schema::dropIfExists('regions');
        Schema::create('regions', function (Blueprint $table) {
            $table->bigInteger('region_id')->primary();
            $table->string('name');
        });

        DB::table('regions')->truncate();
        DB::table('regions')
            ->insertUsing([
                'region_id', 'name',
            ], DB::table((new MapDenormalize())->getTable())->where('groupID', MapDenormalize::REGION)
                ->select('itemID', 'itemName'));
    }

    /**
     * Extract constellations from SDE table.
     *
     * @return void
     */
    private function seedConstellationsTable()
    {
        Schema::dropIfExists('constellations');
        Schema::create('constellations', function (Blueprint $table) {
            $table->bigInteger('constellation_id')->primary();
            $table->bigInteger('region_id')->unsigned();
            $table->string('name');
        });

        DB::table('constellations')->truncate();
        DB::table('constellations')
            ->insertUsing([
                'constellation_id', 'region_id', 'name',
            ], DB::table((new MapDenormalize())->getTable())->where('groupID', MapDenormalize::CONSTELLATION)
                ->select('itemID', 'regionID', 'itemName'));
    }

    /**
     * Extract systems from SDE table.
     *
     * @return void
     */
    private function seedSolarSystemsTable()
    {
        $ice_csv = __DIR__ . '/../../../Storage/systems_ice.csv';

        Schema::dropIfExists('solar_systems');
        Schema::create('solar_systems', function (Blueprint $table) {
            $table->bigInteger('system_id')->primary();
            $table->bigInteger('constellation_id')->unsigned();
            $table->bigInteger('region_id')->unsigned();
            $table->string('name');
            $table->double('security');
            $table->boolean('ice')->default(false);
            $table->double('x');
            $table->double('y');
            $table->double('z');
        });



        DB::table('solar_systems')->truncate();
        DB::table('solar_systems')
            ->insertUsing([
                'system_id', 'constellation_id', 'region_id', 'name', 'security', 'x', 'y', 'z'
            ], DB::table((new MapDenormalize())->getTable())->where('groupID', MapDenormalize::SYSTEM)
                ->select('itemID', 'constellationID', 'regionID', 'itemName', 'security', 'x', 'y', 'z'));

        $systems = [];

        $handle = fopen($ice_csv, 'r');
        $row=0;
        while(($line = fgetcsv($handle))!== FALSE){
            $row++;
            if($row === 1) continue;
            $systems[] = $line[0];
        }
        fclose($handle);

        if (count($systems) > 0) {
            DB::table('solar_systems')
                ->whereIn('system_id', $systems)
                ->update(['ice' => true]);
        }
    }

    /**
     * Extract stars from SDE table.
     *
     * @return void
     */
    private function seedStarsTable()
    {
        Schema::dropIfExists('stars');
        Schema::create('stars', function (Blueprint $table) {
            $table->integer('star_id')->primary();
            $table->integer('system_id')->unsigned();
            $table->integer('constellation_id')->unsigned();
            $table->integer('region_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->string('name');
        });
        DB::table('stars')->truncate();
        DB::table('stars')
            ->insertUsing([
                'star_id', 'system_id', 'constellation_id', 'region_id', 'name', 'type_id',
            ], DB::table((new MapDenormalize())->getTable())->where('groupID', MapDenormalize::SUN)
                ->select('itemID', 'solarSystemID', 'constellationID', 'regionID', 'itemName', 'typeID'));
    }

    /**
     * Extract planets from SDE table.
     *
     * @return void
     */
    private function seedPlanetsTable()
    {
        Schema::dropIfExists('planets');
        Schema::create('planets', function (Blueprint $table) {
            $table->integer('planet_id')->primary();
            $table->integer('system_id')->unsigned();
            $table->integer('constellation_id')->unsigned();
            $table->integer('region_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->string('name');
            $table->double('x');
            $table->double('y');
            $table->double('z');
            $table->double('radius');
            $table->integer('celestial_index')->nullable();
        });

        DB::table('planets')->truncate();
        DB::table('planets')
            ->insertUsing([
                'planet_id', 'system_id', 'constellation_id', 'region_id', 'name', 'type_id',
                'x', 'y', 'z', 'radius', 'celestial_index',
            ], DB::table((new MapDenormalize())->getTable())->where('groupID', MapDenormalize::PLANET)
                ->select('itemID', 'solarSystemID', 'constellationID', 'regionID', 'itemName', 'typeID',
                    'x', 'y', 'z', 'radius', 'celestialIndex'));
    }

    /**
     * Extract moons from SDE table.
     *
     * @return void
     */
    private function seedMoonsTable()
    {
        Schema::dropIfExists('moons');
        Schema::create('moons', function (Blueprint $table) {
            $table->integer('moon_id')->primary();
            $table->integer('planet_id')->unsigned();
            $table->integer('system_id')->unsigned();
            $table->integer('constellation_id')->unsigned();
            $table->integer('region_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->string('name');
            $table->double('x');
            $table->double('y');
            $table->double('z');
            $table->double('radius');
            $table->integer('celestial_index')->nullable();
            $table->integer('orbit_index')->nullable();
        });

        DB::table('moons')->truncate();
        DB::table('moons')
            ->insertUsing([
                'moon_id', 'planet_id', 'system_id', 'constellation_id', 'region_id', 'name', 'type_id',
                'x', 'y', 'z', 'radius', 'celestial_index', 'orbit_index',
            ], DB::table((new MapDenormalize())->getTable())->where('groupID', MapDenormalize::MOON)
                ->select('itemID', 'orbitID', 'solarSystemID', 'constellationID', 'regionID', 'itemName', 'typeID',
                    'x', 'y', 'z', 'radius', 'celestialIndex', 'orbitIndex'));
    }
}
