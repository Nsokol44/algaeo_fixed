<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <span class="text-2xl font-bold text-green-600">Algaeo</span>
                </a>
            </div>

            <!-- Navigation Links -->
         <div class="flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-left text-gray-900 hover:text-green-600 font-medium {{ request()->routeIs('home') ? 'border-b-2 border-green-600' : '' }}">
                    Home
                </a>
                <a href="{{ route('about') }}" class="text-gray-900 hover:text-green-600 font-medium {{ request()->routeIs('about') ? 'border-b-2 border-green-600' : '' }}">
                    About
                </a>
                <a href="{{ route('blog.index') }}" class="text-gray-900 hover:text-green-600 font-medium {{ request()->routeIs('blog.index') ? 'border-b-2 border-green-600' : '' }}">
                    Blog
                </a>
                <a href="{{ route('contact') }}" class="text-gray-900 hover:text-green-600 font-medium {{ request()->routeIs('contact') ? 'border-b-2 border-green-600' : '' }}">
                    Contact
                </a>
            </div>

            <!-- Authentication Buttons -->
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-900 hover:text-green-600 font-medium">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-900 hover:text-green-600 font-medium">
                            Log Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-900 hover:text-green-600 font-medium">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="ml-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 font-medium">
                        Sign Up
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
