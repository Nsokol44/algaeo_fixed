<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Fields') }}
        </h2>
    </x-slot>

    @section('content')
    <div class="py-12 bg-[#F9FAFB] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center"> {{-- Added text-center here --}}
                {{-- Updated Introductory Text --}}
                <h1 class="text-4xl sm:text-5xl font-extrabold text-[#1A6A61] mb-4">
                    Welcome, {{ Auth::user()->name ?? 'Guest' }}!
                </h1>
                <p class="text-lg text-[#333333] mb-10 max-w-2xl mx-auto">
                    Manage all your agricultural fields, garden beds, and plots here.
                </p>

                {{-- Centered "Add New Field" Button --}}
                <div class="flex justify-center mb-10"> {{-- Flex container to center content --}}
                    <a href="{{ route('fields.create') }}" class="py-3 px-6 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-[#4CAF50] hover:bg-[#1A6A61] transition duration-300">
                        Add New Field
                    </a>
                </div>

                {{-- Original content for displaying fields would go here --}}
                {{-- This is a placeholder for your existing field listing --}}
                @if ($fields->isEmpty())
                    <p class="text-gray-600 text-lg mt-8">You haven't registered any fields yet. Click "Add New Field" to get started!</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                        @foreach ($fields as $field)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                {{-- The image and main content are now separate from the link to allow multiple actions --}}
                                <a href="{{ route('fields.show', $field->id) }}" class="block">
                                    @if($field->photo_url)
                                        <img src="{{ $field->photo_url }}" alt="{{ $field->name }}" class="w-full h-48 object-cover">
                                    @else
                                        <img src="https://placehold.co/400x200/1A6A61/D4EDDA?text=No+Photo" alt="No Photo" class="w-full h-48 object-cover">
                                    @endif
                                    <div class="p-4">
                                        <h3 class="text-xl font-semibold text-[#1A6A61]">{{ $field->name }}</h3>
                                        <p class="text-gray-700 text-sm mt-1">Type: {{ $field->type }}</p>
                                    </div>
                                </a>

                                {{-- Action buttons for Edit and Delete --}}
                                <div class="p-4 pt-0 flex justify-end space-x-2"> {{-- Added flex and justify-end for button alignment --}}
                                    <a href="{{ route('fields.edit', $field->id) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Edit
                                    </a>
                                    <form action="{{ route('fields.destroy', $field->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this field?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
