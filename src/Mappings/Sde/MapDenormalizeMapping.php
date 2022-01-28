<?php


namespace LaravelEveTools\EveSeeder\Mappings\Sde;


use LaravelEveTools\EveSeeder\Models\Sde\MapDenormalize;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;


class MapDenormalizeMapping extends AbstractSdeMapping
{

    public function model(array $row)
    {
         return (new MapDenormalize([
            'itemID'          => $row[0],
            'typeID'          => $row[1],
            'groupID'         => $row[2],
            'solarSystemID'   => $row[3],
            'constellationID' => $row[4],
            'regionID'        => $row[5],
            'orbitID'         => $row[6],
            'x'               => $row[7],
            'y'               => $row[8],
            'z'               => $row[9],
            'radius'          => $row[10],
            'itemName'        => $row[11],
            'security'        => $row[12],
            'celestialIndex'  => $row[13],
            'orbitIndex'      => $row[14],
        ]))->bypassReadOnly();
    }

    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() == 'L') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        return parent::bindValue($cell, $value);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            '0' => 'integer|between:10000000,80000000|required',
            '1' => 'integer|min:1|required',
            '2' => 'integer|min:1|required',
            '3' => 'integer|between:30000000,35000000|nullable',
            '4' => 'integer|between:20000000,25000000|nullable',
            '5' => 'integer|between:10000000,15000000|nullable',
            '6' => 'integer|min:1|nullable',
            '7' => 'numeric|required',
            '8' => 'numeric|required',
            '9' => 'numeric|required',
            '10' => 'numeric|min:0|nullable',
            '11' => 'string|max:100|required',
            '12' => 'numeric|between:-10,10|nullable',
            '13' => 'integer|min:1|nullable',
            '14' => 'integer|between:1,50|nullable',
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => 'itemID',
            '1' => 'typeID',
            '2' => 'groupID',
            '3' => 'solarSystemID',
            '4' => 'constellationID',
            '5' => 'regionID',
            '6' => 'orbitID',
            '7' => 'x',
            '8' => 'y',
            '9' => 'z',
            '10' => 'radius',
            '11' => 'itemName',
            '12' => 'security',
            '13' => 'celestialIndex',
            '14' => 'orbitIndex',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '0.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '0.between' => self::BETWEEN_VALIDATION_MESSAGE,
            '0.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '1.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '1.min' => self::MIN_VALIDATION_MESSAGE,
            '1.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '2.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '2.min' => self::MIN_VALIDATION_MESSAGE,
            '2.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '3.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '3.between' => self::BETWEEN_VALIDATION_MESSAGE,
            '4.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '4.between' => self::BETWEEN_VALIDATION_MESSAGE,
            '5.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '5.between' => self::BETWEEN_VALIDATION_MESSAGE,
            '6.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '6.min' => self::MIN_VALIDATION_MESSAGE,
            '7.numeric' => self::NUMERIC_VALIDATION_MESSAGE,
            '7.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '8.numeric' => self::NUMERIC_VALIDATION_MESSAGE,
            '8.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '9.numeric' => self::NUMERIC_VALIDATION_MESSAGE,
            '9.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '10.numeric' => self::NUMERIC_VALIDATION_MESSAGE,
            '10.min' => self::MIN_VALIDATION_MESSAGE,
            '11.string' => self::STRING_VALIDATION_MESSAGE,
            '11.max' => self::MAX_VALIDATION_MESSAGE,
            '11.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '12.numeric' => self::NUMERIC_VALIDATION_MESSAGE,
            '12.between' => self::BETWEEN_VALIDATION_MESSAGE,
            '13.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '13.min' => self::MIN_VALIDATION_MESSAGE,
            '14.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '14.between' => self::BETWEEN_VALIDATION_MESSAGE,
        ];
    }
}
