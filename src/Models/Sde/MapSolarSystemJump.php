<?php

namespace LaravelEveTools\EveSeeder\Models\Sde;


class MapSolarSystemJump extends AbstractSdeModel
{

    protected $table = 'mapSolarSystemJumps';


    public function fromSolarSystem(){
        return $this->hasOne(SolarSystem::class, 'system_id', 'fromSolarSystemID');
    }

     public function toSolarSystem(){
        return $this->hasOne(SolarSystem::class, 'system_id', 'toSolarSystemID');
    }
}
