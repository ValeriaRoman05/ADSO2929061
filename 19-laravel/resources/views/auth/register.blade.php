
@extends('layouts.app')
@section('title', 'Larapets: Register')
@section('content')
    <section class="bg-[#0009] outline w-96 flex flex-col justify-center text-white items-center p-4 rounded-sm">
        <h1 class="text-4xl flex gap-2 border-b-2 pb-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-10" width="32" height="32" fill="currentColor"
                viewBox="0 0 256 256">
                <path
                    d="M256,136a8,8,0,0,1-8,8H232v16a8,8,0,0,1-16,0V144H200a8,8,0,0,1,0-16h16V112a8,8,0,0,1,16,0v16h16A8,8,0,0,1,256,136Zm-57.87,58.85a8,8,0,0,1-12.26,10.3C165.75,181.19,138.09,168,108,168s-57.75,13.19-77.87,37.15a8,8,0,0,1-12.25-10.3c14.94-17.78,33.52-30.41,54.17-37.17a68,68,0,1,1,71.9,0C164.6,164.44,183.18,177.07,198.13,194.85ZM108,152a52,52,0,1,0-52-52A52.06,52.06,0,0,0,108,152Z">
                </path>
            </svg>
            Register
        </h1>
        <form  class="flex flex-col"  method="POST" action="{{ route('register') }} ">
            @csrf
            <div class="w-full md-w80">
                {{-- Document --}}
                <label class="label text-white">Document:</label>
                <input class="input bg-[#0009] outline-1 focus:border-white w-full" type="text" name="document"
                    value="{{ old('document') }}" placeholder="75000010">
                @error('document')
                    <small class="badge badge-error w-full">{{ $message }}</small>
                @enderror

                {{-- Ful Name --}}
                <label class="label text-white">Full Name:</label>
                <input class="input bg-[#0009] outline-1 focus:border-white w-full" type="text" name="fullname"
                    value="{{ old('fullname') }}" placeholder="Jeremias Springfield">
                @error('fullname')
                    <small class="badge badge-error w-full">{{ $message }}</small>
                @enderror

                {{-- Gender --}}
                <label class="label text-white">Gender:</label>
                <select class="select bg-[#0009] outline-1 focus:border-white w-full" name="gender">
                    <option value="">Select...</option>
                    <option value="Female" @if(old('gender')=='Female') selected @endif>Female</option>
                    <option value="Male" @if(old('gender')=='Male') selected @endif>Male</option>
                </select>
                @error('gender')
                    <small class="badge badge-error w-full">{{ $message }}</small>
                @enderror

                {{-- Birthdate --}}
                <label class="label text-white">Birthdate:</label>
                <input class="input bg-[#0009] outline-1 focus:border-white w-full" type="text" name="birthdate"
                    value="{{ old('birthdate') }}" placeholder="1990-12-25">
                @error('birthdate')
                    <small class="badge badge-error w-full">{{ $message }}</small>
                @enderror

            </div>
            <div class="w-full md-w80">
                {{-- Phone --}}
                <label class="label text-white">Phone:</label>
                <input class="input bg-[#0009] outline-1 focus:border-white w-full" type="text" name="phone"
                    value="{{ old('phone') }}" placeholder="320000010">
                @error('phone')
                    <small class="badge badge-error w-full">{{ $message }}</small>
                @enderror

                {{-- email --}}
                <label class="label text-white">E-mail:</label>
                <input class="input bg-[#0009] outline-1 focus:border-white w-full" type="text" name="email"
                    value="{{ old('email') }}" placeholder="jeremias@mail.com">
                @error('email')
                    <small class="badge badge-error w-full">{{ $message }}</small>
                @enderror

                {{-- Password --}}
                <label class="label text-white">Password:</label>
                <input class="input bg-[#0009] outline-1 focus:border-white w-full" type="password" name="password"
                    placeholder="yourSecret_123">
                @error('password')
                    <small class="badge badge-error w-full">{{ $message }}</small>
                @enderror

                {{-- Password Confirmation--}}
                <label class="label text-white">Password:</label>
                <input class="input bg-[#0009] outline-1 focus:border-white w-full" type="password"
                    name="Password_confirmation" placeholder="your Secret again">
                @error('Password_confirmation')
                    <small class="badge badge-error w-full">{{ $message }}</small>
                @enderror

                <button class="btn btn-outline">Register</button>
            </div>
        </form>
    </section>
@endsection