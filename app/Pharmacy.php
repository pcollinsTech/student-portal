<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pharmacy extends Model
{
    use Notifiable;

    public $guarded = [
        'id'
    ];   
    protected $casts = [
        'date_verified' => 'datetime'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class)
            ->using(PharmacyStudent::class);
    }
}
