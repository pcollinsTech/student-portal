<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pharmacist extends Model
{
    use Notifiable;

    protected $casts = [
        'date_verified' => 'datetime'
    ];

    public $guarded = [
        'id'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class)
            ->using(PharmacistStudent::class);
    }
}
