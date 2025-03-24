<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smoke House</title>
    @vite('resources/css/app.css')
</head>
<body class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Редактирование категории</h1>
    @if ($errors->any())
    <div class="bg-red-500 text-white p-4 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
            Название
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Название категории" name="name" value="{{ old('name', $category->name) }}" required>
    </div>

    <div class="flex items-center justify-between">
        <button
            class="primary-button"
            type="submit">
            Обновить
        </button>
    </div>
</form>
</body>
</html>
