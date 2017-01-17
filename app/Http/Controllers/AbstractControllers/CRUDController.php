<?php

namespace App\Http\Controllers\AbstractControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\View;

abstract class CRUDController extends Controller
{
    const VIEW_DIR = '/../resources/views/';

    protected $module;

    protected $module_name;

    protected $view_folder_name;

    protected $rules = array();

    public $route;

    public function __construct()
    {
        $this->instance($this->module_name,  $this->view_folder_name);
    }

    public function __get($name)
    {
        //TODO
    }

    public function __set($name)
    {
        //TODO
    }

    public function index()
    {
        $records = $this->module->all();

        View::share('records', $records);
//        return view($this->getView('index'), ['records' => $records]);
    }


    public function create()
    {
        return view($this->getView('create'));
    }


    public function store(Request $request, $fields = array())
    {
        $this->validateRequest($request);

        $attributes = $this->module->getAttributes();

        try {

            foreach ($request->request as $key => $value) {
                if (in_array($key, $attributes))
                {
                    $fields[$key] = $value;
                }
            }

            $this->module->create($fields);

        } catch (\Exception $e) {
            dd($e);
        }

        return Redirect::to($this->route['route']);

    }


    public function show($id)
    {
        $record = $this->module->find($id);

        if (!$record)
        {
            abort(404);
        }

        return view($this->getView('show'), ['record' => $record]);

    }


    public function edit($id)
    {
        $record = $this->module->find($id);

        if (!$record)
        {
            abort(404);
        }

        View::share('record', $record);
//        return view($this->getView('edit'), ['record' => $record]);

    }


    public function update(Request $request, $id)
    {
        $this->validateRequest($request);

        $fields = array();
        $record = $this->module->find($id);
        $attributes = $this->module->getAttributes();

        try {

            foreach ($request->request as $key => $value) {
                if (in_array($key, $attributes))
                {
                    $fields[$key] = $value;
                }
            }

            $record->update($fields);

        } catch (\Exception $e) {
            dd($e);
        }

        return Redirect::to($this->route['route']);
    }


    public function destroy($id)
    {
        $record = $this->module->find($id);
        $record->delete();

        return Redirect::to($this->route['route']);
    }

    protected function getView($action)
    {
        return $this->view_folder_name . '.' . $action;
    }

    protected function validateRequest(Request $request)
    {
        $this->validate($request, $this->rules);
    }

    private function instance($module_name, $view_folder_name)
    {
        $pathName = app()->make('path').self::VIEW_DIR. $view_folder_name . '/';

        if (!class_exists($module_name, true) OR !is_dir($pathName))
        {
            Log::error("Объект $module_name не сущиству или не была создана папка $view_folder_name");
            abort(503);
        }

        if ($route = explode('.', \Route::currentRouteName()))
        {
           $this->route = [
               'route' => $route[0],
               'action' => $route[1]
           ];
        }

        $this->module = new $module_name;
        $this->view_folder_name = $view_folder_name;

    }
}
