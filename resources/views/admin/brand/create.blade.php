<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Smoke House</title>
    <!-- Styles -->
    @vite('resources/css/app.css')
</head>

<body class="container mx-auto p-6">
@if ($errors->any())
    <div class="bg-red-500 text-white p-4 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h1 class="text-2xl font-bold mb-6">Добавление бренда</h1>
    <form action="{{ route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Название
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Название бренда" name="name" required>
        </div>
        <div class="flex items-center justify-between">
            <button
                class="primary-button"
                type="submit">
                Сохранить
            </button>
        </div>
    </div>
</body>
</html>














