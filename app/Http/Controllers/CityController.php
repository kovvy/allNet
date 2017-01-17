<?php

namespace app\Http\Controllers;

use App\Http\Controllers\AbstractControllers\CRUDController;
use Illuminate\Http\Request;
use App\Http\Requests;

class CityController extends CRUDController
{

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
}