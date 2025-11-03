@extends('layouts.app')

@section('content')
    <x-hero />

    <!-- Features Section -->
    <section class="max-w-6xl mx-auto py-8 grid md:grid-cols-3 gap-8 text-center">
        <div class="p-6 bg-white rounded shadow transition-transform duration-200 hover:-translate-y-1">
            <h3 class="text-xl font-semibold text-accent mb-2">PhD Formulated & Verified</h3>
            <p class="text-gray-600">Benefit from over a decade of scientific expertise in every culture. Purity and density guaranteed.</p>
        </div>
        <div class="p-6 bg-white rounded shadow transition-transform duration-200 hover:-translate-y-1">
            <h3 class="text-xl font-semibold text-accent mb-2">Specialty Cultures for Experts</h3>
            <p class="text-gray-600">High-density phytoplankton, copepods, and rotifers designed for serious hobbyists and growers.</p>
        </div>
        <div class="p-6 bg-white rounded shadow transition-transform duration-200 hover:-translate-y-1">
            <h3 class="text-xl font-semibold text-accent mb-2">Nationwide Live Delivery</h3>
            <p class="text-gray-600">Carefully packaged with thermal control to ensure your live products arrive viable, year-round.</p>
        </div>
    </section>
    
    <x-cta 
    title="Innovate Your Ecosystem"
    description='Discover our proprietary biostimulants and "Grow Your Own" kits. Empower your reef tank or garden with cutting-edge microbial solutions.'
    buttonText="SEE ALL PRODUCTS"
    buttonLink="/shop"
    />

    <x-home.tool-preview />

@endsection
