@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div class="w-150">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/250' }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
        </div>
        <div>
            <h1 class="text-4xl font-bold text-gray-900">{{ $product->name }}</h1>
            <p class="text-gray-700 text-2xl mt-4">
                <strong>Описание:</strong>
                {{ $product->description }}
            </p>
            <div class="mt-6">
                <span class="text-4xl font-bold text-blue-600">{{ number_format($product->price, 2) }} ₽</span>
            </div>

            <div class="mt-4 text-2xl text-gray-600">
                <p><strong>Категория:</strong> {{ $product->category->name ?? 'Без категории' }}</p>
                <p><strong>Бренд:</strong> {{ $product->brand->name ?? 'Без бренда' }}</p>
                <p class="text-gray-600">
                    <strong>Количество товара:</strong>
                    @if ($product->count > 0)
                        {{ $product->count }}
                    @else
                        нет в наличии
                    @endif
                </p>
            </div>

            <button class="mt-6 primary-button">
                 <a href="https://t.me/smoke_house55" target="_blank">Купить</a>
            </button>
        </div>
    </div>
</div>
@endsection
