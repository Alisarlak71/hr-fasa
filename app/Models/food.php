<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class food extends Model
{
    protected $table = 'user_food';
    protected $fillable = [
        'user_id',
    ];
    public function getUser(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
