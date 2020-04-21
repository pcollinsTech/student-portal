<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    public $guarded = [
        'id'
    ];

    public function students() {
        return $this->belongsToMany(Student::class);
    }
}
