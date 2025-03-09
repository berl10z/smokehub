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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @forelse ($products as $product)
            <div class="bg-white p-4 rounded-lg shadow-md product" data-id="2" data-name="Товар 2" data-price="2000">
                <div class="flex justify-center items-center">
                    <div class="w-64 h-64 sm:w-72 sm:h-72 md:w-80 md:h-80 lg:w-96 lg:h-96 xl:w-64 xl:h-64 overflow-hidden">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/250' }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                    </div>
                </div>
                <p class="text-lg font-bold">{{ $product->name }}</p>
                <p class="text-gray-600">Категория: {{ $product->category->name ?? 'Без категории' }}</p>
                <p class="text-gray-600">Цена: {{ $product->price }}</p>
                <p class="text-gray-600">Бренд: {{ $product->brand->name ?? 'Без бренда' }}</p>
                <p class="text-gray-600">
                    Количество товара:
                    @if ($product->count > 0)
                        {{ $product->count }}
                    @else
                        нет в наличии
                    @endif
                </p>
                <form action="{{ route('product.show', $product->id) }}" method="get">
                    <button class="mt-3 primary-button">Подробнее
                    </button>
                </form>
            </div>
        @empty
        <p class="text-gray-600 text-xl" >Нет в наличии</p>
        @endforelse
    </div>
</div>
@endsection
