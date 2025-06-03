@extends('layouts.app')

@section('content')
<div class="py-12 bg-[#D4EDDA] min-h-screen"> <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-semibold text-3xl text-[#1A6A61] leading-tight"> Field: {{ $field->name }}
                </h2>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-[#4CAF50] hover:bg-[#1A6A61] transition duration-300">
                    Back to Dashboard
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    @if ($field->photo_path)
                        <img src="{{ asset('storage/' . $field->photo_path) }}" alt="Field Photo for {{ $field->name }}" class="w-full h-auto rounded-lg shadow-md mb-4 object-cover max-h-96">
                    @else
                        <div class="w-full h-64 bg-gray-200 rounded-lg shadow-md flex items-center justify-center text-gray-500 mb-4">
                            No Photo Available
                        </div>
                    @endif

                    <div class="bg-[#F9FAFB] p-4 rounded-lg shadow-sm border border-[#D4EDDA]"> <h3 class="text-xl font-bold text-[#1A6A61] mb-3">Field Details</h3>
                        <p class="text-[#333333] mb-1"><strong class="text-[#1A6A61]">Name:</strong> {{ $field->name }}</p>
                        <p class="text-[#333333] mb-1"><strong class="text-[#1A6A61]">Size:</strong> {{ $field->size }} acres</p>
                        <p class="text-[#333333] mb-1"><strong class="text-[#1A6A61]">Registered On:</strong> {{ $field->created_at->format('M d, Y H:i') }}</p>
                        <p class="text-[#333333] mb-1"><strong class="text-[#1A6A61]">Last Updated:</strong> {{ $field->updated_at->format('M d, Y H:i') }}</p>
                        @if ($field->location)
                            @php
                                // Assuming location attribute returns an object with lng and lat
                                $locationData = $field->location;
                            @endphp
                            @if ($locationData && isset($locationData->lat) && isset($locationData->lng))
                                <p class="text-[#333333] mb-1"><strong class="text-[#1A6A61]">Latitude:</strong> {{ number_format($locationData->lat, 6) }}</p>
                                <p class="text-[#333333] mb-1"><strong class="text-[#1A6A61]">Longitude:</strong> {{ number_format($locationData->lng, 6) }}</p>
                                <p class="text-sm text-gray-500 mt-2">Location extracted from photo EXIF data.</p>
                            @else
                                <p class="text-[#333333] mb-1"><strong class="text-[#1A6A61]">Location:</strong> Not available or invalid format.</p>
                            @endif
                        @endif
                        <p class="text-[#333333] mt-3"><strong class="text-[#1A6A61]">Notes:</strong> {{ $field->notes ?? 'No detailed notes.' }}</p>
                    </div>
                </div>

                <div>
                    <div class="bg-[#F9FAFB] p-4 rounded-lg shadow-sm border border-[#D4EDDA] mb-6"> <h3 class="text-xl font-bold text-[#1A6A61] mb-3">Latest Algaeo Insights & Recommendations</h3>
                        <p class="text-[#333333] mb-2">Based on your recent photo uploads, here are our latest findings and recommendations for {{ $field->name }}:</p>
                        <ul class="list-disc list-inside text-[#333333] space-y-2">
                            <li><strong class="text-[#4CAF50]">Nutrient Deficiency:</strong> Detected low Nitrogen levels.</li>
                            <li><strong class="text-[#4CAF50]">Soil Health:</strong> Moderate microbial activity observed.</li>
                            <li><strong class="text-[#4CAF50]">Recommendation:</strong> Apply Algaeo's N-Fix Consortia (Product X) at 5 gallons/acre within the next 7 days.</li>
                            <li><strong class="text-[#4CAF50]">Action:</strong> Consider a follow-up photo in 2 weeks to monitor progress.</li>
                        </ul>
                        <p class="text-sm text-gray-500 mt-4">Last updated: {{ now()->format('M d, Y H:i') }} (Placeholder)</p>
                    </div>

                    <div class="bg-[#F9FAFB] p-4 rounded-lg shadow-sm border border-[#D4EDDA]"> <h3 class="text-xl font-bold text-[#1A6A61] mb-3">Previous Recommendations History</h3>
                        <p class="text-[#333333] mb-2">Here's a log of past recommendations and their outcomes:</p>
                        <ul class="list-disc list-inside text-[#333333] space-y-2">
                            <li><strong class="text-[#1A6A61]">2025-05-15:</strong> Recommendation for Phosphorus deficiency. Applied Algaeo P-Boost. Status: <span class="text-[#4CAF50]">Improved</span></li>
                            <li><strong class="text-[#1A6A61]">2025-04-01:</strong> Recommendation for soil compaction. Applied Algaeo Soil Aerator. Status: <span class="text-orange-500">Monitoring</span></li>
                            <li><strong class="text-[#1A6A61]">2025-03-10:</strong> Initial baseline assessment. Status: <span class="text-gray-500">Completed</span></li>
                        </ul>
                        <p class="text-sm text-gray-500 mt-4">Note: This section is currently populated with sample data. Actual data would come from your database.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
