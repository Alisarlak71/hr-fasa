<?php

namespace App\Exports;

use App\Models\accountNumber;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserAccExport implements FromCollection, WithHeadings
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

        return accountNumber::with('getUser')->get();
    }
}
