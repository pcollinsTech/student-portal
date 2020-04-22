<?php

namespace App;

use App\Notifications\VerifyPharmacistStudent;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PharmacistStudent extends Pivot
{
    protected $casts = [
        'tutor_end' => 'datetime',
        'tutor_start' => 'datetime'
    ];
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // On creation - send email to pharmacy for verification
        // static::created(function ($pharmacistStudent) {
        //     $pharmacistStudent->activation_code = \Str::random(60);
        //     $pharmacistStudent->save();
        //     $pharmacistStudent->pharmacist->notify(new VerifyPharmacistStudent($pharmacistStudent));
        // });
    }

    /**
     * Register Student Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function student() {
        return $this->belongsTo(Student::class);
    }

    /**
     * Register Pharmacy Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pharmacist() {
        return $this->belongsTo(Pharmacist::class);
    }
}
