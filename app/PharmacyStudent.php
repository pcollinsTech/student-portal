<?php

namespace App;

use App\Notifications\VerifyPharmacyStudent;
use Illuminate\Database\Eloquent\Relations\Pivot;


class PharmacyStudent extends Pivot
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // On creation - send email to pharmacy for verification
        static::created(function ($pharmacyStudent) {
            $pharmacyStudent->activation_code = \Str::random(60);
            $pharmacyStudent->save();
            $pharmacyStudent->pharmacy->notify(new VerifyPharmacyStudent($pharmacyStudent));
        });
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
    public function pharmacy() {
        return $this->belongsTo(Pharmacy::class);
    }
}
