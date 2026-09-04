<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Category;
use App\Models\DistinctiveTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businesses = Business::all();
        $category = Category::all();

        return view('admin.businesses.index', compact('businesses', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $distinctiveTraits = DistinctiveTrait::all();

        return view('admin.businesses.create', compact('categories', 'distinctiveTraits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'story' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'distinctive_traits' => 'nullable|array',
            'distinctive_traits.*' => 'exists:distinctive_traits,id',
        ]);

        if (array_key_exists('cover_image', $data) && $data['cover_image']) {
            $data['cover_image'] = Storage::putFile('businesses', $data['cover_image']);
        }

        $newBusiness = new Business();
        $newBusiness->name = $data['name'];
        $newBusiness->slug = Str::slug($data['name']);
        $newBusiness->story = $data['story'];
        $newBusiness->address = $data['address'];
        $newBusiness->contact = $data['contact'];
        $newBusiness->cover_image = $data['cover_image'] ?? null;
        $newBusiness->category_id = $data['category_id'];
        $newBusiness->save();

        $newBusiness->distinctiveTraits()->attach($data['distinctive_traits']);

        return redirect()->route('businesses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        $categories = Category::all();
        $distinctiveTraits = DistinctiveTrait::all();

        return view('admin.businesses.edit', compact('business', 'categories', 'distinctiveTraits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Business $business)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'story' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'distinctive_traits' => 'nullable|array',
            'distinctive_traits.*' => 'exists:distinctive_traits,id',
        ]);

        if (array_key_exists('cover_image', $data) && $data['cover_image']) {
            $data['cover_image'] = Storage::putFile('businesses', $data['cover_image']);
        }

        $business->name = $data['name'];
        $business->slug = Str::slug($data['name']);
        $business->story = $data['story'];
        $business->address = $data['address'];
        $business->contact = $data['contact'];
        $business->cover_image = $data['cover_image'] ?? $business->cover_image;
        $business->category_id = $data['category_id'];
        $business->save();

        if ($request->has('distinctive_traits')) {
            $business->distinctiveTraits()->sync($data['distinctive_traits']);
        }

        return redirect()->route('businesses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        if ($business->cover_image) {
            Storage::delete($business->cover_image);
        }

        $business->delete();

        return redirect()->route('businesses.index');
    }
}
