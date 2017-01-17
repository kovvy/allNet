<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Providers extends Model implements ModuleInterface
{
    protected $table = 'providers';

    protected $fillable = [
        'name', 'title', 'logo', 'status', 'site', 'order', 'city'
    ];

    public $timestamps = false;

    public static function getIdProvider($name)
    {
        return ! empty($provider = Providers::where('name', $name)->first()) ? $provider->id : null;
    }

    public function getRandomProviders()
    {
        return self::orderByRaw('RAND()')->providers()->status()->paginate(18);
    }

    public function getAllProviders()
    {
        return self::orderBy('providers.id', 'asc')->providers()->status()->paginate(18);
    }

    public function getCityProvider($city)
    {
        return self::where('cities.link', $city)->orderBy('providers.id', 'asc')->providers()->status()->paginate(18);
    }

    public function getProvider($city, $provider)
    {
        return self::where(['providers.name' => $provider, 'cities.link' => $city])->providers()->first();
    }

    public function getBreadcrumbsProvider($city, $provider)
    {
        $bread = $this->getProvider($city, $provider);
        $bread['city'] = Cities::getCityByLink($city);

        return $bread;
    }

    public function similarProviders($city_id, $provider_id)
    {
        return self::where('providers.id', '<>', $provider_id)->where('providers.city', $city_id)->orderByRaw('RAND()')->providers()->take(3)->get();
    }

    public function searchProviders($connection, $region, $begin_cost, $end_cost, $begin_speed, $end_speed)
    {
        return self::join('cities', 'providers.city', '=', 'cities.id')
                        ->join('tarifs', 'providers.id', '=', 'tarifs.provider_id')
                        ->distinct('tarifs.provider_id')
                        ->where('providers.status', '1')
                        ->where('tarifs.speed', '>=', $begin_speed)
                        ->where('tarifs.speed', '<=', $end_speed)
                        ->where('tarifs.price', '>=', $begin_cost)
                        ->where('tarifs.speed', '<=', $end_cost)
                        ->connection($connection)
                        ->city($region)
                        ->take(30)
                        ->select('providers.*', 'providers.name as provider_name', 'cities.name', 'cities.link', 'cities.name_in', 'cities.name_from')->get();
    }


    public function scopeProviders($query)
    {
        return $query->join('cities', 'providers.city', '=', 'cities.id')
                    ->select('providers.*', 'providers.name as provider_name', 'cities.name', 'cities.link', 'cities.name_in', 'cities.name_from');
    }


    public function scopeConnection($query, $connection)
    {
        if($connection != 'any')
        {
            return $query->join('relations', 'providers.id', '=', 'relations.provider_id')
                            ->join('connection', 'relations.option_id', '=', 'connection.id')
                            ->where('relations.type', 'connection');
        }
    }


    public function scopeCity($query, $region)
    {
        if($region > 0)
        {
            return $query->where('providers.city', $region);
        }

    }

    public function scopeStatus($query)
    {
        return $query->where('providers.status', '1');
    }

    public function getAttributes()
    {
        return $this->fillable;
    }

    public function city()
    {
        return $this->belongsTo('App\Models\Cities');
    }
}
