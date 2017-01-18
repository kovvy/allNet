<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractControllers\CRUDController;
use Illuminate\Http\Request;
use App\Http\Requests;

class ReviewController extends CRUDController
{

    protected $module_name = 'App\Models\Reviews';

    protected $view_folder_name = 'reviews';

    protected $rules = array([
        'provider_id' => 'string',
        'username' => 'required|string',
        'comment' => 'required|string',
        'ip' => 'required|string',
        'quality' => 'required|string',
        'speed' => 'required|string',
        'support' => 'required|string',
        'status' => 'required|string'
    ]);

    public function __construct()
    {
        parent::__construct();
    }
}