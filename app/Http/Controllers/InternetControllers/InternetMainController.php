<?php

namespace App\Http\Controllers\InternetControllers;

use App\Models\Cities;
use App\Models\Providers;
use App\Models\Reviews;
use App\Models\Services;
use App\Models\Tarifs;
use Illuminate\Http\Request;
use App\Http\Controllers\AbstractControllers\BaseController;

use App\Http\Requests;

class InternetMainController extends BaseController
{
    public function index(Cities $cities, Providers $providers, Tarifs $tariffs, Services $services)
    {
        $providers = $providers->getRandomProviders();
        $cities = $cities->getCityByProviders();
        $services = $services->getServices();
        $speed = $tariffs->getSpeed();
        $price = $tariffs->getPrice();

        dd(Cities::getMetaInfo());

        return view('main', ['meta' => Cities::getMetaInfo(), 'providers' => $providers, 'cities' => $cities, 'services' => $services, 'speed' => $speed, 'price' => $price]);
    }

    public function allCityProviders(Cities $cities, Providers $providers)
    {
        $cities = $cities->getCityByProviders();
        $providers = $providers->getAllProviders();

        return view('city', ['meta' => Cities::getMetaInfo(), 'cities' => $cities, 'providers' => $providers]);
    }

    public function cityProviders($city, Cities $cities, Providers $providers)
    {
        $providers = $providers->getCityProvider($city);
        if(empty($providers))
        {
            abort(404);
        }
        $cities = $cities->getCityByProviders();

        return view('city', ['meta' => Cities::getMetaInfo($city), 'cities' => $cities, 'providers' => $providers, 'city' => Cities::getCityByLink($city)]);
    }

    public function provider($city_name, $provider_name, Providers $providers, Reviews $reviews)
    {
        $provider = $providers->getProvider($city_name, $provider_name);
        if(empty($provider))
        {
            abort(404);
        }
        $breadcrumbs = $providers->getBreadcrumbsProvider($city_name, $provider_name);
        $similar_providers = $providers->similarProviders($provider->city, $provider->id);
        dd($provider);

        return view('provider', ['meta' => Cities::getMetaInfo($city_name), 'provider' => $provider, 'breadcrumbs' => $breadcrumbs, 'tracks' => $reviews->tracksProvider($provider->id), 'similar_providers' => $similar_providers]);
    }

    public function searchProviders(Request $request, Providers $providers)
    {
        if ($request -> ajax())
        {
            $connection = $request->input('connection');
            $region_id = $request->input('region');
            $begin_cost = $request->input('begin_cost');
            $end_cost = $request->input('end_cost');
            $begin_speed = $request->input('begin_speed');
            $end_speed = $request->input('end_speed');

            $providers = $providers->searchProviders($connection, $region_id, $begin_cost, $end_cost, $begin_speed, $end_speed);

            return response() -> json($providers);
        }

        return false;
    }
}
