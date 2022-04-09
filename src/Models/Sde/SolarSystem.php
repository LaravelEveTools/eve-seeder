<?php


namespace LaravelEveTools\EveSeeder\Models\Sde;
class SolarSystem extends AbstractSdeModel
{

    protected $table = 'solar_systems';

    protected $primaryKey = 'system_id';


    public function constellation()
    {
        return $this->belongsTo(Constellation::class, 'constellation_id', 'constellation_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'region_id');
    }

    public function starGates()
    {
        return $this->hasMany(MapSolarSystemJump::class, 'fromSolarSystemID', 'system_id');
    }

    public function planets()
    {
        return $this->hasMany(Planet::class, 'system_id', 'system_id');
    }


}
