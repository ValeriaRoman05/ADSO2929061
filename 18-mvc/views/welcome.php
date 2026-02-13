<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC: Model | View | Controller</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

    <body class="bg-red-300 min-h-[100dvh] text-black p-12"></body>
    <h1 class="text-4xl text-center font-bold">MVC</h1>
    <small class="block text-center">Model | View | Controller</small>

    <h2 class="my-10 text-center text-xl font-bold border-b-1 pb-2">List Pokemons</h2>
    <a href="" class="btn flex mx-auto w-[200px] my-4 bg-violet-300 hover:bg-violet-400 text-black">
    Add Pokemons
    </a>

    <table class="table bg-white text-black">
        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Type</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php foreach($data as $pokemons): ?>
                <tr>
                    <td><?=htmlspecialchars($pokemons['id'])?></td>
                    <td><?=htmlspecialchars($pokemons['name'])?></td>
                    <td><?=htmlspecialchars($pokemons['type'])?></td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>