@extends('layouts.app')

@section('content')
<div class="py-12 bg-[#D4EDDA] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-8 md:p-10 lg:p-12 border border-[#D4EDDA]">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-[#1A6A61] mb-6 text-center">Contact Us</h1>
            <p class="text-lg text-[#333333] mb-10 text-center max-w-3xl mx-auto">
                Have questions, feedback, or need support? Reach out to the Algaeo team. We're here to help you grow.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div>
                    {{-- Conditional display: Show thank you message if submitted, otherwise show the form --}}
                    @if(isset($submitted) && $submitted)
                        <div class="text-center py-10">
                            <h2 class="text-3xl font-bold text-[#4CAF50] mb-4">Thank You for Your Submission!</h2>
                            <p class="text-xl text-[#333333]">We appreciate you reaching out. We will be with you shortly.</p>
                            <a href="{{ url('/') }}" class="inline-flex justify-center py-3 px-8 mt-6 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-[#1A6A61] hover:bg-[#4CAF50] transition duration-300">
                                Go to Homepage
                            </a>
                        </div>
                    @else
                        <h2 class="text-3xl font-bold text-[#4CAF50] mb-6">Send Us a Message</h2>
                        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-[#333333]">Name</label>
                                <input type="text" name="name" id="name" required
                                       class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-base">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-[#333333]">Email</label>
                                <input type="email" name="email" id="email" required
                                       class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-base">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="subject" class="block text-sm font-medium text-[#333333]">Subject</label>
                                <input type="text" name="subject" id="subject"
                                       class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-base">
                                @error('subject')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-[#333333]">Message</label>
                                <textarea name="message" id="message" rows="5" required
                                          class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-base"></textarea>
                                @error('message')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <button type="submit" class="inline-flex justify-center py-3 px-8 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-[#4CAF50] hover:bg-[#1A6A61] transition duration-300">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    @endif
                </div>

                <div>
                    <h2 class="text-3xl font-bold text-[#4CAF50] mb-6">Our Details</h2>
                    <div class="space-y-6 text-lg text-[#333333]">
                        <p><strong>Email:</strong> <a href="mailto:algaeo@algaeo.io" class="text-[#1A6A61] hover:underline">algaeo@algaeo.io</a></p>


                        </p>
                        <div class="flex space-x-4 mt-4">
                            <a href="#" class="text-[#1A6A61] hover:text-[#4CAF50] text-2xl" aria-label="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.353c-.567 0-.647.286-.647.747v1.253h2l-.26 2h-1.74v6h-3v-6h-2v-2h2v-1.192c0-1.922 1.061-2.808 3.132-2.808h1.868v3z"/></svg>
                            </a>
                            <a href="#" class="text-[#1A6A61] hover:text-[#4CAF50] text-2xl" aria-label="Twitter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.592 0-6.492 2.901-6.492 6.492 0 .512.057 1.01.169 1.497-5.402-.27-10.192-2.868-13.407-6.812-.56.96-.883 2.077-.883 3.251 0 2.254 1.144 4.248 2.873 5.422-.845-.025-1.63-.26-2.32-.64v.081c0 3.154 2.24 5.787 5.215 6.39-.545.149-1.115.23-1.702.23-.417 0-.82-.041-1.215-.116.82 2.578 3.203 4.45 6.038 4.49-.009.009-.018.018-.027.027-2.261 1.77-5.126 2.823-8.239 2.823-.538 0-1.069-.026-1.59-.079 3.066 1.96 6.726 3.102 10.686 3.102 12.826 0 19.774-10.974 19.774-20.533 0-.317-.01-.63-.025-.945.859-.62 1.606-1.396 2.195-2.278z"/></svg>
                            </a>
                            <a href="#" class="text-[#1A6A61] hover:text-[#4CAF50] text-2xl" aria-label="LinkedIn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.493-1.1-1.093s.493-1.093 1.1-1.093c.607 0 1.1.493 1.1 1.093s-.493 1.093-1.1 1.093zm7 6.891h-2v-3.5c0-.811-.531-1.488-1.328-1.488-.802 0-1.168.55-1.168 1.488v3.5h-2v-6h2v1.732c.699-1.216 1.898-1.732 3.136-1.732 2.079 0 3.364 1.22 3.364 3.867v2.133z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection