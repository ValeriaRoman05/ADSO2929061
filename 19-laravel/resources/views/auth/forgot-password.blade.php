{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password
        reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.app')
@section('title', 'Larapets: Forgot Password')
@section('content')
    <section class="bg-[#0009] outline w-96 flex flex-col justify-center text-white items-center p-4 rounded-sm">
        <h1 class="text-3xl flex gap-2 border-b-2 pb-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-10" width="32" height="32" fill="currentColor"
                viewBox="0 0 256 256">
                <path
                    d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm40-104a40,40,0,1,0-65.94,30.44L88.68,172.77A8,8,0,0,0,96,184h64a8,8,0,0,0,7.32-11.23l-13.38-30.33A40.14,40.14,0,0,0,168,112ZM136.68,143l11,25.05H108.27l11-25.05A8,8,0,0,0,116,132.79a24,24,0,1,1,24,0A8,8,0,0,0,136.68,143Z">
                </path>
            </svg>
            Forgot your password
        </h1>
        <p>
            Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </p>

        <form class="flex flex-col gap-2 w-full" action="{{ route('password.email') }}"" method="POST">
            @csrf
            @if (session('status'))
                <span class="badge badge-success my-8 w-full">{{ session('status') }}</span>
            @endif
            <label class="label text-white">Email:</label>
            <input class="input bg-[#0009] outline-1 focus:border-white w-full" type="text" name="email"
                value="{{ old('email') }}" placeholder="username@mail.com">
            @error('email')
                <small class="badge badge-error w-full">{{ $message }}</small>
            @enderror
            <button class="btn btn-outline mt-4">Email Password Reset Link</button>
        </form>
    </section>
@endsection