<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    public $guarded = [
        'id'
    ];   
    protected $casts = [
        'date_verified' => 'datetime'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
