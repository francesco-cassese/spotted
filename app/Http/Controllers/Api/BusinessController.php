<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index()
    {
        $businesses = Business::all();

        return response()->json([
            'success' => true,
            'data' => $businesses,
        ]);
    }

    public function show($slug)
    {
        $business = Business::with('category', 'distinctiveTraits')->where('slug', $slug)->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $business
        ]);
    }
}
