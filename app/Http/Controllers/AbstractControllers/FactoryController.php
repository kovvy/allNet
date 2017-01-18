<?php

namespace app\Http\Controllers\AbstractControllers;

use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\CityController;

class FactoryController
{

    public static function factory($name)
    {
        switch($name) {

            case 'provider' :
                return new ProviderController();
            break;

            case 'city' :
                return new CityController();
            break;

            case 'connection' :
                return new ConnectionController();
            break;

            case 'review' :
                return new ReviewController();
            break;

            case 'service' :
                return new ServiceController();
            break;

            case 'tarif' :
                return new TarifController();
            break;

            default:
                throw new \Exception('Нет такого объекта!', 503);
        }
    }

    public function getParam($param)
    {
        //TODO
    }

    public function setParam($param)
    {
        //TODO
    }
}