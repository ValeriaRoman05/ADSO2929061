@forelse ($users as $user)
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
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentcolor" viewBox="0 0 256 256">
                    <path
                        d="M237.2,151.87v0a47.1,47.1,0,0,0-2.35-5.45L193.26,51.8a7.82,7.82,0,0,0-1.66-2.44,32,32,0,0,0-45.26,0A8,8,0,0,0,144,55V80H112V55a8,8,0,0,0-2.34-5.66,32,32,0,0,0-45.26,0,7.82,7.82,0,0,0-1.66,2.44L21.15,146.4a47.1,47.1,0,0,0-2.35,5.45v0A48,48,0,1,0,112,168V96h32v72a48,48,0,1,0,93.2-16.13ZM76.71,59.75a16,16,0,0,1,19.29-1v73.51a47.9,47.9,0,0,0-46.79-9.92ZM64,200a32,32,0,1,1,32-32A32,32,0,0,1,64,200ZM160,58.74a16,16,0,0,1,19.29,1l27.5,62.58A47.9,47.9,0,0,0,160,132.25ZM192,200a32,32,0,1,1,32-32A32,32,0,0,1,192,200Z">
                    </path>
                </svg></a>
            <a href="{{ url('users/' . $user->id . '/edit') }}" class="btn btn-outline btnxs btn-default">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                    <path
                        d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM51.31,160,136,75.31,152.69,92,68,176.68ZM48,179.31,76.69,208H48Zm48,25.38L79.31,188,164,103.31,180.69,120Zm96-96L147.31,64l24-24L216,84.68Z">
                    </path>
                </svg>
            </a>
            <a href="javascript:;" class="btn btn-outline btnxs btn-error btn-delete" data-fullname="{{ $user->fullname }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
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
    @empty
    <tr>
        <td colspan="7">
            <p class="text-xl text-center py-20">No results...</p>
        </td>
    </tr>
@endforelse