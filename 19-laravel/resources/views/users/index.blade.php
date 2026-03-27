@extends('layouts.app')

@section('title', 'Larapets: Users')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-10" fill="currentColor" viewBox="0 0 256 256">
            <path
                d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
            </path> 
        </svg>
        Module Users
    </h1>

    {{-- Options --}}
    <div class="flex flex-col gap-4 justify-center items-center">
        <div class="join mx-auto">
            <a class="btn btn-outline btn-success join-item" href="{{ url('users/create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
                    <path
                        d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H136v32a8,8,0,0,1-16,0V136H88a8,8,0,0,1,0-16h32V88a8,8,0,0,1,16,0v32h32A8,8,0,0,1,176,128Z">
                    </path>
                </svg>
                <span class="hidden md:inline">Add User</span>
            </a>
            <a class="btn btn-outline text-white hover:bg-[#fff6] hover:text-white join-item"
                href="{{ url('export/users/pdf') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
                    <path
                        d="M224,152a8,8,0,0,1-8,8H192v16h16a8,8,0,0,1,0,16H192v16a8,8,0,0,1-16,0V152a8,8,0,0,1,8-8h32A8,8,0,0,1,224,152ZM92,172a28,28,0,0,1-28,28H56v8a8,8,0,0,1-16,0V152a8,8,0,0,1,8-8H64A28,28,0,0,1,92,172Zm-16,0a12,12,0,0,0-12-12H56v24h8A12,12,0,0,0,76,172Zm88,8a36,36,0,0,1-36,36H112a8,8,0,0,1-8-8V152a8,8,0,0,1,8-8h16A36,36,0,0,1,164,180Zm-16,0a20,20,0,0,0-20-20h-8v40h8A20,20,0,0,0,148,180ZM40,112V40A16,16,0,0,1,56,24h96a8,8,0,0,1,5.66,2.34l56,56A8,8,0,0,1,216,88v24a8,8,0,0,1-16,0V96H152a8,8,0,0,1-8-8V40H56v72a8,8,0,0,1-16,0ZM160,80h28.69L160,51.31Z">
                    </path>
                </svg>
                <span class="hidden md:inline">Export</span>
            </a>
            <a class="btn btn-outline text-white hover:bg-[#fff6] hover:text-white join-item"
                href="{{ url('export/users/excel') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
                    <path
                        d="M156,208a8,8,0,0,1-8,8H120a8,8,0,0,1-8-8V152a8,8,0,0,1,16,0v48h20A8,8,0,0,1,156,208ZM92.65,145.49a8,8,0,0,0-11.16,1.86L68,166.24,54.51,147.35a8,8,0,1,0-13,9.3L58.17,180,41.49,203.35a8,8,0,0,0,13,9.3L68,193.76l13.49,18.89a8,8,0,0,0,13-9.3L77.83,180l16.68-23.35A8,8,0,0,0,92.65,145.49Zm98.94,25.82c-4-1.16-8.14-2.35-10.45-3.84-1.25-.82-1.23-1-1.12-1.9a4.54,4.54,0,0,1,2-3.67c4.6-3.12,15.34-1.72,19.82-.56a8,8,0,0,0,4.07-15.48c-2.11-.55-21-5.22-32.83,2.76a20.58,20.58,0,0,0-8.95,14.95c-2,15.88,13.65,20.41,23,23.11,12.06,3.49,13.12,4.92,12.78,7.59-.31,2.41-1.26,3.33-2.15,3.93-4.6,3.06-15.16,1.55-19.54.35A8,8,0,0,0,173.93,214a60.63,60.63,0,0,0,15.19,2c5.82,0,12.3-1,17.49-4.46a20.81,20.81,0,0,0,9.18-15.23C218,179,201.48,174.17,191.59,171.31ZM40,112V40A16,16,0,0,1,56,24h96a8,8,0,0,1,5.66,2.34l56,56A8,8,0,0,1,216,88v24a8,8,0,1,1-16,0V96H152a8,8,0,0,1-8-8V40H56v72a8,8,0,0,1-16,0ZM160,80h28.68L160,51.31Z">
                    </path>
                </svg>
                <span class="hidden md:inline">Export</span>
            </a>
            <form class="join-item" action="{{ url('import/users') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" id="file" class="hidden"
                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                <button type="button"
                    class="btn btn-outline rounded-s-none text-white hover:bg-[#fff6] hover:text-white btn-import">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M213.66,82.34l-56-56A8,8,0,0,0,152,24H56A16,16,0,0,0,40,40V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V88A8,8,0,0,0,213.66,82.34ZM160,51.31,188.69,80H160ZM200,216H56V40h88V88a8,8,0,0,0,8,8h48V216Zm-42.34-77.66a8,8,0,0,1-11.32,11.32L136,139.31V184a8,8,0,0,1-16,0V139.31l-10.34,10.35a8,8,0,0,1-11.32-11.32l24-24a8,8,0,0,1,11.32,0Z">
                        </path>
                    </svg>
                    <span class="hidden md:inline">Import</span>
                </button>
            </form>
        </div>
        {{-- Search --}}
        <label class="input text-white bg-[#0009] w-58 md:w-112 outline outline-white mb-10">
            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </g>
            </svg>
            <input type="search" placeholder="Search..." name="qsearch" id="qsearch" />
        </label>
    </div>

    <div class="overflow-x-auto rounded-box text-white border border-base-content/5 bg-black/70">
        <table class="table">
            <!-- head -->
            <thead>
                <tr class="text-white">
                    <th class="hidden md:table-cell">ID</th>
                    <th>Photo</th>
                    <th class="hidden md:table-cell">Document</th>
                    <th>FullName</th>
                    <th class="hidden md:table-cell">Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="text-white even:bg-blue-900">
                        <td class="hidden md:table-cell">{{ $user->id }}</td>
                        <td>
                            <div class="avatar">
                                <div class="mask mask-squircle w-14">
                                    <img src="{{ asset('images/' . $user->photo)}}" alt="">
                                </div>
                            </div>
                        </td>
                        <td class="hidden md:table-cell">{{ $user->document }}</td>
                        <td>{{ $user->fullname }}</td>
                        <td class="hidden md:table-cell">{{ $user->email }}</td>
                        <td>
                            @if ($user->role == 'Admin')
                                <span class="badge badge-outline badge-accent">Admin</span>
                            @else
                                <span class="badge badge-outline badge-info">Customer</span>
                            @endif
                        </td>
                        <td class="flex gap-1 justify-center items-center h-20">
                            <a href="{{ url('users/' . $user->id) }}" class="btn btn-outline btnxs btn-default">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentcolor"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M237.2,151.87v0a47.1,47.1,0,0,0-2.35-5.45L193.26,51.8a7.82,7.82,0,0,0-1.66-2.44,32,32,0,0,0-45.26,0A8,8,0,0,0,144,55V80H112V55a8,8,0,0,0-2.34-5.66,32,32,0,0,0-45.26,0,7.82,7.82,0,0,0-1.66,2.44L21.15,146.4a47.1,47.1,0,0,0-2.35,5.45v0A48,48,0,1,0,112,168V96h32v72a48,48,0,1,0,93.2-16.13ZM76.71,59.75a16,16,0,0,1,19.29-1v73.51a47.9,47.9,0,0,0-46.79-9.92ZM64,200a32,32,0,1,1,32-32A32,32,0,0,1,64,200ZM160,58.74a16,16,0,0,1,19.29,1l27.5,62.58A47.9,47.9,0,0,0,160,132.25ZM192,200a32,32,0,1,1,32-32A32,32,0,0,1,192,200Z">
                                    </path>
                                </svg></a>
                            <a href="{{ url('users/' . $user->id . '/edit') }}" class="btn btn-outline btnxs btn-default">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM51.31,160,136,75.31,152.69,92,68,176.68ZM48,179.31,76.69,208H48Zm48,25.38L79.31,188,164,103.31,180.69,120Zm96-96L147.31,64l24-24L216,84.68Z">
                                    </path>
                                </svg>
                            </a>
                            <a href="javascript:;" class="btn btn-outline btnxs btn-error btn-delete"
                                data-fullname="{{ $user->fullname }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z">
                                    </path>
                                </svg>
                            </a>
                            <form class="hidden" method="POST" action="{{ url('users/' . $user->id) }}">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7">
                        {{ $users->links('partials.pagination') }}
                    </td>
                </tr>

            </tfoot>
        </table>
    </div>
@endsection

@section('js')
    <script>
        //Mensajes
        @if(session('message'))
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('message') }}",
                showConfirmButton: false,
                timer: 4500
            });
        @endif

        //Delete 
        $('.btn-delete').click(function () {

            $fullname=$(this).attr('data-fullname')
            Swal.fire({
                title: "Are you sure?",
                text: "The User: "+ $fullname +"  will be deleted!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed){
                    $(this).next().submit()
                }
            });
        })
    </script>
@endsection