<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'name', 'question', 'accepted', 'room_id'
    ];

    public function scopeAccepted($query)
    {
        return $query->where('accepted', 1);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}