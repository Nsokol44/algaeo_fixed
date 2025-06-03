@extends('layouts.app')

@section('content')
  <div class="bg-[#D4EDDA] py-16 sm:py-24"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-[#1A6A61] leading-tight mb-4"> Manage Your Fields, Optimize Growth,<br class="hidden md:block"> Just by Taking a Photo.
      </h1>
      <p class="text-lg sm:text-xl text-[#333333] mb-8 max-w-3xl mx-auto"> Algaeo's advanced microbial analysis provides actionable insights and precise recommendations for soil health and crop yields.
      </p>
      <div class="flex justify-center space-x-4">
        <a href="{{ route('register') }}" class="bg-[#4CAF50] text-white px-8 py-3 rounded-md text-lg font-medium hover:bg-[#1A6A61] transition duration-300"> Get Started
        </a>
        <a href="{{ route('login') }}" class="bg-white text-[#4CAF50] px-8 py-3 rounded-md text-lg font-medium border border-[#4CAF50] hover:bg-[#D4EDDA] transition duration-300"> Sign In
        </a>
      </div>
    </div>
  </div>

  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h2 class="text-3xl font-bold text-[#1A6A61] mb-12">How Algaeo Empowers Your Farm</h2> <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <div class="p-6 rounded-lg shadow-lg bg-[#F9FAFB] transition duration-300 hover:shadow-xl"> <div class="text-[#4CAF50] text-5xl mb-4">📸</div> <h3 class="text-xl font-semibold text-[#1A6A61] mb-3">1. Snap a Photo</h3> <p class="text-[#333333]">Simply capture images of your plants, soil, or entire fields with your smartphone.</p> </div>
        <div class="p-6 rounded-lg shadow-lg bg-[#F9FAFB] transition duration-300 hover:shadow-xl"> <div class="text-[#4CAF50] text-5xl mb-4">🔬</div> <h3 class="text-xl font-semibold text-[#1A6A61] mb-3">2. AI Analyzes</h3> <p class="text-[#333333]">Our cutting-edge AI and extensive microbial database analyze the visual data for insights.</p> </div>
        <div class="p-6 rounded-lg shadow-lg bg-[#F9FAFB] transition duration-300 hover:shadow-xl"> <div class="text-[#4CAF50] text-5xl mb-4">📈</div> <h3 class="text-xl font-semibold text-[#1A6A61] mb-3">3. Grow Smarter</h3> <p class="text-[#333333]">Receive precise recommendations, track progress, and get Algaeo microbe solutions for optimal growth.</p> </div>
      </div>
    </div>
  </section>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-white">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-white rounded-lg shadow-md overflow-hidden border border-[#D4EDDA] transition duration-300 hover:shadow-xl"> <div class="p-6">
          <h3 class="text-xl font-bold text-[#1A6A61] mb-3">Unlock Soil Secrets</h3> <p class="text-[#333333]">Our AI analyzes your field photos, identifying nutrient deficiencies and soil imbalances with precision, directly linking to specific microbial needs.</p> </div>
      </div>
      <div class="bg-white rounded-lg shadow-md overflow-hidden border border-[#D4EDDA] transition duration-300 hover:shadow-xl"> <div class="p-6">
          <h3 class="text-xl font-bold text-[#1A6A61] mb-3">Actionable Recommendations</h3> <p class="text-[#333333]">Get personalized microbial consortia recommendations tailored to your unique field needs for maximum yield potential and sustained health.</p> </div>
      </div>
      <div class="bg-white rounded-lg shadow-md overflow-hidden border border-[#D4EDDA] transition duration-300 hover:shadow-xl"> <div class="p-6">
          <h3 class="text-xl font-bold text-[#1A6A61] mb-3">Effortless Monitoring</h3> <p class="text-[#333333]">Track your field's progress over time with simple photo uploads, reducing reliance on complex tests and enabling proactive problem-solving.</p> </div>
      </div>
    </div>
  </div>

  <div class="bg-[#1A6A61] py-12 sm:py-16"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Ready to Transform Your Farm?</h2>
      <p class="text-lg sm:text-xl text-[#D4EDDA] mb-8 max-w-2xl mx-auto">Join thousands of growers who are already benefiting from Algaeo's innovative microbial solutions.</p> <a href="{{ route('register') }}" class="bg-[#4CAF50] text-white px-8 py-4 rounded-md text-xl font-bold hover:bg-white hover:text-[#1A6A61] transition duration-300"> Sign Up Now
      </a>
    </div>
  </div>
@endsection
