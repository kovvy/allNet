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
    
    public static function getMetaInfo($name = NULL)
    {
        if($name === NULL)
        {
            return self::where('name', 'Украина')->first();
        }

        return self::where('link', $name)->first();
    }

    public function getCityByProviders()
    {
        $city['city'] = self::join('providers', 'cities.id', '=', 'providers.city')
                            ->distinct()
                            ->orderBy('cities.name', 'asc')
                            ->select('cities.id as id', 'cities.name as name', 'cities.name_in as name_in', 'cities.link as link')->get();

        $city['regions'][0] = 'Вся Украина';
        foreach ($city['city'] as $value) {
            $city['regions'][$value->id] = $value->name;
        }

        return $city;
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
