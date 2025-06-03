@extends('layouts.app')

@section('content')
<div class="py-12 bg-[#F9FAFB] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-8 md:p-10 lg:p-12 border border-[#D4EDDA]">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-[#1A6A61] mb-6 text-center">Algaeo Resources & Blog</h1>
            <p class="text-lg text-[#333333] mb-10 text-center max-w-3xl mx-auto">
                Explore our articles, guides, and insights on soil health, microbial farming, crop optimization, and the latest in agricultural technology.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-[#D4EDDA] rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl">
                    <img src="https://placehold.co/600x300/1A6A61/D4EDDA?text=Blog+Post+1" alt="Blog Post Image" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-[#1A6A61] mb-2">The Power of Microbes in Regenerative Agriculture</h3>
                        <p class="text-[#333333] text-sm mb-4 line-clamp-3">Discover how beneficial microbes are transforming farming practices and leading to healthier soils and higher yields.</p>
                        <a href="#" class="text-[#4CAF50] hover:text-[#1A6A61] font-medium text-sm">Read More &rarr;</a>
                    </div>
                </div>

                <div class="bg-[#D4EDDA] rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl">
                    <img src="https://placehold.co/600x300/1A6A61/D4EDDA?text=Blog+Post+2" alt="Blog Post Image" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-[#1A6A61] mb-2">AI in Your Fields: Photo Analysis for Precision Farming</h3>
                        <p class="text-[#333333] text-sm mb-4 line-clamp-3">Learn how Algaeo uses advanced AI to analyze your field photos and provide actionable insights for crop management.</p>
                        <a href="#" class="text-[#4CAF50] hover:text-[#1A6A61] font-medium text-sm">Read More &rarr;</a>
                    </div>
                </div>

                <div class="bg-[#D4EDDA] rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl">
                    <img src="https://placehold.co/600x300/1A6A61/D4EDDA?text=Blog+Post+3" alt="Blog Post Image" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-[#1A6A61] mb-2">Understanding Nutrient Deficiencies in Crops</h3>
                        <p class="text-[#333333] text-sm mb-4 line-clamp-3">A comprehensive guide to identifying common nutrient deficiencies and how Algaeo's solutions can help.</p>
                        <a href="#" class="text-[#4CAF50] hover:text-[#1A6A61] font-medium text-sm">Read More &rarr;</a>
                    </div>
                </div>

                </div>

            <div class="text-center mt-16">
                <h2 class="text-3xl font-bold text-[#1A6A61] mb-6">Stay Updated!</h2>
                <p class="text-lg text-[#333333] mb-8 max-w-2xl mx-auto">
                    Subscribe to our newsletter for the latest articles, product updates, and exclusive insights directly to your inbox.
                </p>
                <form class="max-w-md mx-auto flex flex-col sm:flex-row gap-4">
                    <input type="email" placeholder="Your Email Address" class="flex-grow px-4 py-3 rounded-md border border-gray-300 focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50]">
                    <button type="submit" class="bg-[#4CAF50] text-white px-6 py-3 rounded-md font-bold hover:bg-[#1A6A61] transition duration-300">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
