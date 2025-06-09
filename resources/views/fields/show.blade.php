<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Field Details') }}
        </h2>
    </x-slot>

    @section('content')
    <div class="py-12 bg-[#F9FAFB] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-4xl sm:text-5xl font-extrabold text-[#1A6A61] mb-6 text-center">{{ $field->name ?? 'Field Name Not Available' }}</h1>
                <p class="text-lg text-[#333333] mb-10 text-center max-w-2xl mx-auto">
                    Detailed information and insights for your field.
                </p>

                {{-- Main grid for layout --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">

                    {{-- Column 1: Field Photo and Main Details (Collapsible) --}}
                    <div>
                        @if($field->photo_url)
                            <div class="mb-6">
                                <img src="{{ $field->photo_url }}" alt="{{ $field->name ?? 'Field Photo' }}" class="w-full h-64 object-cover rounded-lg shadow-md">
                            </div>
                        @else
                            <div class="mb-6">
                                <img src="https://placehold.co/600x300/1A6A61/D4EDDA?text=No+Photo" alt="No Photo" class="w-full h-64 object-cover rounded-lg shadow-md">
                            </div>
                        @endif

                        <div class="bg-[#F9FAFB] p-6 rounded-lg shadow-sm border border-[#D4EDDA] flex flex-col">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-bold text-[#1A6A61]">Field Information</h3>
                                <button type="button" onclick="toggleVisibility('fieldInfoContent')"
                                        class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                                    <svg class="h-6 w-6" id="toggleIcon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </div>
                            <div id="fieldInfoContent" class="space-y-3 text-lg text-gray-700 transition-all duration-300 ease-in-out overflow-hidden" style="max-height: 500px;">
                                <p><strong>Type:</strong> {{ $field->type ?? 'N/A' }}</p>
                                <p><strong>Crops/Plants Grown:</strong> {{ $field->crops_grown ?? 'N/A' }}</p>
                                <p><strong>Size:</strong> {{ $field->size ?? 'N/A' }}</p>
                                <p><strong>Notes:</strong> {{ $field->notes ?? 'N/A' }}</p>
                                <p><strong>Registered On:</strong> {{ $field->created_at ? $field->created_at->format('M d, Y H:i') : 'N/A' }}</p>
                                <p><strong>Last Updated:</strong> {{ $field->updated_at ? $field->updated_at->format('M d, Y H:i') : 'N/A' }}</p>

                                <p class="text-[#333333]">
                                    <strong class="text-[#1A6A61]">Location:</strong>
                                    @if ($field->location)
                                        @php
                                            // Split the "lat, lng" string into an array
                                            $coords = explode(',', $field->location);
                                            $lat = trim($coords[0] ?? '');
                                            $lng = trim($coords[1] ?? '');
                                        @endphp
                                        @if (!empty($lat) && !empty($lng))
                                            Latitude: {{ number_format((float)$lat, 6) }}<br>
                                            Longitude: {{ number_format((float)$lng, 6) }}
                                            <span class="text-sm text-gray-500">(from database)</span>
                                        @else
                                            Not available (Invalid format).
                                        @endif
                                    @else
                                        Not available.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Column 2: Latest Algaeo Insights & Recommendations --}}
                    <div class="bg-[#F9FAFB] p-6 rounded-lg shadow-sm border border-[#D4EDDA] flex flex-col">
                        <h3 class="text-xl font-bold text-[#1A6A61] mb-4">Latest Algaeo Insights & Recommendations</h3>
                        <p class="text-[#333333] mb-4">Based on your recent photo uploads, here are our latest findings and recommendations for {{ $field->name ?? 'this field' }}:</p>
                        <ul class="list-disc list-inside text-[#333333] space-y-2 flex-grow">
                            <li><strong class="text-[#4CAF50]">Nutrient Deficiency:</strong> Detected low Nitrogen levels.</li>
                            <li><strong class="text-[#4CAF50]">Soil Health:</strong> Moderate microbial activity observed.</li>
                            <li><strong class="text-[#4CAF50]">Recommendation:</strong> Apply Algaeo's N-Fix Consortia (Product X) at 5 gallons/acre within the next 7 days.</li>
                            <li><strong class="text-[#4CAF50]">Action:</strong> Consider a follow-up photo in 2 weeks to monitor progress.</li>
                        </ul>
                        <p class="text-sm text-gray-500 mt-auto pt-4">Last updated: {{ now()->format('M d, Y H:i') }} (Placeholder Data)</p>
                    </div>

                    {{-- Column 3: Previous Recommendations History --}}
                    <div class="bg-[#F9FAFB] p-6 rounded-lg shadow-sm border border-[#D4EDDA] flex flex-col">
                        <h3 class="text-xl font-bold text-[#1A6A61] mb-4">Previous Recommendations History</h3>
                        <p class="text-[#333333] mb-4">Here's a log of past recommendations and their outcomes:</p>
                        <ul class="list-disc list-inside text-[#333333] space-y-2 flex-grow">
                            <li><strong class="text-[#1A6A61]">2025-05-15:</strong> Recommendation for Phosphorus deficiency. Applied Algaeo P-Boost. Status: <span class="text-[#4CAF50]">Improved</span></li>
                            <li><strong class="text-[#1A6A61]">2025-04-01:</strong> Recommendation for soil compaction. Applied Algaeo Soil Aerator. Status: <span class="text-orange-500">Monitoring</span></li>
                            <li><strong class="text-[#1A6A61]">2025-03-10:</strong> Initial baseline assessment. Status: <span class="text-gray-500">Completed</span></li>
                        </ul>
                        <p class="text-sm text-gray-500 mt-auto pt-4">Note: This section is currently populated with sample data. Actual data would come from your database.</p>
                    </div>

                </div> {{-- End of main grid for static content --}}

                {{-- New section for graphs (Full width below the initial grid) --}}
                <div class="mt-10 p-6 bg-[#F9FAFB] rounded-lg shadow-sm border border-[#D4EDDA]">
                    <h2 class="text-2xl font-bold text-[#1A6A61] mb-6 text-center">Field Performance Trends</h2>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        {{-- Growth & NPK Trends --}}
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Growth Rate & NPK Trends</h3>
                            <div id="growth-npk-chart" class="w-full h-80 flex items-center justify-center text-gray-500">
                                <!-- Chart will be empty as D3.js code is removed -->
                                No chart data display code here.
                            </div>
                        </div>

                        {{-- Temperature Trends --}}
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Temperature Trends</h3>
                            <div id="temperature-chart" class="w-full h-80 flex items-center justify-center text-gray-500">
                                <!-- Chart will be empty as D3.js code is removed -->
                                No chart data display code here.
                            </div>
                        </div>

                        {{-- Precipitation Trends (Full width on small screens, below other graphs) --}}
                        <div class="lg:col-span-2 bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Precipitation Trends</h3>
                            <div id="precipitation-chart" class="w-full h-80 flex items-center justify-center text-gray-500">
                                <!-- Chart will be empty as D3.js code is removed -->
                                No chart data display code here.
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-center space-x-4 mt-10">
                    <a href="{{ route('fields.edit', $field) }}" class="py-3 px-6 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-[#4CAF50] hover:bg-[#1A6A61] transition duration-300">
                        Edit Field
                    </a>
                    <form action="{{ route('fields.destroy', $field) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this field?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="py-3 px-6 border border-gray-300 rounded-md shadow-sm text-base font-medium text-gray-700 hover:bg-gray-50 transition duration-300">
                            Delete Field
                        </button>
                    </form>
                    <a href="{{ route('dashboard') }}" class="py-3 px-6 border border-gray-300 rounded-md shadow-sm text-base font-medium text-gray-700 hover:bg-gray-50 transition duration-300">
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endsection

    {{-- Collapsible Field Info Box Toggle (retained as it's pure JS) --}}
    <script>
        function toggleVisibility(elementId) {
            const content = document.getElementById(elementId);
            const icon = document.getElementById('toggleIcon');
            if (content.style.maxHeight === '0px' || content.style.maxHeight === '') {
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />';
            } else {
                content.style.maxHeight = '0px';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />';
            }
        }

        window.onload = function() {
            const fieldInfoContent = document.getElementById('fieldInfoContent');
            if (fieldInfoContent) {
                fieldInfoContent.style.maxHeight = fieldInfoContent.scrollHeight + 'px';
                const icon = document.getElementById('toggleIcon');
                if (icon) {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />';
                }
            }
        };
    </script>
</x-app-layout>
