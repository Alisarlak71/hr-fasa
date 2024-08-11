<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class documents extends Model
{
    protected $table = 'user_docs';
    protected $fillable = ['user_id', 'type', 'url'];

    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
