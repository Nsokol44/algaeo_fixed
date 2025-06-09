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
                {{-- Increased gap-y to push elements apart vertically on smaller screens, and added mb-10 for space before graphs --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 gap-y-10 mb-10">

                    {{-- Column 1: Field Photo and Main Details --}}
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

                        {{-- Ensured min-h is sufficient, removed h-full as it can interfere with grid gaps --}}
                        <div class="bg-[#F9FAFB] p-6 rounded-lg shadow-sm border border-[#D4EDDA] min-h-[300px]">
                            <h3 class="text-xl font-bold text-[#1A6A61] mb-4">Field Information</h3>
                            <div class="space-y-3 text-lg text-gray-700">
                                <p><strong>Type:</strong> {{ $field->type ?? 'N/A' }}</p>
                                <p><strong>Crops/Plants Grown:</strong> {{ $field->crops_grown ?? 'N/A' }}</p>
                                <p><strong>Size:</strong> {{ $field->size ?? 'N/A' }}</p>
                                <p><strong>Notes:</strong> {{ $field->notes ?? 'N/A' }}</p>
                                <p><strong>Registered On:</strong> {{ $field->created_at ? $field->created_at->format('M d, Y H:i') : 'N/A' }}</p>
                                <p><strong>Last Updated:</strong> {{ $field->updated_at ? $field->updated_at->format('M d, Y H:i') : 'N/A' }}</p>

                                <p class="text-[#333333]">
                                    <strong class="text-[#1A6A61]">Location:</strong>
                                    @if ($field->location)
                                        {{ $field->location }}
                                        <span class="text-sm text-gray-500">(extracted from photo EXIF data)</span>
                                    @else
                                        Not available.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Column 2: Latest Algaeo Insights & Recommendations --}}
                    {{-- Added flex and flex-col to ensure content fills available height --}}
                    <div class="bg-[#F9FAFB] p-6 rounded-lg shadow-sm border border-[#D4EDDA] flex flex-col">
                        <h3 class="text-xl font-bold text-[#1A6A61] mb-4">Latest Algaeo Insights & Recommendations</h3>
                        <p class="text-[#333333] mb-4">Based on your recent photo uploads, here are our latest findings and recommendations for {{ $field->name ?? 'this field' }}:</p>
                        <ul class="list-disc list-inside text-[#333333] space-y-2 flex-grow"> {{-- Added flex-grow to push footer to bottom --}}
                            <li><strong class="text-[#4CAF50]">Nutrient Deficiency:</strong> Detected low Nitrogen levels.</li>
                            <li><strong class="text-[#4CAF50]">Soil Health:</strong> Moderate microbial activity observed.</li>
                            <li><strong class="text-[#4CAF50]">Recommendation:</strong> Apply Algaeo's N-Fix Consortia (Product X) at 5 gallons/acre within the next 7 days.</li>
                            <li><strong class="text-[#4CAF50]">Action:</strong> Consider a follow-up photo in 2 weeks to monitor progress.</li>
                        </ul>
                        <p class="text-sm text-gray-500 mt-auto pt-4">Last updated: {{ now()->format('M d, Y H:i') }} (Placeholder Data)</p> {{-- mt-auto pushes this to bottom --}}
                    </div>

                    {{-- Column 3: Previous Recommendations History --}}
                    {{-- Added flex and flex-col to ensure content fills available height --}}
                    <div class="bg-[#F9FAFB] p-6 rounded-lg shadow-sm border border-[#D4EDDA] flex flex-col">
                        <h3 class="text-xl font-bold text-[#1A6A61] mb-4">Previous Recommendations History</h3>
                        <p class="text-[#333333] mb-4">Here's a log of past recommendations and their outcomes:</p>
                        <ul class="list-disc list-inside text-[#333333] space-y-2 flex-grow"> {{-- Added flex-grow to push footer to bottom --}}
                            <li><strong class="text-[#1A6A61]">2025-05-15:</strong> Recommendation for Phosphorus deficiency. Applied Algaeo P-Boost. Status: <span class="text-[#4CAF50]">Improved</span></li>
                            <li><strong class="text-[#1A6A61]">2025-04-01:</strong> Recommendation for soil compaction. Applied Algaeo Soil Aerator. Status: <span class="text-orange-500">Monitoring</span></li>
                            <li><strong class="text-[#1A6A61]">2025-03-10:</strong> Initial baseline assessment. Status: <span class="text-gray-500">Completed</span></li>
                        </ul>
                        <p class="text-sm text-gray-500 mt-auto pt-4">Note: This section is currently populated with sample data. Actual data would come from your database.</p> {{-- mt-auto pushes this to bottom --}}
                    </div>

                </div> {{-- End of main grid for static content --}}

                {{-- New section for graphs (Full width below the initial grid) --}}
                {{-- Added mt-10 to ensure good spacing from the content above --}}
                <div class="mt-10 p-6 bg-[#F9FAFB] rounded-lg shadow-sm border border-[#D4EDDA]">
                    <h2 class="text-2xl font-bold text-[#1A6A61] mb-6 text-center">Field Performance Trends</h2>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        {{-- Growth & NPK Trends --}}
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Growth Rate & NPK Trends</h3>
                            <div id="growth-npk-chart" class="w-full h-80"></div>
                        </div>

                        {{-- Temperature Trends --}}
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Temperature Trends</h3>
                            <div id="temperature-chart" class="w-full h-80"></div>
                        </div>

                        {{-- Precipitation Trends (Full width on small screens, below other graphs) --}}
                        <div class="lg:col-span-2 bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Precipitation Trends</h3>
                            <div id="precipitation-chart" class="w-full h-80"></div>
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

    {{-- D3.js Library --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/7.8.5/d3.min.js"></script>

    <script>
        // Data for charts (PLACEHOLDER DATA)
        const growthNpKData = {{ Js::from($npkData) }};
        const temperatureData = {{ Js::from($tempData) }};
        const precipitationData = {{ Js::from($precipData) }};

        // Parse dates
        const parseDate = d3.timeParse("%Y-%m-%d");
        growthNpKData.forEach(d => d.date = parseDate(d.date));
        temperatureData.forEach(d => d.date = parseDate(d.date));
        precipitationData.forEach(d => d.date = parseDate(d.date));

        // Function to draw a generic line chart
        function drawLineChart(data, selector, yValueKey, yAxisLabel, lineColors = ['#4CAF50', '#FFC107', '#2196F3', '#F44336']) {
            const container = d3.select(selector);
            const containerWidth = container.node().getBoundingClientRect().width;
            const containerHeight = container.node().getBoundingClientRect().height;

            const margin = { top: 20, right: 30, bottom: 40, left: 50 };
            const width = containerWidth - margin.left - margin.right;
            const height = containerHeight - margin.top - margin.bottom;

            container.html(''); // Clear previous chart if redrawing

            const svg = container.append("svg")
                .attr("width", containerWidth)
                .attr("height", containerHeight)
                .append("g")
                .attr("transform", `translate(${margin.left},${margin.top})`);

            // X scale
            const xScale = d3.scaleTime()
                .domain(d3.extent(data, d => d.date))
                .range([0, width]);

            // Y scale
            const yMax = d3.max(data, d => {
                if (Array.isArray(yValueKey)) { // For NPK chart with multiple lines
                    return d3.max(yValueKey, key => d[key]);
                }
                return d[yValueKey];
            });
            const yScale = d3.scaleLinear()
                .domain([0, yMax * 1.1]) // Add 10% padding to top
                .range([height, 0]);

            // Add X axis
            svg.append("g")
                .attr("transform", `translate(0,${height})`)
                .call(d3.axisBottom(xScale).ticks(d3.timeMonth.every(1)).tickFormat(d3.timeFormat("%b %Y")));

            // Add Y axis
            svg.append("g")
                .call(d3.axisLeft(yScale));

            // Add Y axis label
            svg.append("text")
                .attr("transform", "rotate(-90)")
                .attr("y", 0 - margin.left)
                .attr("x", 0 - (height / 2))
                .attr("dy", "1em")
                .style("text-anchor", "middle")
                .style("font-size", "12px")
                .style("fill", "#666")
                .text(yAxisLabel);

            if (Array.isArray(yValueKey)) {
                // Draw multiple lines for NPK/Growth
                yValueKey.forEach((key, index) => {
                    const line = d3.line()
                        .x(d => xScale(d.date))
                        .y(d => yScale(d[key]));

                    svg.append("path")
                        .datum(data)
                        .attr("fill", "none")
                        .attr("stroke", lineColors[index % lineColors.length])
                        .attr("stroke-width", 2)
                        .attr("d", line);

                    // Add dots
                    svg.selectAll(`.dot-${key}`)
                        .data(data)
                        .enter().append("circle")
                        .attr("class", `dot-${key}`)
                        .attr("cx", d => xScale(d.date))
                        .attr("cy", d => yScale(d[key]))
                        .attr("r", 4)
                        .attr("fill", lineColors[index % lineColors.length]);
                });

                 // Add legend for NPK/Growth
                const legend = svg.append("g")
                    .attr("font-family", "sans-serif")
                    .attr("font-size", 10)
                    .attr("text-anchor", "end")
                    .selectAll("g")
                    .data(yValueKey)
                    .enter().append("g")
                    .attr("transform", (d, i) => `translate(0,${i * 20})`);

                legend.append("rect")
                    .attr("x", width - 19)
                    .attr("width", 19)
                    .attr("height", 19)
                    .attr("fill", (d, i) => lineColors[i % lineColors.length]);

                legend.append("text")
                    .attr("x", width - 24)
                    .attr("y", 9.5)
                    .attr("dy", "0.32em")
                    .text(d => d);

            } else {
                // Draw single line for Temperature/Precipitation
                const line = d3.line()
                    .x(d => xScale(d.date))
                    .y(d => yScale(d[yValueKey]));

                svg.append("path")
                    .datum(data)
                    .attr("fill", "none")
                    .attr("stroke", lineColors[0]) // Use first color for single line
                    .attr("stroke-width", 2)
                    .attr("d", line);

                // Add dots
                svg.selectAll(".dot")
                    .data(data)
                    .enter().append("circle")
                    .attr("class", "dot")
                    .attr("cx", d => xScale(d.date))
                    .attr("cy", d => yScale(d[yValueKey]))
                    .attr("r", 4)
                    .attr("fill", lineColors[0]);
            }
        }

        // Draw charts on page load
        document.addEventListener('DOMContentLoaded', () => {
            drawLineChart(growthNpKData, '#growth-npk-chart', ['growth', 'N', 'P', 'K'], 'Value', ['#4CAF50', '#FFC107', '#2196F3', '#F44336']);
            drawLineChart(temperatureData, '#temperature-chart', 'temp', 'Temperature (°C)', ['#FF5722']);
            drawLineChart(precipitationData, '#precipitation-chart', 'precip', 'Precipitation (mm)', ['#03A9F4']);
        });

        // Optional: Redraw charts on window resize for responsiveness
        window.addEventListener('resize', () => {
            drawLineChart(growthNpKData, '#growth-npk-chart', ['growth', 'N', 'P', 'K'], 'Value', ['#4CAF50', '#FFC107', '#2196F3', '#F44336']);
            drawLineChart(temperatureData, '#temperature-chart', 'temp', 'Temperature (°C)', ['#FF5722']);
            drawLineChart(precipitationData, '#precipitation-chart', 'precip', 'Precipitation (mm)', ['#03A9F4']);
        });
    </script>
</x-app-layout>
