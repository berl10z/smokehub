<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Smoke House</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
            Название
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Название продукта" name="name" value="{{ old('name', $product->name) }}" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
            Описание
        </label>
        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" placeholder="Описание продукта" name="description" required>{{ old('description', $product->description) }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
            Изображение
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="image" type="file" name="image">
        @if ($product->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $product->image) }}" alt="Текущее изображение" class="w-32 h-32 object-cover">
            </div>
            @else
            <img src="https://via.placeholder.com/128" alt="Placeholder" class="w-32 h-32 object-cover">
        @endif
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
            Количество
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="price" type="number" step="1" placeholder="Количество" name="count" value="{{ old('count', $product->count) }}" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
            Цена
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="price" type="number" step="0.01" placeholder="Цена" name="price" value="{{ old('price', $product->price) }}" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
            Бренд
        </label>
        <select
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="brand_id" name="brand_id">
            <option value="">Выберите бренд</option>
            @foreach ($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
            Категория
        </label>
        <select
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="category_id" name="category_id">
            <option value="">Выберите категорию</option>
            @foreach ($categories as $c)
                <option value="{{ $c->id }}" {{ $product->category_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
            @endforeach
        </select>
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
