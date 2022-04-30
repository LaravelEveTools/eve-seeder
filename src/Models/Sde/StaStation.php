<?php


namespace LaravelEveTools\EveSeeder\Models\Sde;


class StaStation extends AbstractSdeModel
{


    /**
     * @var string
     */
    protected $table = 'staStations';

    /**
     * @var string
     */
    protected $primaryKey = '';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return int
     */
    public function getStructureIdAttribute()
    {
        return $this->stationID;
    }

    /**
     * @return int
     */
    public function getSolarSystemIdAttribute()
    {
        return $this->solarSystemID;
    }

    /**
     * @return int
     */
    public function getTypeIdAttribute()
    {
        return $this->stationTypeID;
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->stationName;
    }
}
