<?php


namespace LaravelEveTools\EveSeeder\Mappings\Sde;


use Illuminate\Database\Eloquent\Model;
use LaravelEveTools\EveSeeder\Models\Sde\InvCategory;

class InvCategoryMapping extends AbstractSdeMapping
{

    public function model(array $row)
    {
        return (new InvCategory([
            'categoryID' => $row[0],
            'categoryName' => $row[1],
            'iconID' => $row[2] == 'None' ? null : $row[2],
            'published' => $row[3]
        ]))->bypassReadOnly();
    }

    public function rules(): array
    {
        return [
            '0' => 'integer|min:0|required',
            '1' => 'string|max:255|required',
            '2' => 'integer|nullable',
            '3' => 'boolean|required'
        ];
    }

    public function customValidationAttributes()
    {
        return [
            'categoryID',
            'categoryName',
            'iconID',
            'published',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '0.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '0.min' => self::MIN_VALIDATION_MESSAGE,
            '0.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '1.string' => self::STRING_VALIDATION_MESSAGE,
            '1.max' => self::MAX_VALIDATION_MESSAGE,
            '1.required' => self::REQUIRED_VALIDATION_MESSAGE,
            '2.integer' => self::INTEGER_VALIDATION_MESSAGE,
            '3.boolean' => self::BOOLEAN_VALIDATION_MESSAGE,
            '3.required' => self::REQUIRED_VALIDATION_MESSAGE
        ];
    }
}
