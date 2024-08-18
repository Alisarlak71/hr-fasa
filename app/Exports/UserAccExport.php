<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class UserAccExport implements FromCollection, WithHeadings, WithColumnWidths, WithCustomValueBinder
{
    public function headings(): array
    {
        return [
            'کد پرسنلی',
            'نام',
            'نام خانوادگی',
            'شبا حقوق',
            'حساب حقوق',
            'کارت حقوق',
            'شبا بن کارت',
            'حساب بن کارت',
            'کارت بن کارت',
        ];
    }

    /*public function getCsvSettings(): array
    {
        return [
            'output_encoding' => 'UTF-8',
            'Content-Encoding' => 'UTF-8'
        ];
    }*/

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
            'C' => 15,
            'D' => 30,
            'E' => 30,
            'F' => 30,
            'G' => 30,
            'H' => 30,
            'I' => 30,
        ];
    }

    /**
     * @return array
     */
    public function collection()
    {
        //$acountNumbers = accountNumber::with('getUser')->get();
        $acountNumbers = \DB::table('acount_number')
            ->join('users', 'users.id', '=', 'acount_number.user_id')
            ->select('users.code', 'users.name', 'users.lname', 'acount_number.h_sheba', 'acount_number.h_hesab', 'acount_number.h_cart', 'acount_number.b_sheba', 'acount_number.b_hesab', 'acount_number.b_cart')
            ->get();
        return $acountNumbers;

        //return accountNumber::with('getUser')->get();
    }
}
