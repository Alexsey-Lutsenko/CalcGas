<?php

namespace App\Http\Controllers\Constant;

use App\Http\Controllers\Controller;
use App\Models\Constant;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $priceDefault = Constant::where('name', 'priceDefault')->first();
        $calDefault = Constant::where('name', 'calDefault')->first();

        return response()->json(['data' =>  ['priceDefault' => $priceDefault, 'calDefault' => $calDefault]], 200);
    }
}
