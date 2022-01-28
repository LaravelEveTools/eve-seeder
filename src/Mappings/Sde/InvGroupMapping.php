<?php


namespace LaravelEveTools\EveSeeder\Mappings\Sde;


use LaravelEveTools\EveSeeder\Models\Sde\InvGroup;

class InvGroupMapping extends AbstractSdeMapping
{
    /**
     * @param array $row
     * @return Model|Model[]|null
     */
    public function model(array $row)
    {
        return (new InvGroup([
            'groupID' => $row[0],
            'categoryID' => $row[1],
            'groupName' => $row[2],
            'iconID' => $row[3],
            'useBasePrice' => $row[4],
            'anchored' => $row[5],
            'anchorable' => $row[6],
            'fittableNonSingleton' => $row[7],
            'published' => $row[8],
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
            '3' => 'integer|min:0|nullable',
            '4' => 'boolean|required',
            '5' => 'boolean|required',
            '6' => 'boolean|required',
            '7' => 'boolean|required',
            '8' => 'boolean|required',
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => 'groupID',
            '1' => 'categoryID',
            '2' => 'groupName',
            '3' => 'iconID',
            '4' => 'useBasePrice',
            '5' => 'anchored',
            '6' => 'anchorable',
            '7' => 'fittableNonSingleton',
            '8' => 'published',
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
            '3.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '3.min' => self::MIN_VALIDATION_MESSAGE,
            '4.boolean' => self::BOOLEAN_VALIDATION_MESSAGE,
            '4.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '6.boolean' => self::BOOLEAN_VALIDATION_MESSAGE,
            '6.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '5.boolean' => self::BOOLEAN_VALIDATION_MESSAGE,
            '5.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '7.boolean' => self::BOOLEAN_VALIDATION_MESSAGE,
            '7.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '8.boolean' => self::BOOLEAN_VALIDATION_MESSAGE,
            '8.required' => self::REQUIRED_VALIDATION_MESSAGE,
        ];
    }
}
