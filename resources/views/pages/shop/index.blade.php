@extends('layouts.app')

@section('content')
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Page header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Shop</h1>
        <p class="mt-2 text-sm text-gray-600">Showing 0 results</p>
    </div>

    {{-- Empty state (temporary) --}}
    <div class="rounded-md border border-dashed border-gray-300 bg-white px-6 py-16 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Products coming soon</h2>
        <p class="mt-2 text-gray-600">
            We’re preparing our catalog. Check back shortly—or browse our
            <a href="{{ route('blog.index') }}" class="text-accent hover:underline">News &amp; Articles</a>
            in the meantime.
        </p>

        {{-- Optional CTA row to mirror your example layout --}}
        <div class="mt-6 flex items-center justify-center gap-3">
            <a href="{{ route('shop.mission') }}"
               class="inline-flex items-center rounded-md bg-accent px-4 py-2 text-white hover:bg-secondary transition">
               Our Mission
            </a>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center rounded-md border px-4 py-2 text-gray-800 hover:bg-gray-50 transition">
               Contact Sales
            </a>
        </div>
    </div>
</section>
@endsection
