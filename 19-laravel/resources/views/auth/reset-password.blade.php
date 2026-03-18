{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.app')
@section('title', 'Larapets: Reset Password')
@section('content')
    <section class="bg-[#0009] outline w-96 flex flex-col justify-center text-white items-center p-4 rounded-sm">
        <h1 class="text-3xl flex gap-2 border-b-2 pb-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-10" width="32" height="32" fill="currentColor"
                viewBox="0 0 256 256">
                <path
                    d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm40-104a40,40,0,1,0-65.94,30.44L88.68,172.77A8,8,0,0,0,96,184h64a8,8,0,0,0,7.32-11.23l-13.38-30.33A40.14,40.14,0,0,0,168,112ZM136.68,143l11,25.05H108.27l11-25.05A8,8,0,0,0,116,132.79a24,24,0,1,1,24,0A8,8,0,0,0,136.68,143Z">
                </path>
            </svg>
            Reset Password
        </h1>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            {{-- email --}}
            <label class="label text-white mt-4">E-mail:</label>
            <input class="input bg-[#0009] outline-1 focus:border-white w-full" type="text" name="email"
                value="{{ old('email') }}" placeholder="jeremias@mail.com">
            @error('email')
                <small class="badge badge-error w-full">{{ $message }}</small>
            @enderror

            {{-- Password --}}
            <label class="label text-white mt-4">Password:</label>
            <input class="input bg-[#0009] outline-1 focus:border-white w-full" type="password" name="password"
                placeholder="yourSecret_123">
            @error('password')
                <small class="badge badge-error w-full">{{ $message }}</small>
            @enderror

            {{-- Password Confirmation--}}
            <label class="label text-white mt-4">Password Confirmation:</label>
            <input class="input bg-[#0009] outline-1 focus:border-white w-full" type="password" name="password_confirmation"
                placeholder="your Secret again">

            <button class="btn btn-outline mt-4 w-full">Register</button>
        </form>
    </section>
@endsection