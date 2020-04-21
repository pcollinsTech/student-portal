<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\ModelStatus\HasStatuses;

class User extends Authenticatable
{
    use Notifiable, HasStatuses;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Set the user's name as not required.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return 'not required';
    }

    /**
     * Set the user's is_admin as not required.
     *
     * @return boolean
     */
    public function getIsAdminAttribute()
    {
        if($this->type == 'admin') {
            return true;
        }
        return false;
    }

    /**
     * Get the Student record associated with the User.
     */
    public function student()
    {
        return $this->hasOne('App\Student');
    }
}
