<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class UserAccExport implements FromCollection, WithHeadings, WithCustomCsvSettings,WithColumnFormatting,WithCustomValueBinder
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

    public function getCsvSettings(): array
    {
        return [
            'output_encoding' => 'UTF-8',
            'Content-Encoding' => 'UTF-8'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_TEXT,
        ];
    }
    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }
        return true;
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
