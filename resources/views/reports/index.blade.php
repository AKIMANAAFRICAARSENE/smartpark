@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6">Reports</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Service Records Report -->
            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                <h3 class="text-lg font-semibold mb-4">Service Records Report</h3>
                <p class="text-gray-600 mb-4">Generate reports for service records with various filters.</p>
                <a href="{{ route('reports.service-records') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Generate Report
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 