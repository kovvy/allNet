<?php

namespace app\Http\Controllers;

use App\Http\Controllers\AbstractControllers\CRUDController;
use Illuminate\Http\Request;
use App\Http\Requests;

class ServiceController extends CRUDController
{

    protected $module_name = 'App\Models\Services';

    protected $view_folder_name = 'services';

    protected $rules = array([
        'title' => 'required|string'
    ]);

    public function __construct()
    {
        parent::__construct();
    }

}