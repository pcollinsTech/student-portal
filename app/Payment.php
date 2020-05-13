<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // Relation payment with other entities

    public function entity()
    {
        return $this->morphTo();
    }
}
