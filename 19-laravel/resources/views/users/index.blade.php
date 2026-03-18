@extends('layouts.app')

@section('title', 'Larapets:Module Users')

@section('content')
 @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
            <path
                d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-96,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48Z">
            </path>
        </svg>
        Module Users
    </h1>
    <table class="table bg-black/50 text-white">
        <thead>
            <th>ID</th>
            <th>Document</th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </thead>
        <body>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->document}}</td>
                <td>{{ $user->fullname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="6">{{ $users->links() }}</td>
            </tr>
        </body>
    </table>
@endsection