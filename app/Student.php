<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
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
        'country',
        'phone_mobile',
        'phone_home',
        'date_of_birth',
        'university_id',
        'entry_date',
        'previous_training',
        'previous_training_details',
        'terms',
    ];

    protected $casts = [
        'date_of_birth' => 'datetime',
        'entry_date' => 'datetime'
    ];

    /**
     * Get the Registration record associated with the Student.
     */
    public function registration()
    {
        return $this->belongsTo('App\Registration')->first();
    }

    /**
     * Get the User record associated with the Student.
     */
    public function user()
    {
        return $this->belongsTo('App\User')->first();
    }
    
    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class);
    }
    public function pharmacists()
    {
        return $this->belongsToMany(Pharmacist::class);
    }
}
