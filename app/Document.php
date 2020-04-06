<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    protected $fillable = [
        'registration_id',
        'file_path',
        'file_type',
        'file_status',
    ];

    public function registration()
    {
        return $this->belongsTo("App\Registration");
    }
}
