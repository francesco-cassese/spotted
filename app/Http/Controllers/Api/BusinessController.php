<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    public function index()
    {
        $businesses = Business::all()->map(function ($business) {
            $business->cover_image_url = $business->cover_image
                ? Storage::url($business->cover_image)
                : null;
            return $business;
        });

        return response()->json([
            'success' => true,
            'data' => $businesses,
        ]);
    }

    public function show($slug)
    {
        $business = Business::with('category', 'distinctiveTraits')->where('slug', $slug)->firstOrFail();

        $business->cover_image_url = $business->cover_image
            ? Storage::url($business->cover_image)
            : null;

        return response()->json([
            'success' => true,
            'data' => $business
        ]);
    }
}
