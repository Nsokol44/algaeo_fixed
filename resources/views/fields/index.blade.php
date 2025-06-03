<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Your Fields</h1>
            <a href="{{ route('fields.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 flex items-center">
                <i class="ti ti-plus mr-2"></i> New Field
            </a>
        </div>

        @if($fields->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-500 mb-4">No fields registered yet.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($fields as $field)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <img src="{{ asset('storage/' . $field->photo_path) }}" alt="{{ $field->name }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $field->name }}</h3>
                            <div class="text-gray-600 mb-4">
                                <p class="flex items-center">
                                    <i class="ti ti-ruler-measure mr-2"></i>
                                    {{ $field->size }} acres
                                </p>
                                @if($field->location)
                                    <p class="flex items-center mt-2">
                                        <i class="ti ti-map-pin mr-2"></i>
                                        {{ number_format($field->location->lat, 4) }}, {{ number_format($field->location->lng, 4) }}
                                    </p>
                                @endif
                            </div>
                            <div id="map-{{ $field->id }}" class="h-48 mb-4"></div>
                            <a href="{{ route('fields.show', $field) }}" class="text-green-600 hover:text-green-800">View Details</a>
                        </div>
                    </div>
                    @push('scripts')
                    <script>
                        const map{{ $field->id }} = L.map('map-{{ $field->id }}').setView(
                            [{{ $field->location->lat ?? 0 }}, {{ $field->location->lng ?? 0 }}], 13
                        );
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map{{ $field->id }});
                        @if($field->location)
                        L.marker([{{ $field->location->lat }}, {{ $field->location->lng }}])
                         .addTo(map{{ $field->id }})
                         .bindPopup('{{ $field->name }}');
                        @endif
                    </script>
                    @endpush
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
