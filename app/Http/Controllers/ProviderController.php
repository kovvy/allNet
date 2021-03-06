<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractControllers\CRUDController;
use Illuminate\Http\Request;
use App\Http\Requests;

class ProviderController extends CRUDController
{

    protected $module_name = 'App\Models\Providers';

    protected $view_folder_name = 'providers';

    protected $rules = array([
        'name' => 'required|string',
        'title' => 'required|string',
        'status' => 'required|string',
        'site' => 'required|string'
    ]);

    public function __construct()
    {
        parent::__construct();
    }

    public function store(Request $request, $fields = array())
    {
        if ($image = $request->file('logo')){
            $filename = date('U') . '_' . str_random(6) . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/provider', $filename);
            $fields['logo'] = $filename;
        }

        parent::store($request, $fields);

    }

    public function provider($city_name = NULL, $provider_name = NULL)
    {
        if ($city_name OR $provider_name)
        {

            $provider = $this->module->getProvider($city_name, $provider_name);

        } else {

            $provider = $this->module->getRandomProviders();

        }

        if (!$provider)
        {
            abort(404);
        }

        return $provider;

    }

}
