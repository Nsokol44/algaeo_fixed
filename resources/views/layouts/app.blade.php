<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Algaeo - Photo-Based Field Management & Microbial Solutions</title>
  <meta name="description" content="Algaeo empowers growers to manage fields with just a photo, offering AI-driven insights and microbial recommendations for soil health, crop optimization, and sustainable farming.">
  
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F9FAFB] text-[#333333] font-sans flex flex-col"> <nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex">
          <div class="flex-shrink-0 flex items-center">
            <span class="text-xl font-bold text-[#4CAF50]">Algaeo</span> </div>
          <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
            <a href="{{ route('home') }}" class="border-[#4CAF50] text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Home</a>
            <a href="{{ route('about') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">About</a>
            <a href="{{ route('blog.index') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Resources</a> {{-- CHANGED THIS LINE --}}
            <a href="{{ route('contact') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Contact</a>
          </div>
        </div>
        <div class="hidden sm:ml-6 sm:flex sm:items-center">
          @auth
            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" class="ml-4">
                @csrf
                <button type="submit" class="bg-[#4CAF50] text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-[#1A6A61]">
                    Logout
                </button>
            </form>
          @else
            <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Sign In</a>
            <a href="{{ route('register') }}" class="ml-4 bg-[#4CAF50] text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-[#1A6A61]">Sign Up</a>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  <main class="flex-grow"> {{-- Added flex-grow to push footer to bottom --}}
    @yield('content')
  </main>

  <footer class="bg-[#1A6A61] text-white py-8"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <div class="mb-4">
        <span class="text-2xl font-bold text-white">Algaeo</span>
        <p class="text-sm text-[#D4EDDA] mt-1">Unlocking Soil Potential on Demand</p> </div>

      <div class="flex justify-center space-x-6 mb-6">
        <a href="#" class="text-white hover:text-[#4CAF50] transition duration-300" aria-label="Facebook">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.353c-.567 0-.647.286-.647.747v1.253h2l-.26 2h-1.74v6h-3v-6h-2v-2h2v-1.192c0-1.922 1.061-2.808 3.132-2.808h1.868v3z"/></svg>
        </a>
        <a href="#" class="text-white hover:text-[#4CAF50] transition duration-300" aria-label="Twitter">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.592 0-6.492 2.901-6.492 6.492 0 .512.057 1.01.169 1.497-5.402-.27-10.192-2.868-13.407-6.812-.56.96-.883 2.077-.883 3.251 0 2.254 1.144 4.248 2.873 5.422-.845-.025-1.63-.26-2.32-.64v.081c0 3.154 2.24 5.787 5.215 6.39-.545.149-1.115.23-1.702.23-.417 0-.82-.041-1.215-.116.82 2.578 3.203 4.45 6.038 4.49-.009.009-.018.018-.027.027-2.261 1.77-5.126 2.823-8.239 2.823-.538 0-1.069-.026-1.59-.079 3.066 1.96 6.726 3.102 10.686 3.102 12.826 0 19.774-10.974 19.774-20.533 0-.317-.01-.63-.025-.945.859-.62 1.606-1.396 2.195-2.278z"/></svg>
        </a>
        <a href="#" class="text-white hover:text-[#4CAF50] transition duration-300" aria-label="LinkedIn">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.493-1.1-1.093s.493-1.093 1.1-1.093c.607 0 1.1.493 1.1 1.093s-.493 1.093-1.1 1.093zm7 6.891h-2v-3.5c0-.811-.531-1.488-1.328-1.488-.802 0-1.168.55-1.168 1.488v3.5h-2v-6h2v1.732c.699-1.216 1.898-1.732 3.136-1.732 2.079 0 3.364 1.22 3.364 3.867v2.133z"/></svg>
        </a>
      </div>

      <p class="text-sm text-[#D4EDDA]">&copy; Copyright {{ date('Y') }} Algaeo, LLC. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
