<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacist extends Model
{
    protected $casts = [
        'date_verified' => 'datetime'
    ];

    public $guarded = [
        'id'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
