@extends('layouts.app')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Register New Car</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Enter the car details below.</p>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
        <form action="{{ route('cars.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="plate_number" class="block text-sm font-medium text-gray-700">Plate Number</label>
                    <input type="text" name="plate_number" id="plate_number" value="{{ old('plate_number') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    @error('plate_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                    <input type="text" name="type" id="type" value="{{ old('type') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                    <input type="text" name="model" id="model" value="{{ old('model') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    @error('model')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="manufacturing_year" class="block text-sm font-medium text-gray-700">Manufacturing Year</label>
                    <input type="number" name="manufacturing_year" id="manufacturing_year" value="{{ old('manufacturing_year') }}" min="1900" max="{{ date('Y') + 1 }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    @error('manufacturing_year')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="driver_phone" class="block text-sm font-medium text-gray-700">Driver Phone</label>
                    <input type="text" name="driver_phone" id="driver_phone" value="{{ old('driver_phone') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    @error('driver_phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="mechanic_name" class="block text-sm font-medium text-gray-700">Mechanic Name</label>
                    <input type="text" name="mechanic_name" id="mechanic_name" value="{{ old('mechanic_name') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    @error('mechanic_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('cars.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-3">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Register Car
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 