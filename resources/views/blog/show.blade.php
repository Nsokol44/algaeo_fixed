@extends('layouts.app')

@section('content')
<div class="py-12 bg-[#F9FAFB] min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-8 md:p-10 lg:p-12 border border-[#D4EDDA]">
            @if($post->image_path)
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-96 object-cover rounded-lg mb-8">
            @endif

            <h1 class="text-4xl sm:text-5xl font-extrabold text-[#1A6A61] mb-4">{{ $post->title }}</h1>
            <p class="text-gray-600 text-sm mb-8">Published on {{ $post->published_at ? $post->published_at->format('M d, Y') : 'N/A' }}</p>

            <div class="prose max-w-none text-lg text-[#333333] leading-relaxed">
                {{-- Using {!! !!} to render HTML if your content has formatting --}}
                {!! $post->content !!}
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('blog.index') }}" class="inline-flex justify-center py-3 px-8 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-[#4CAF50] hover:bg-[#1A6A61] transition duration-300">
                    &larr; Back to all posts
                </a>
            </div>
        </div>
    </div>
</div>
@endsection