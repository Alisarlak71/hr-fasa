<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class accountNumber extends Model
{
    protected $table = 'acount_number';
    protected $fillable = ['h_sheba', 'h_hesab', 'h_cart', 'b_sheba', 'b_hesab','b_cart','edit'];

    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
