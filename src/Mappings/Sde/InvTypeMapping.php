<?php


namespace LaravelEveTools\EveSeeder\Mappings\Sde;



use Illuminate\Database\Eloquent\Model;
use LaravelEveTools\EveSeeder\Models\Sde\invType;


class InvTypeMapping extends AbstractSdeMapping
{

    /**
     * @param  array  $row
     * @return Model|Model[]|null
     */
    public function model(array $row)
    {
        return (new InvType([
            'typeID'        => $row[0],
            'groupID'       => $row[1],
            'typeName'      => $row[2],
            'description'   => $row[3],
            'mass'          => $row[4],
            'volume'        => $row[5],
            'capacity'      => $row[6],
            'portionSize'   => $row[7],
            'raceID'        => $row[8],
            'basePrice'     => $row[9],
            'published'     => $row[10],
            'marketGroupID' => $row[11],
            'iconID'        => $row[12],
            'graphicID'     => $row[14],
        ]))->bypassReadOnly();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            '0' => 'integer|min:0|required',
            '1' => 'integer|min:0|required',
            '2' => 'string|max:100|required',
            '3' => 'string|nullable',
            '4' => 'numeric|min:0|required',
            '5' => 'numeric|min:0|required',
            '6' => 'numeric|min:0|required',
            '7' => 'numeric|min:0|required',
            '8' => 'integer|min:0|nullable',
            '9' => 'numeric|min:0|nullable',
            '10' => 'boolean|required',
            '11' => 'integer|min:1|nullable',
            '12' => 'integer|min:0|nullable',
            '14' => 'integer|min:0|required',
        ];
    }

    public function customValidationAttributes()
    {
        return [
            'typeID',
            'groupID',
            'typeName',
            'description',
            'mass',
            'volume',
            'capacity',
            'portionSize',
            'raceID',
            'basePrice',
            'published',
            'marketGroupID',
            'iconID',
            'graphicID'
        ];
    }

    public function customValidationMessages()
    {
        return [
            '0.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '0.min' => self::MIN_VALIDATION_MESSAGE,
            '0.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '1.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '1.min' => self::MIN_VALIDATION_MESSAGE,
            '1.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '2.string' => self::STRING_VALIDATION_MESSAGE,
            '2.max' => self::MAX_VALIDATION_MESSAGE,
            '2.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '3.string' => self::STRING_VALIDATION_MESSAGE,
            '4.numeric' => self::NUMERIC_VALIDATION_MESSAGE,
            '4.min' => self::MIN_VALIDATION_MESSAGE,
            '4.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '5.numeric' => self::NUMERIC_VALIDATION_MESSAGE,
            '5.min' => self::MIN_VALIDATION_MESSAGE,
            '5.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '6.numeric' => self::NUMERIC_VALIDATION_MESSAGE,
            '6.min' => self::MIN_VALIDATION_MESSAGE,
            '6.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '7.numeric' => self::NUMERIC_VALIDATION_MESSAGE,
            '7.min' => self::MIN_VALIDATION_MESSAGE,
            '7.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '8.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '8.min' => self::MIN_VALIDATION_MESSAGE,
            '9.numeric' => self::NUMERIC_VALIDATION_MESSAGE,
            '9.min' => self::MIN_VALIDATION_MESSAGE,
            '10.boolean' => self::BOOLEAN_VALIDATION_MESSAGE,
            '10.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '11.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '11.min' => self::MIN_VALIDATION_MESSAGE,
            '12.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '12.min' => self::MIN_VALIDATION_MESSAGE,
            '14.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '14.min' => self::MIN_VALIDATION_MESSAGE,
            '14.required' => self::REQUIRED_VALIDATION_MESSAGE,
        ];
    }
}
