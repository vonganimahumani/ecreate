<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'base_currency', 'user_currency', 'notify','user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
