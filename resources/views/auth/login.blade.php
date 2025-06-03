@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#D4EDDA] py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-xl shadow-lg">
    <div>
      <h2 class="mt-6 text-center text-3xl font-extrabold text-[#1A6A61]">
        Sign in to your account
      </h2>
    </div>
    <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
      @csrf
      <div class="rounded-md shadow-sm -space-y-px">
        <div>
          <label for="email-address" class="sr-only">Email address</label>
          <input id="email-address" name="email" type="email" autocomplete="email" required
                 class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] focus:z-10 sm:text-sm"
                 placeholder="Email address">
        </div>
        <div>
          <label for="password" class="sr-only">Password</label>
          <input id="password" name="password" type="password" autocomplete="current-password" required
                 class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] focus:z-10 sm:text-sm"
                 placeholder="Password">
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input id="remember_me" name="remember" type="checkbox"
                 class="h-4 w-4 text-[#4CAF50] focus:ring-[#4CAF50] border-gray-300 rounded">
          <label for="remember_me" class="ml-2 block text-sm text-gray-900">
            Remember me
          </label>
        </div>

        <div class="text-sm">
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="font-medium text-[#4CAF50] hover:text-[#1A6A61]">
              Forgot your password?
            </a>
          @endif
        </div>
      </div>

      <div>
        <button type="submit"
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#4CAF50] hover:bg-[#1A6A61] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4CAF50]">
          Sign in
        </button>
      </div>
    </form>
    <div class="text-center text-sm text-gray-600">
      Don't have an account?
      <a href="{{ route('register') }}" class="font-medium text-[#4CAF50] hover:text-[#1A6A61]">
        Sign up
      </a>
    </div>
  </div>
</div>
@endsection
