<?php

namespace App\Http\Services\ConstantReferences;

use App\Models\ConstantReferences;

class Service
{
    public function getRate($temperature) {

        $rate = ConstantReferences::where('temperatureMin', '=', $temperature)
            ->where('temperatureMax', '=', $temperature)->get('rate');

        if (count($rate) === 0) {
            $rate = ConstantReferences::where('temperatureMin', '<=', $temperature)
                ->where('temperatureMax', '>', $temperature)->get('rate');
        }

        if (count($rate) === 0) {
            $rate = ConstantReferences::where('temperatureMin', '<=', $temperature)
                ->where('temperatureMax', '>=', $temperature)->get('rate');
        }

        return $rate[0];

    }

    public function checkErrorDiapason($temperature)
    {

        if($temperature < -20 || $temperature > 50 )  {
            return true;
        }

        return false;

    }
}
