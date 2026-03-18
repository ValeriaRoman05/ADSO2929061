<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" /> --}}
    <link href="{{asset('css/daisyui5.css')}}" rel="stylesheet" type="text/css" />
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}
    <script src={{asset('js/tailwindcss4.js')}}></script>
</head>

@auth
    @php
        (Auth::user()->role == 'Admin') ? $colors = '#0099,#0090' : $colors = '#0909,#0900'
    @endphp
    
@else
    @php $colors = '#000c_80%,#0000' @endphp
@endauth

<body class="bg-[linear-gradient(to_top,{{$colors}}),url({{ asset('images/bg-welcome.png') }})] min-h-dvh bg-no-repeat bg-center bg-fixed pt-14 bg-cover">
    <main class="p-12 flex flex-col gap-2 justify-center items-center min-h-dvh">
        @yield('content')
    </main>
</body>

</html>