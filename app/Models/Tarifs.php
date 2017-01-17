<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarifs extends Model
{
    protected $table = 'tarifs';

    protected $fillable = [
        'provider_id', 'speed', 'price', 'trafic'
    ];

    public function getSpeed()
    {
        $speed['maxspeed'] = self::max('speed');
        $speed['minspeed'] = self::min('speed');

        return $speed;
    }

    public function getPrice()
    {
        $price['maxprice'] = self::max('price');
        $price['minprice'] = self::min('price');

        return $price;
    }

    public function minMax()
    {
        
    }
}
