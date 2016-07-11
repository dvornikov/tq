<?php

namespace Dvornikov\TQ;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'filename'
    ];
    public function ticket()
    {
        return $this->belongsTo('Dvornikov\TQ\File');
    }
}
