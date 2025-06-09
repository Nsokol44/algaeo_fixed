<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Field') }}
        </h2>
    </x-slot>

    @section('content')
    <div class="py-12 bg-[#F9FAFB] min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-4xl sm:text-5xl font-extrabold text-[#1A6A61] mb-6 text-center">Edit Field</h1>
                <p class="text-lg text-[#333333] mb-10 text-center max-w-2xl mx-auto">
                    Update the details for your agricultural field.
                </p>

                <form method="POST" action="{{ route('fields.update', $field) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT') {{-- Use PUT method for updates --}}

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Field Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $field->name) }}" required
                               class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-base">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                        <select name="type" id="type" required
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-base">
                            <option value="">Select Type</option>
                            <option value="Field" {{ old('type', $field->type) == 'Field' ? 'selected' : '' }}>Field</option>
                            <option value="Garden Bed" {{ old('type', $field->type) == 'Garden Bed' ? 'selected' : '' }}>Garden Bed</option>
                            <option value="Plot" {{ old('type', $field->type) == 'Plot' ? 'selected' : '' }}>Plot</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="crops_grown" class="block text-sm font-medium text-gray-700">Crops/Plants Grown There</label>
                        <textarea name="crops_grown" id="crops_grown" rows="3"
                                  class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-base">{{ old('crops_grown', $field->crops_grown) }}</textarea>
                        @error('crops_grown')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="size" class="block text-sm font-medium text-gray-700">Size (e.g., acres, sq ft)</label>
                        <input type="number" name="size" id="size" value="{{ old('size', $field->size) }}" step="any" required
                               class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-base">
                        @error('size')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Location (Optional)</label>
                        {{-- The $field->location accessor now returns an object with lat/lng, or null. --}}
                        {{-- To display it as "lat, lng" in the input, we need to format it. --}}
                        <input type="text" name="location" id="location" value="{{ old('location', $field->location ? $field->location->lat . ', ' . $field->location->lng : '') }}"
                               class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-base"
                               placeholder="e.g., 34.0522, -118.2437 (will be overwritten by photo EXIF)">
                        <p class="text-xs text-gray-500 mt-1">Note: If a photo with EXIF GPS data is uploaded, its location data will override manual input.</p>
                        @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notes (Optional)</label>
                        <textarea name="notes" id="notes" rows="5"
                                  class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-base">{{ old('notes', $field->notes) }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700">Field Photo (Optional)</label>
                        @if($field->photo_url)
                            <p class="text-sm text-gray-600 mb-2">Current photo:</p>
                            <img src="{{ $field->photo_url }}" alt="Current Field Photo" class="w-32 h-32 object-cover rounded-lg mb-2">
                        @endif
                        <input type="file" name="photo" id="photo" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-500
                               file:mr-4 file:py-2 file:px-4
                               file:rounded-full file:border-0
                               file:text-sm file:font-semibold
                               file:bg-[#D4EDDA] file:text-[#1A6A61]
                               hover:file:bg-[#C2E0CC]">
                        @error('photo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('dashboard') }}" class="py-3 px-6 border border-gray-300 rounded-md shadow-sm text-base font-medium text-gray-700 hover:bg-gray-50 transition duration-300">
                            Cancel
                        </a>
                        <button type="submit" class="py-3 px-6 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-[#4CAF50] hover:bg-[#1A6A61] transition duration-300">
                            Update Field
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
