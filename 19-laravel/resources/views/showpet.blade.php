<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Pet (view)</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-emerald-900 p-12">
    <a href="{{ url()->previous() }}"
        class="inline-flex items-center mb-4 text-sm font-medium text-gray-200 hover:text-indigo-600 transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Regresar al listado
    </a>
    <h1 class="text-emerald-300 text-4xl text-center my-8">Show Pet (view)</h1>
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl border border-gray-200">
        <div class="md:flex">
            <div class="md:shrink-0">
                <img class="h-48 w-full object-cover md:h-full md:w-48" src="{{ asset('images/' . $pet->image) }}"
                    alt="Foto de {{ $pet->name }}">
            </div>

            <div class="p-8 w-full">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">
                            {{ $pet->kind }} • {{ $pet->breed }}
                        </div>
                        <h1 class="block mt-1 text-2xl leading-tight font-bold text-black">
                            {{ $pet->name }}
                        </h1>
                    </div>
                    <span
                        class="px-3 py-1 rounded-full text-xs font-medium {{ $pet->status == 'disponible' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($pet->status) }}
                    </span>
                </div>

                <p class="mt-2 text-gray-500">
                    {{ $pet->description }}
                </p>

                <div class="mt-4 grid grid-cols-2 gap-4 border-t border-gray-100 pt-4 text-sm">
                    <div>
                        <span class="text-gray-400 block uppercase">Edad</span>
                        <span class="font-bold text-gray-700">{{ $pet->age }} años</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block uppercase">Peso</span>
                        <span class="font-bold text-gray-700">{{ $pet->weight }} kg</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-gray-400 block uppercase">Ubicación</span>
                        <span class="font-bold text-gray-700">{{ $pet->location }}</span>
                    </div>
                </div>

                @if($pet->adoptions)
                    <div
                        class="mt-4 p-2 bg-blue-50 text-blue-700 text-xs font-semibold rounded border border-blue-100 flex items-center">
                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                        </svg>
                        Esta mascota ya encontró un hogar.
                    </div>
                @else
                    <div
                        class="mt-4 p-2 bg-green-50 text-green-700 text-xs font-semibold rounded border border-green-100 flex items-center">
                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                clip-rule="evenodd" />
                        </svg>
                        ¡Aún está buscando una familia!
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>