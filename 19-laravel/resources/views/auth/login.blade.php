

@extends('layouts.app')
@section('title', 'Larapets: Login')
@section('content')
    <section class="bg-[#0009] outline w-80 flex flex-col justify-center text-white items-center p-4 rounded-sm w-96">
        <h1 class="text-4xl flex gap-2 border-b-2 pb-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-10" width="32" height="32" fill="currentColor"
                viewBox="0 0 256 256">
                <path
                    d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm40-104a40,40,0,1,0-65.94,30.44L88.68,172.77A8,8,0,0,0,96,184h64a8,8,0,0,0,7.32-11.23l-13.38-30.33A40.14,40.14,0,0,0,168,112ZM136.68,143l11,25.05H108.27l11-25.05A8,8,0,0,0,116,132.79a24,24,0,1,1,24,0A8,8,0,0,0,136.68,143Z">
                </path>
            </svg>
            Login
        </h1>
        <form class="flex flex-col gap-2 w-full" action="{{ url('login') }}" method="POST">
            @csrf
            {{ session('status') }}
            <label class="label text-white">Email:</label>
            <input class="input bg-[#0009] outline-1 focus:boder-white w-full"  type="text" name="email" value="{{ old('email') }}" placeholder="username@mail.com">
            @error('email')
                <small class="badge badge-error w-full">{{ $message }}</small>
            @enderror
            <label class="label text-white">Password:</label>
            <input class="input bg-[#0009] outline-1 focus:boder-white w-full" type="password" name="password" placeholder="yoursecret">
            @error('password')
                <small class="badge badge-error w-full">{{ $message }}</small>
            @enderror
            <button class="btn btn-outline mt-4">Login</button>
            @if (Route::has('password.request'))
                <a class="text-sm mt-4 pb-1 border-b-1 w-fit text-white  hover:text-[#fff6]" 
                href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </form>
    </section>
@endsection