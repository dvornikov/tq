<?php

namespace Dvornikov\TQ;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'name',
        'email',
        'description'
    ];

    public function files()
    {
        return $this->hasMany('Dvornikov\TQ\File');
    }
}
