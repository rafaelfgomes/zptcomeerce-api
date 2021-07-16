<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all(): JsonResponse
    {
        return new JsonResponse(['data' => 'Ok']);
    }
}
