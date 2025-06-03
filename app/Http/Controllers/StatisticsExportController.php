<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Water;
use App\Models\Supplier;
use App\Models\Transaction;
use PDF; // import DomPDF facade

class StatisticsExportController extends Controller
{
    public function exportPDF()
    {
        $totalWaters = Water::count();
        $totalSuppliers = Supplier::count();
        $totalTransactions = Transaction::count();

        $waterUsage = Transaction::select('water_id', \DB::raw('SUM(total_water_used) as total'))
                                  ->groupBy('water_id')
                                  ->with('water')
                                  ->get();

        $supplierUsage = Transaction::select('supplier_id', \DB::raw('SUM(total_water_used) as total'))
                                    ->groupBy('supplier_id')
                                    ->with('supplier')
                                    ->get();

        $pdf = PDF::loadView('statistics-pdf', compact(
            'totalWaters',
            'totalSuppliers',
            'totalTransactions',
            'waterUsage',
            'supplierUsage'
        ));

        return $pdf->download('statistics.pdf');
    }
}

