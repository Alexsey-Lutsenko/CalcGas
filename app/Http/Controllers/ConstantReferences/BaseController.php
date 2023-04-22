<?php

namespace App\Http\Controllers\ConstantReferences;

use App\Http\Controllers\Controller;
use App\Http\Services\ConstantReferences\Service;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
