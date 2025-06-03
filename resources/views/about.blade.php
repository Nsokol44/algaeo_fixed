@extends('layouts.app')

@section('content')
<div class="py-12 bg-[#D4EDDA] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-8 md:p-10 lg:p-12 border border-[#D4EDDA]">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-[#1A6A61] mb-6 text-center">About Algaeo</h1>
            <p class="text-lg text-[#333333] mb-8 text-center max-w-3xl mx-auto">
                At Algaeo, we're revolutionizing agriculture by empowering growers with cutting-edge, nature-based solutions for optimal soil health and crop productivity.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-[#4CAF50] mb-4">Our Mission</h2>
                    <p class="text-lg text-[#333333] mb-4">
                        Our mission is to foster a sustainable future for agriculture by providing growers with accessible, data-driven tools to enhance soil vitality and maximize yields through the power of microalgae and beneficial microbes.
                    </p>
                    <p class="text-lg text-[#333333]">
                        We believe in a world where farming is more efficient, environmentally friendly, and yields healthier crops for everyone.
                    </p>
                </div>
                <div class="flex justify-center">
                    <img src="https://placehold.co/600x400/D4EDDA/1A6A61?text=Our+Mission" alt="Algaeo Mission" class="rounded-lg shadow-md">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-12">
                <div class="flex justify-center order-2 md:order-1">
                    <img src="https://placehold.co/600x400/D4EDDA/1A6A61?text=The+Problem" alt="Farming Problem" class="rounded-lg shadow-md">
                </div>
                <div class="order-1 md:order-2">
                    <h2 class="text-3xl font-bold text-[#4CAF50] mb-4">The Challenge We Address</h2>
                    <p class="text-lg text-[#333333] mb-4">
                        Modern agriculture faces significant challenges: declining soil health, increasing reliance on synthetic inputs, and unpredictable yields. Traditional methods of soil analysis can be costly, time-consuming, and often provide delayed insights.
                    </p>
                    <p class="text-lg text-[#333333]">
                        Growers need a simpler, faster, and more effective way to understand their fields and make informed decisions that promote long-term sustainability.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-[#4CAF50] mb-4">Our Innovative Solution</h2>
                    <p class="text-lg text-[#333333] mb-4">
                        Algaeo leverages AI-powered image analysis combined with the natural intelligence of microalgae and beneficial microbes. Simply upload a photo of your plant, soil, or field, and our platform provides instant, actionable insights.
                    </p>
                    <p class="text-lg text-[#333333]">
                        We then recommend precise Algaeo microbe consortia tailored to correct specific issues, ensuring your crops receive exactly what they need for optimal growth and resilience.
                    </p>
                </div>
                <div class="flex justify-center">
                    <img src="https://placehold.co/600x400/D4EDDA/1A6A61?text=Algaeo+Solution" alt="Algaeo Solution" class="rounded-lg shadow-md">
                </div>
            </div>

            <div class="text-center mt-12">
                <h2 class="text-3xl font-bold text-[#1A6A61] mb-6">Join the Algaeverse!</h2>
                <p class="text-lg text-[#333333] mb-8 max-w-2xl mx-auto">
                    Be part of a growing community of farmers who are transforming their operations with smart, sustainable, and science-backed microbial solutions.
                </p>
                <a href="{{ route('register') }}" class="bg-[#4CAF50] text-white px-8 py-4 rounded-md text-xl font-bold hover:bg-[#1A6A61] transition duration-300">
                    Get Started Today
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
