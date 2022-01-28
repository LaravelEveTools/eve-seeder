<?php

namespace LaravelEveTools\EveSeeder\Mappings\Sde;


use Illuminate\Database\Eloquent\Model;
use LaravelEveTools\EveSeeder\Models\Sde\MapSolarSystemJump;

class MapSolarSystemsJumpsMapping extends AbstractSdeMapping
{

    public function model(array $row)
    {
        return (new MapSolarSystemJump([
            'fromRegionID' => $row[0],
            'fromConstellationID' => $row[1],
            'fromSolarSystemID' => $row[2],
            'toSolarSystemID' => $row[3],
            'toConstellationID' => $row[4],
            'toRegionID' => $row[5]
        ]))->bypassReadOnly();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            '0' => 'integer|required',
            '1' => 'integer|required',
            '2' => 'integer|required',
            '3' => 'integer|required',
            '4' => 'numeric|required',
            '5' => 'numeric|required',
        ];
    }

    public function customValidationAttributes()
    {
        return [
            'fromRegionID',
            'fromConstellationID',
            'fromSolarSystemID',
            'toSolarSystemID',
            'toConstellationID',
            'toRegionID'
        ];
    }

    public function customValidationMessages()
    {
        return [
            '0.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '0.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '1.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '1.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '2.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '2.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '3.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '3.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '4.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '4.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '5.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '5.required' => self::REQUIRED_VALIDATION_MESSAGE,
        ];
    }
}
