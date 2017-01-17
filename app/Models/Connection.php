<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model implements ModuleInterface
{
    protected $table = 'connection';

    protected $fillable = [
        'type',
    ];

    public function getAttributes()
    {
        return $this->fillable;
    }
}
