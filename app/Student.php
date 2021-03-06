<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{


    /* 
            'previous_training',
        'previous_training_details',
         */


    protected $guarded = ['country', 'previous_training', 'previous_training_details'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'pharmacy_id',
        'pharmacist_id',
        'registration_id',
        'title',
        'forenames',
        'surname',
        'known_as',
        'previous_name',
        'home_address_1',
        'home_address_2',
        'city',
        'county',
        'postcode',
        'phone_mobile',
        'phone_home',
        'date_of_birth',
        'university_id',
        'entry_date',
        'completion_date',
        'terms',
    ];

    protected $casts = [
        'date_of_birth' => 'datetime',
        'entry_date' => 'datetime',
        'completion_date' => 'datetime',
        'terms' => 'json'
    ];

    /**
     * Get the Registration record associated with the Student.
     */
    public function registration()
    {
        return $this->hasOne('App\Registration');
    }


    /**
     * Get the Registration record associated with the Student.
     */
    public function documents()
    {
        return $this->hasOne('App\Registration')->first()->documents();
    }


    /**
     * Get the User record associated with the Student.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class)
            ->withPivot(['activation_code', 'active', 'placement_start', 'placement_end'])
            ->using(PharmacyStudent::class);
    }

    public function pharmacists()
    {
        return $this->belongsToMany(Pharmacist::class)
            ->withPivot(['activation_code', 'active', 'tutor_start', 'tutor_end'])
            ->using(PharmacistStudent::class);
    }
}
