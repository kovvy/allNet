<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model implements ModuleInterface
{
    protected $table = 'cities';

    protected $fillable = [
        'name', 'link', 'name_in', 'name_from'
    ];

    public static function getIdCity($link)
    {
        return ! empty($city = self::where('link', $link)->first()) ? $city->id : null;
    }
    
    static public function getMetaInfo($name = NULL)
    {
        if($name === NULL)
        {
            return new self([
                'name' => "Украина",
                'name_in' => "в Украине",
                "name_from" => "Украины"
            ]);
        }

        return self::where('link', $name)->first();
    }

    public function getCityByProviders()
    {
        return self::join('providers', 'cities.id', '=', 'providers.city')
                    ->distinct()
                    ->orderBy('cities.name', 'asc')
                    ->select('cities.id as id', 'cities.name as name', 'cities.name_in as name_in', 'cities.link as link')
                    ->get();
    }

    public static function getCityByLink($link)
    {
        return self::where('link', $link)->first();
    }

    public function providers()
    {
        return $this->hasMany('App\Models\Providers', 'city');
    }

    public function getAttributes()
    {
        return $this->fillable;
    }
}
