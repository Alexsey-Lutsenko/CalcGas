<?php

namespace App\Http\Controllers\ConstantReferences;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConstantReferences\ConstantReferenceResource;
use App\Models\ConstantReferences;
use Illuminate\Http\Request;

class GetTableController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $table = ConstantReferences::orderBy('id', 'ASC')->get();

        return ConstantReferenceResource::collection($table);
    }
}
