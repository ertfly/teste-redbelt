<?php

namespace App\Http\Controllers;

use App\Libraries\Input;
use Laravel\Lumen\Routing\Controller as BaseController;

class LocationController extends BaseController
{
    public function change()
    {
        $lat = Input::json('lat');
        $lng = Input::json('lng');

        if ($lat && $lng) {
            $sid = request()->sid;
            $sid->lat = doubleval($lat);
            $sid->lng = doubleval($lng);
            $sid->save();
        }
    }
}
