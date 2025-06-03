<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('fields.index') }}" class="flex items-center">
                    <span class="text-2xl font-bold text-green-600">Algaeo</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="relative">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-900">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
