@extends('layouts.app')

@section('content')
<div class="py-12 bg-[#D4EDDA] min-h-screen"> <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="font-semibold text-2xl text-[#1A6A61] leading-tight mb-6"> {{ __('Your Registered Fields') }}
            </h2>

            @if (session('success'))
                <div class="bg-[#D4EDDA] border border-[#4CAF50] text-[#1A6A61] px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="mb-6">
                <a href="{{ route('fields.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-[#4CAF50] hover:bg-[#1A6A61] transition duration-300">
                    Register New Field
                </a>
            </div>

            @if ($fields->isEmpty())
                <p class="text-[#333333] text-lg">You haven't registered any fields yet. Click "Register New Field" to get started!</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($fields as $field)
                        <a href="{{ route('fields.show', $field) }}" class="block bg-white rounded-lg shadow-md overflow-hidden border border-[#D4EDDA] hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                            @if ($field->photo_path)
                                <img src="{{ asset('storage/' . $field->photo_path) }}" alt="Field Photo for {{ $field->name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                    No Photo Available
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="text-xl font-bold text-[#1A6A61] mb-2">{{ $field->name }}</h3>
                                <p class="text-gray-600 text-sm mb-1">Size: {{ $field->size }} acres</p>
                                <p class="text-gray-600 text-sm">Registered: {{ $field->created_at->format('M d, Y') }}</p>
                                <p class="text-gray-700 mt-2 text-sm line-clamp-2">{{ $field->notes ?? 'No notes available.' }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
