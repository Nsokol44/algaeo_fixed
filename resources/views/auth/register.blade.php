@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#D4EDDA] py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-xl shadow-lg">
    <div>
      <h2 class="mt-6 text-center text-3xl font-extrabold text-[#1A6A61]">
        Create your account
      </h2>
    </div>
    <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
      @csrf
      <div class="rounded-md shadow-sm -space-y-px">
        <div>
          <label for="name" class="sr-only">Name</label>
          <input id="name" name="name" type="text" autocomplete="name" required
                 class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] focus:z-10 sm:text-sm"
                 placeholder="Name">
        </div>
        <div>
          <label for="email-address" class="sr-only">Email address</label>
          <input id="email-address" name="email" type="email" autocomplete="email" required
                 class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] focus:z-10 sm:text-sm"
                 placeholder="Email address">
        </div>
        <div>
          <label for="password" class="sr-only">Password</label>
          <input id="password" name="password" type="password" autocomplete="new-password" required
                 class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] focus:z-10 sm:text-sm"
                 placeholder="Password">
        </div>
        <div>
          <label for="password-confirm" class="sr-only">Confirm Password</label>
          <input id="password-confirm" name="password_confirmation" type="password" autocomplete="new-password" required
                 class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] focus:z-10 sm:text-sm"
                 placeholder="Confirm Password">
        </div>
      </div>

      <div>
        <button type="submit"
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#4CAF50] hover:bg-[#1A6A61] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4CAF50]">
          Register
        </button>
      </div>
    </form>
    <div class="text-center text-sm text-gray-600">
      Already registered?
      <a href="{{ route('login') }}" class="font-medium text-[#4CAF50] hover:text-[#1A6A61]">
        Sign in
      </a>
    </div>
  </div>
</div>
@endsection