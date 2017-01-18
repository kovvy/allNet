<?php

namespace App\Http\Controllers\InternetControllers;

use App\Models\Cities;
use App\Models\Providers;
use App\Models\Reviews;
use App\Models\Services;
use App\Models\Tarifs;
use Illuminate\Http\Request;
use App\Http\Controllers\AbstractControllers\BaseController;
use App\Http\Controllers\CityController;


use App\Http\Requests;

class MainController extends BaseController
{
    public function __construct()
    {
        CityController::cityMetaInfo();
    }

    public function index(Tarifs $tariffs, Services $services)
    {
        $providers = $this->instanceObj('provider')->provider();
        $cities = $this->instanceObj('city')->citesWithProviders();
        $services = $services->getServices();
        $speed = $tariffs->getSpeed();
        $price = $tariffs->getPrice();

        return view('internet.main', ['providers' => $providers, 'cities' => $cities, 'services' => $services, 'speed' => $speed, 'price' => $price]);
    }

    public function allCityProviders()
    {
        $cities = $this->instanceObj('city')->citesWithProviders();
        $providers = $this->instanceObj('provider')->provider();

        return view('internet.city', ['cities' => $cities, 'providers' => $providers]);
    }

    public function cityProviders($city)
    {
        CityController::cityMetaInfo($city);

        $providers = $this->instanceObj('provider')->provider();
        $cities = $this->instanceObj('city')->citesWithProviders();

        return view('internet.city', ['cities' => $cities, 'providers' => $providers, 'city' => Cities::getCityByLink($city)]);
    }

    public function provider($city_name, $provider_name, Providers $providers, Reviews $reviews)
    {
        CityController::cityMetaInfo($city_name);

        $provider = $this->instanceObj('provider')->provider($city_name, $provider_name);
        $breadcrumbs = $providers->getBreadcrumbsProvider($city_name, $provider_name);
        $similar_providers = $providers->similarProviders($provider->city, $provider->id);

        return view('internet.provider', ['provider' => $provider, 'breadcrumbs' => $breadcrumbs, 'tracks' => $reviews->tracksProvider($provider->id), 'similar_providers' => $similar_providers]);
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
