<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class HealthController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'OK']);
    }
}
