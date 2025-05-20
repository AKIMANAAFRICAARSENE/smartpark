<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Service;
use App\Models\ServiceRecord;
use Illuminate\Http\Request;

class ServiceRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceRecords = ServiceRecord::with(['car', 'service'])
            ->latest()
            ->paginate(10);
        
        $cars = Car::all();
        $services = Service::all();
        
        return view('service-records.index', compact('serviceRecords', 'cars', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars = Car::all();
        $services = Service::all();
        return view('service-records.create', compact('cars', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'service_id' => 'required|exists:services,id',
            'service_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed',
            'notes' => 'nullable|string'
        ]);

        ServiceRecord::create($validated);

        return redirect()->route('service-records.index')
            ->with('success', 'Service record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceRecord $serviceRecord)
    {
        $serviceRecord->load(['car', 'service']);
        return view('service-records.show', compact('serviceRecord'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceRecord $serviceRecord)
    {
        $cars = Car::all();
        $services = Service::all();
        return view('service-records.edit', compact('serviceRecord', 'cars', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceRecord $serviceRecord)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'service_id' => 'required|exists:services,id',
            'service_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed',
            'notes' => 'nullable|string'
        ]);

        $serviceRecord->update($validated);

        return redirect()->route('service-records.index')
            ->with('success', 'Service record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceRecord $serviceRecord)
    {
        $serviceRecord->delete();

        return redirect()->route('service-records.index')
            ->with('success', 'Service record deleted successfully.');
    }
}
