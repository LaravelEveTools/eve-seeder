<?php


namespace LaravelEveTools\EveSeeder\Mappings\Sde;


use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

abstract class AbstractSdeMapping extends DefaultValueBinder implements ToModel, WithCustomCsvSettings, WithCustomValueBinder, WithChunkReading, WithStartRow
{
    use RemembersRowNumber;

    const STRING_VALIDATION_MESSAGE = '<comment>:attribute</comment> must be a valid string : :input !';
    const INTEGER_VALIDATION_MESSAGE = '<comment>:attribute</comment> must be a valid integer : :input !';
    const NUMERIC_VALIDATION_MESSAGE = '<comment>:attribute</comment> must be a valid integer : :input !';
    const BOOLEAN_VALIDATION_MESSAGE = '<comment>:attribute</comment> must be a boolean : :input !';
    const MIN_VALIDATION_MESSAGE = '<comment>:attribute</comment> must be positive : :input !';
    const MAX_VALIDATION_MESSAGE = '<comment>:attribute</comment> must count :max characters or less !';
    const BETWEEN_VALIDATION_MESSAGE = '<comment>:attribute</comment> must be a number between :min and :max : :input !';
    const REQUIRED_VALIDATION_MESSAGE = '<comment>:attribute</comment> must be a valid integer : :input !';


   /**
     * @return array
     */
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ',',
            'input_encoding' => 'UTF-8',
        ];
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 10000;
    }

    /**
     * @param  \PhpOffice\PhpSpreadsheet\Cell\Cell  $cell
     * @param $value
     * @return bool
     *
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function bindValue(Cell $cell, $value)
    {
        if ($value == 'None') {
            $cell->setValueExplicit(null, DataType::TYPE_NULL);

            return true;
        }

        return parent::bindValue($cell, $value);
    }
}
