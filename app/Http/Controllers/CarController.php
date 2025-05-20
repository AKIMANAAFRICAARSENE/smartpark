<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plate_number' => 'required|unique:cars',
            'type' => 'required',
            'model' => 'required',
            'manufacturing_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'driver_phone' => 'required',
            'mechanic_name' => 'required'
        ]);

        Car::create($validated);

        return redirect()->route('cars.index')
            ->with('success', 'Car registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'plate_number' => 'required|unique:cars,plate_number,' . $car->id,
            'type' => 'required',
            'model' => 'required',
            'manufacturing_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'driver_phone' => 'required',
            'mechanic_name' => 'required'
        ]);

        $car->update($validated);

        return redirect()->route('cars.index')
            ->with('success', 'Car information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('cars.index')
            ->with('success', 'Car record deleted successfully.');
    }
}
