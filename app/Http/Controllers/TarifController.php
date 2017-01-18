<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractControllers\CRUDController;
use Illuminate\Http\Request;
use App\Http\Requests;

class TarifController extends CRUDController
{

    protected $module_name = 'App\Models\Tarifs';

    protected $view_folder_name = 'tarifs';

    protected $rules = array([
        'speed' => 'required|string',
        'price' => 'required|string',
        'trafic' => 'required|string',
        'provider_id' => 'required|string'
    ]);

    public function __construct()
    {
        parent::__construct();
    }
}