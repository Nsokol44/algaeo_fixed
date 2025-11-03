@extends('layouts.app')

@section('title', 'Tools Dashboard')
@section('content')
<section class ="text-center py-16">
    <h1 class="text-4xl font-bold text-green-800 mb-6">
        Algaeo Tools
    </h1>
    <p class="text-gray-600-mb-10 max-w-2xl mx-auto">
        Manage and explore Algaeo's experimental tools here. Access microbial optimizers, field analytics, and weather integrations.
    </p>

    <div class ="flex justify-center gap-6">
        <a href="{{ route('tools.optimizer') }}" class="bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-800">
         Microbial Optimizer
    </a>
    <a href="{{ route('tools.weather') }}" class="border border-green-700 text-green-700 px-6 py-3 rounded-lg hover:bg-green-50">
        Weather Tool
    </a>
</div>
</section>

@endsection
