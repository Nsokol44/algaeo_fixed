@props([
    'title' => 'Innovate Your Ecosystem',
    'description' => 'Discover your proprietary biostimulants and "Grow Your Own" kits. Empower your reef tank or garden with cutting-edge microbial solutions.',
    'buttonText' => 'SEE ALL PRODUCTS',
    'buttonLink' => '#'
])

<section class="max-w-6xl mx-auto my-16 px-6">
    <div class="bg-secondary text-white rounded-lg py-14 px-8 text-center shalow-lg">
        <h2 class="text-3xl font-extrabold mb-4 tracking-tight">
            {{ $title }}
        </h2>
 
        <p class="text-lg max-w-3xl mx-auto mb-8 leading-relaxed">
            {!! $description !!}
        </p>

        <a href="{{ $buttonLink }}"
            class="inline-block bg-[#034b99] text-white font-semibold px-6 py-3 rounded-md shadow hover:bg-accent transition-transform duration-200 hover:-translate-y-1">
            {{ $buttonText }}
        </a>
    </div>
</section>