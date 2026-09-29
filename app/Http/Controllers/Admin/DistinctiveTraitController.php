<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DistinctiveTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DistinctiveTraitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $distinctiveTraits = DistinctiveTrait::all();

        return view('admin.distinctive-traits.index', compact('distinctiveTraits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.distinctive-traits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:distinctive_traits,name',
        ]);

        $newDistinctiveTrait = new DistinctiveTrait();
        $newDistinctiveTrait->name = $data['name'];
        $newDistinctiveTrait->save();

        return redirect()->route('distinctive-traits.index')->with('success', "Tratto distintivo: $newDistinctiveTrait->name aggiunto con successo.");
    }

    /**
     * Display the specified resource.
     */
    public function show(DistinctiveTrait $distinctiveTrait)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DistinctiveTrait $distinctiveTrait)
    {
        return view('admin.distinctive-traits.edit', compact('distinctiveTrait'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DistinctiveTrait $distinctiveTrait)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('distinctive_traits', 'name')->ignore($distinctiveTrait->id)],
        ]);

        $distinctiveTrait->name = $data['name'];
        $distinctiveTrait->save();

        return redirect()->route('distinctive-traits.index')->with('success', "Tratto distintivo: $distinctiveTrait->name modificato con successo.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DistinctiveTrait $distinctiveTrait)
    {
        $distinctiveTrait->delete();

        return redirect()->route('distinctive-traits.index')->with('success', "Tratto distintivo: $distinctiveTrait->name eliminato con successo.");
    }
}
