@props([
    'title' => 'Find Your Perfect Microbial Blend',
    'subtitle' => "Use our PhD-driven tool to match your soil, crop, and growing conditions with the right Algaeo formulation.",
    // Simple starter options for the preview; replace later or pass in from the page.
    'soilOptions' => ['Clay (heavy, holds water)', 'Clay (light, drains fast)', 'Sandy (light, drains fast)', 'Loam (balanced, rich)', 'Peaty (dark, acidic)', 'Saline (white crust, poor drainage)', 'Hydroponic/Aquaponic'],
    'cropOptions' => ['Tomatoes / Peppers', 'Leafy Greens (Lettuce, Spinach, Kale)', 'Root Crops (Carrots, Beets, Radish)', 'Corn / Grains', 'Berries (Strawberry, Blueberry)', 'Herbs (Basil, Mint, Parsley)'],
    'issueOptions' => ['Poor or uneven growth', 'Yellowing leaves / chlorosis', 'Low yield or small fruit', 'Disease or root rot', 'Soil dries too fast', 'Nutrients not being absorbed'],
    'ctaText' => 'GET MY RECOMMENDATION',
    'ctaHref' => null,
])

@php
    $ctaLink = $ctaHref ?? (Route::has('tools.index') ? route('tools.index') : '/tools');
@endphp

<section class="w-full py-16">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-[#2F6B58] tracking-tight">
                {{ $title }}
            </h2>
            <p class="text-gray-600 max-w-3xl mx-auto mt-3 leading-relaxed">
                {{ $subtitle }}
            </p>
        </div>

        <!-- Preview Card -->
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-black/5 max-w-3xl mx-auto p-6 md:p-8">
            <!-- Row 1 -->
            <div class="space-y-5">
                <div>
                    <label class="block text-base font-semibold text-gray-700 mb-1">Primary Soil Type</label>
                    <div class="relative">
                        <select class="w-full rounded-md border-gray-300 pr-10 focus:border-[#2F6B58] focus:ring-[#2F6B58]">
                            <option selected disabled>Select soil type...</option>
                            @foreach ($soilOptions as $opt)
                                <option>{{ $opt }}</option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">▾</span>
                    </div>
                </div>

                <div>
                    <label class="block text-base font-semibold text-gray-700 mb-1">Crop Type</label>
                    <div class="relative">
                        <select class="w-full rounded-md border-gray-300 pr-10 focus:border-[#2F6B58] focus:ring-[#2F6B58]">
                            <option selected disabled>Select crop type...</option>
                            @foreach ($cropOptions as $opt)
                                <option>{{ $opt }}</option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">▾</span>
                    </div>
                </div>

                <div>
                    <label class="block text-base font-semibold text-gray-700 mb-1">Observed Problem</label>
                    <div class="relative">
                        <select class="w-full rounded-md border-gray-300 pr-10 focus:border-[#2F6B58] focus:ring-[#2F6B58]">
                            <option selected disabled>Select an issue...</option>
                            @foreach ($issueOptions as $opt)
                                <option>{{ $opt }}</option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">▾</span>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="mt-6">
                <a href="{{ $ctaLink }}"
                   class="inline-flex items-center justify-center rounded-md bg-accent px-5 py-3 text-sm font-semibold text-white shadow hover:bg-[#1a448d] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2F6B58]">
                    {{ $ctaText }}
                </a>
                <p class="mt-2 text-xs text-gray-500">
                    Visit the tools page for access to the full tool and more!
                </p>
            </div>
        </div>
    </div>
</section>
