@extends('layouts.app')
@section('title', 'larapets: Welcome')
@section('content')
    <div class="bg-[#0009] w-[380px] flex flex-col justify-center text-white items-center p-4 rounded-sm">
        <img class="w-[240px]" src="{{ asset('images/logo.png') }}">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, excepturi pariatur voluptatibus facere
            voluptatum dolores quibusdam molestiae ullam! Molestiae reprehenderit nulla explicabo adipisci nisi, porro nemo
            aspernatur corporis laborum ipsam?
        </p>

        <div class="flex gap-2 justify-between mt-8">
            @guest
                <a class="btn btn-outline w-[160px]" href="{{ url('login') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" width="32" height="32" fill="currentColor"
                        viewBox="0 0 256 256">
                        <path
                            d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm40-104a40,40,0,1,0-65.94,30.44L88.68,172.77A8,8,0,0,0,96,184h64a8,8,0,0,0,7.32-11.23l-13.38-30.33A40.14,40.14,0,0,0,168,112ZM136.68,143l11,25.05H108.27l11-25.05A8,8,0,0,0,116,132.79a24,24,0,1,1,24,0A8,8,0,0,0,136.68,143Z">
                        </path>
                    </svg>
                    Login
                </a>
                <a class="btn btn-outline w-[160px]" href="{{ url('register') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" width="32" height="32" fill="currentColor"
                        viewBox="0 0 256 256">
                        <path
                            d="M256,136a8,8,0,0,1-8,8H232v16a8,8,0,0,1-16,0V144H200a8,8,0,0,1,0-16h16V112a8,8,0,0,1,16,0v16h16A8,8,0,0,1,256,136Zm-57.87,58.85a8,8,0,0,1-12.26,10.3C165.75,181.19,138.09,168,108,168s-57.75,13.19-77.87,37.15a8,8,0,0,1-12.25-10.3c14.94-17.78,33.52-30.41,54.17-37.17a68,68,0,1,1,71.9,0C164.6,164.44,183.18,177.07,198.13,194.85ZM108,152a52,52,0,1,0-52-52A52.06,52.06,0,0,0,108,152Z">
                        </path>
                    </svg>
                    Register
                </a>
            @endguest
            @auth
            <a class="btn btn-outline w-[160px]" href="{{ url('dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-96,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48Z">
                    </path>
                </svg>
                Dashboard
            </a>
            @endauth
        </div>
    </div>
@endsection