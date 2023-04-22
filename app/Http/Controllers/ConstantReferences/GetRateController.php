<?php

namespace App\Http\Controllers\ConstantReferences;

use App\Http\Controllers\Controller;
use App\Models\ConstantReferences;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class GetRateController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $temperature = $request->query('temperature');

        $isErrorDiapason = $this->service->checkErrorDiapason($temperature);

        if ($isErrorDiapason) {
            return response()->json(['data' => ['error' => 'Значение температуры вне диапазона (-20° до 50°)']], 404);
        }

        $rate= $this->service->getRate($temperature);

        return response()->json(['data' =>  $rate], 200);
    }
}
