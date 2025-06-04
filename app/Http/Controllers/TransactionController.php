<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Water;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $transactions = Transaction::with(['water', 'supplier'])
            ->when(auth()->user()->role !== 'admin', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->when($search, function ($query, $search) {
                $query->whereHas('water', function ($q) use ($search) {
                    $q->where('pump_name', 'like', "%$search%");
                })->orWhereHas('supplier', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
            })
            ->orderBy('transaction_date', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('transactions.index', compact('transactions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $waters = Water::all();
        $suppliers = Supplier::all();
        return view('transactions.create', compact('waters', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'water_id' => 'required|exists:waters,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'transaction_date' => 'required|date',
            'total_water_used' => 'required|numeric|min:0',
        ]);

        // Assign to the currently logged-in user
        $validated['user_id'] = auth()->id();

        Transaction::create($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaction saved.');
    }

    /**
     * Export PDF for transactions.
     */
    public function exportPdf()
    {
        $transactions = Transaction::with(['water', 'supplier'])
            ->when(auth()->user()->role !== 'admin', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->orderBy('id', 'desc')
            ->get();

        $account = auth()->user();  // current logged-in user info

        $pdf = Pdf::loadView('transactions.pdf', compact('transactions', 'account'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('transaction-records.pdf');
    }

    // You can also include role protection in edit/update/delete if needed

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        if (auth()->user()->role !== 'admin' && $transaction->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $waters = Water::all();
        $suppliers = Supplier::all();

        return view('transactions.edit', compact('transaction', 'waters', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        if (auth()->user()->role !== 'admin' && $transaction->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'water_id' => 'required|exists:waters,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'transaction_date' => 'required|date',
            'total_water_used' => 'required|numeric|min:0',
        ]);

        $transaction->update($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        if (auth()->user()->role !== 'admin' && $transaction->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted.');
    }
}
