<?php

namespace App\Http\Controllers;

use App\Models\Water;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class WaterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $waters = Water::when($search, function ($query, $search) {
            $search = strtolower($search);

            if ($search === 'a' || $search === 'b') {
                return $query->where('pump_name', strtoupper($search));
            }

            return $query->where('pump_name', 'like', "%{$search}%")
                        ->orWhere('health_check', 'like', "%{$search}%")
                        ->orWhere('total_water_used', 'like', "%{$search}%");
        })
        ->orderBy('id', 'desc')
        ->paginate(10)
        ->appends(['search' => $search]); // preserves search term in pagination links

        return view('waters.index', compact('waters', 'search'));
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

    public function exportPdf(Request $request)
    {
        $waters = Water::orderBy('id', 'desc')->get();

        $pdf = Pdf::loadView('waters.pdf', compact('waters'))
                ->setPaper('a4', 'landscape');

        return $pdf->download('water-records.pdf');
    }
}
