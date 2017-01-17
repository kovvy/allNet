<?php

namespace app\Http\Controllers;

use App\Http\Controllers\AbstractControllers\CRUDController;
use Illuminate\Http\Request;
use App\Http\Requests;

class ConnectionController extends CRUDController
{

    protected $module_name = 'App\Models\Connection';

    protected $view_folder_name = 'connection';

    protected $rules = array([
        'type' => 'required|string'
    ]);

    public function __construct()
    {
        parent::__construct();
    }
}