<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model implements ModuleInterface
{
    protected $table = 'services';

    public function getServices()
    {
//        $services['any'] = 'Любое';
//        foreach (self::get() as $value) {
//            $services[$value->id] = $value->title;
//        }

        return self::all();
    }

    public function getAttributes()
    {
        return $this->fillable;
    }

}
