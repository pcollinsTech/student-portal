<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property array|mixed character_declaration_details
 * @property array|mixed character_declarations
 * @property array|mixed health_declarations
 * @property mixed id
 */

class Registration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'payment_id',
        'character_declarations',
        'character_declaration_details',
        'health_declarations',
        'documents',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'character_declarations'            => 'array',
        'character_declaration_details'     => 'array',
        'health_declarations'               => 'array',
        'documents'                         => 'array'
    ];

    /**
     * Get the Student record associated with the Registration.
     */
    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function documents()
    {
        return $this->hasMany('App\Document');
    }
}
