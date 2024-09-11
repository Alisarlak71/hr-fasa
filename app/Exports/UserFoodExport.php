<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class UserFoodExport implements FromCollection, WithHeadings, WithColumnWidths, WithCustomValueBinder
{
    public function headings(): array
    {
        return [
            'کد پرسنلی',
            'نام',
            'نام خانوادگی'
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value) && $cell->getRow() != 1 && !in_array($cell->getColumn(), ['A', 'B', 'C'])) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }
        $cell->setValueExplicit($value, DataType::TYPE_STRING2);
        return true;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 10,
            'C' => 15
        ];
    }

    /**
     * @return array
     */
    public function collection()
    {
        $userFoods = \DB::table('user_food')
            ->join('users', 'users.id', '=', 'user_food.user_id')
            ->select('users.code', 'users.name', 'users.lname')
            ->get();
        return $userFoods;
        //return accountNumber::with('getUser')->get();
    }
}
