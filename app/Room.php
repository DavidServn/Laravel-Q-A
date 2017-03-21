<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = [
        'name', 'password'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}