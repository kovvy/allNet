<?php

namespace App\Http\Controllers\AbstractControllers;

use App\Http\Controllers\AbstractControllers\FactoryController as Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

abstract class BaseController extends Controller
{
    protected function instanceObj($nameObject)
    {
        return Factory::factory($nameObject);
    }
}
