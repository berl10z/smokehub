@extends('layouts.app')

@section('content')
<h2 class="text-center text-2xl font-bold my-5 uppercase">каталог</h2>
<div class="container mx-auto">
    <form class="flex max-md:flex-col gap-x-3 px-3" action="{{ route('catalog') }}" method="get">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
                Категория
            </label>
            <select
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="category_id" name="category_id">
                <option value="">Выберите категорию</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
                Бренд
            </label>
            <select
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="brand_id" name="brand_id">
                <option value="">Выберите бренд</option>
                @foreach ($brands as $b)
                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Название
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="name" type="text" placeholder="Название продукта" name="name">
        </div>
        <button class="mt-3 h-max self-center primary-button" type="submit">Подтвердить</button>
    </form>
    <div class="mt-5">
        <div class="divide-y divide-gray-300">
            @forelse ($products as $product)
                <div class="py-5 m-5">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/64' }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover rounded-md">
                        </div>
                        <div class="flex-1 ml-4">
                            <p class="text-gray-600">Категория: {{ $product->category->name ?? 'Без категории' }}</p>
                            <p class="text-gray-600">Бренд: {{ $product->brand->name ?? 'Без бренда' }}</p>
                            <p class="text-lg font-semibold text-gray-800">{{ $product->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <p class="text-2xl font-bold">{{ ($product->price) }} ₽ </p>
                        <form action="{{ route('product.show', $product->id) }}" method="get">
                            <button class="w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white text-lg font-bold rounded-lg flex items-center justify-center">
                                +
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 text-xl">Нет в наличии</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
