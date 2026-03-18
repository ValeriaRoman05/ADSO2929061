<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List All Pets (view)</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-emerald-900 p-12">
    <h1 class="text-emerald-300 text-4xl text-center my-8">List All Pets (view)</h1>
    <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
        <table class="table table-zebra bg-emerald-100">
            <!-- head -->
            <thead>
                <tr class="bg-emerald-950 text-emerald-200">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Kind</th>
                    <th>Breed</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pets as $pet)
                    <tr>
                        <th>{{ $pet->id }}</th>
                        <td>{{ $pet->name }}</td>
                        <td>{{ $pet->kind }}</td>
                        <td>{{ $pet->breed }}</td>
                        <td >
                            <a class="btn btn-accent bg-emerald-800 text-emerald-200 flex p-4 scale-90 hover:scale-100 transition-all" href="{{ url('view/pet/'.$pet->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256"><path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path></svg>
                            </a>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>