<?php

namespace App\Http\Controllers;

use App\Models\Water;
use Illuminate\Http\Request;

class WaterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $waters = Water::orderBy('id', 'desc')->paginate(10);
        return view('waters.index', compact('waters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('waters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pump_name' => 'required|string|max:255',
            'total_water_used' => 'required|numeric',
            'last_maintenance' => 'required|date',
            'health_check' => 'required|in:Normal,Warning',
        ]);

        Water::create($request->all());

        return redirect()->route('waters.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Water $water)
    {
        return view('waters.show', compact('water'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Water $water)
    {
        return view('waters.edit', compact('water'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Water $water)
    {
        $request->validate([
            'pump_name' => 'required|string|max:255',
            'total_water_used' => 'required|numeric',
            'last_maintenance' => 'required|date',
            'health_check' => 'required|in:Normal,Warning',
        ]);

        $water->update($request->all());

        return redirect()->route('waters.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Water $water)
    {
        $water->delete();
        return redirect()->route('waters.index');
    }
}
