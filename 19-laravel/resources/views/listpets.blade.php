<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-purple-800 p-12">
    <h1 class="text-purple-200 text-4xl text-center mb-8 pt-8">List All Pets </h1>
    <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
  <table class="table table-zebra bg-purple-200">
    <!-- head -->
    <thead>
      <tr class="bg-black-200 text-white-400">
        <th>Id</th>
        <th>Name</th>
         <th>kind</th>
        <th>Breed</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ( $pets as $pet )
      <tr>
        <th>{{ $pet->id }}</th>
        <td>{{ $pet->name }}</td>
        <td>{{ $pet->kind }}</td>
        <td>{{ $pet->breed }}</td>
        <td> <a 
        class="btn btn-accent bg-purple-800 text-pueple-200 flex p-3"
        href="{{ url('view/pet/'.$pet->id) }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path></svg>
      </a>
    </tr>
    </td>
    @endforeach
    </tbody>
  </table>
</div>
</body>
</html>