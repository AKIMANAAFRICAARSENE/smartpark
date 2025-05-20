@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Service Records Report</h2>
            <div class="flex space-x-4">
                <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Print Report
                </button>
                <a href="{{ route('reports.index') }}" class="text-blue-600 hover:text-blue-800">
                    Back to Reports
                </a>
            </div>
        </div>

        <!-- Print Header (hidden by default) -->
        <div class="hidden print:block mb-8">
            <h1 class="text-3xl font-bold text-center">Service Records Report</h1>
            <p class="text-center text-gray-600 mt-2">
                Generated on {{ now()->format('F d, Y') }}
            </p>
            @if(request('start_date') || request('end_date') || request('status'))
                <div class="text-center text-gray-600 mt-2">
                    <p>Filters:</p>
                    @if(request('start_date'))
                        <p>From: {{ \Carbon\Carbon::parse(request('start_date'))->format('M d, Y') }}</p>
                    @endif
                    @if(request('end_date'))
                        <p>To: {{ \Carbon\Carbon::parse(request('end_date'))->format('M d, Y') }}</p>
                    @endif
                    @if(request('status'))
                        <p>Status: {{ ucfirst(request('status')) }}</p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Filters -->
        <form method="GET" action="{{ route('reports.service-records') }}" class="mb-6 p-6 bg-gray-50 rounded-lg border border-gray-200 print:hidden">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                    <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                        class="mt-1 block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                    <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                        class="mt-1 block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full inline-flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Apply Filters
                    </button>
                </div>
            </div>
        </form>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 print:grid-cols-3">
            <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-200">
                <div class="px-6 py-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Records</dt>
                    <dd class="mt-2 text-3xl font-semibold text-gray-900">{{ $summary['total_records'] }}</dd>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-200">
                <div class="px-6 py-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Amount</dt>
                    <dd class="mt-2 text-3xl font-semibold text-gray-900">RWF {{ number_format($summary['total_amount'], 0) }}</dd>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-200">
                <div class="px-6 py-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Completion Rate</dt>
                    <dd class="mt-2 text-3xl font-semibold text-gray-900">{{ number_format($summary['completion_rate'], 1) }}%</dd>
                </div>
            </div>
        </div>

        <!-- Report Table -->
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Car</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($serviceRecords as $record)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $record->service_date->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $record->car->plate_number }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $record->service->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                RWF {{ number_format($record->amount, 0) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $record->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($record->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $record->notes }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 print:hidden">
            {{ $serviceRecords->links() }}
        </div>
    </div>
</div>

@push('styles')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .container, .container * {
            visibility: visible;
        }
        .container {
            position: absolute;
            left: 0;
            top: 0;
        }
        .print\:hidden {
            display: none !important;
        }
        .print\:block {
            display: block !important;
        }
        .print\:grid-cols-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
        }
    }
</style>
@endpush
@endsection 