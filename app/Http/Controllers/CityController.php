<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractControllers\CRUDController;
use App\Models\Cities;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\View;

class CityController extends CRUDController
{

    public $city_name;

    protected $module_name = 'App\Models\Cities';

    protected $view_folder_name = 'cities';

    protected $rules = array([
        'name' => 'required|string',
        'link' => 'required|string',
        'name_in' => 'required|string',
        'name_from' => 'required|string'
    ]);

    public function __construct()
    {
        parent::__construct();
    }

    static public function cityMetaInfo($name = NULL)
    {
        $date = Cities::getMetaInfo($name);

        View::share('meta', $date);
    }

    public function citesWithProviders()
    {
        return $this->module->getCityByProviders();
    }
}