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
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $search = $request->input('search');

        $waters = Water::when($search, function ($query, $search) {
            $search = strtolower($search);

            return $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(pump_name) like ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(health_check) like ?', ["%{$search}%"]);
            });
        })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('waters.index', compact('waters', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        return view('waters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'pump_name' => 'required|string|max:255',
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
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        return view('waters.show', compact('water'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Water $water)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        return view('waters.edit', compact('water'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Water $water)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'pump_name' => 'required|string|max:255',
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
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $water->delete();
        return redirect()->route('waters.index');
    }

    public function exportPdf(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $waters = Water::orderBy('id', 'desc')->get();

        // Pass the logged-in user as 'account'
        $account = auth()->user();

        $pdf = Pdf::loadView('waters.pdf', compact('waters', 'account'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('water-records.pdf');
    }
}
