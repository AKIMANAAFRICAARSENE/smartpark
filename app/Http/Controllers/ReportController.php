<?php

namespace App\Http\Controllers;

use App\Models\ServiceRecord;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function serviceRecords(Request $request)
    {
        $query = ServiceRecord::with(['car', 'service']);

        // Apply date filters
        if ($request->filled('start_date')) {
            $query->whereDate('service_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('service_date', '<=', $request->end_date);
        }

        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $serviceRecords = $query->latest()->paginate(10);

        // Calculate summary statistics
        $summary = [
            'total_records' => $query->count(),
            'total_amount' => $query->sum('amount'),
            'completion_rate' => $query->where('status', 'completed')->count() / max($query->count(), 1) * 100
        ];

        return view('reports.service-records', compact('serviceRecords', 'summary'));
    }

    public function revenue(Request $request)
    {
        // TODO: Implement revenue report
        return view('reports.revenue');
    }

    public function performance(Request $request)
    {
        // TODO: Implement performance report
        return view('reports.performance');
    }
} 