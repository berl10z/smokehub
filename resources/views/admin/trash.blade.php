@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen flex flex-col">
    <div class="bg-gray-900 p-6 flex-1 flex flex-col">
        <header class="flex justify-between items-center mb-6">
            <h1 class="text-white text-xl font-medium">Панель управления</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-1.5 bg-red-700 hover:bg-gray-600 transition-colors text-white text-sm">
                    Выйти
                </button>
            </form>
        </header>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 flex items-center gap-3 hover:shadow-lg transition-shadow">
                <span class="material-icons text-green-500">inventory_2</span>
                <div>
                    <p class="text-sm text-gray-600">Количество товаров в корзине</p>
                    <p class="text-xl font-semibold text-gray-900">{{ $trashCount }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 mb-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Изображение
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Название
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Категория
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Бренд
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Описание
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Количество
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Цена
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Действия
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($trash as $tr)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $tr->image) }}" alt="Product" class="w-20 h-20 object-contain">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $tr->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $tr->category?->name ?? 'Без категории'}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $tr->brand?->name ?? 'Без категории'}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ Str::limit($tr->description, 50) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $tr->count }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $tr->price }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="space-y-2 flex flex-col items-center">
                                        <button class="edit-button px-4 py-2 cursor-pointer bg-yellow-500 hover:bg-yellow-600 transition-colors text-white rounded-lg flex items-center justify-center gap-2 w-full"
                                                data-id="{{ $tr->id }}">
                                            <span class="material-icons">edit</span>
                                            <a href="{{ route('admin.product.edit',$tr->id) }}">Изменить</a>
                                        </button>
                                        <form class="w-full" action="{{ route('admin.product.restore', $tr->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="submit-button px-4 py-2 bg-green-500 hover:bg-green-600 cursor-pointer transition-colors text-white rounded-lg flex items-center justify-center gap-2 w-full"
                                                    data-id="{{ $tr->id }}">
                                                <span class="material-icons">restore</span>
                                                Восстановить
                                            </button>
                                        </form>
                                        <form class="w-full" action="{{ route('admin.product.forceDelete', $tr->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="delete-button px-4 py-2 cursor-pointer bg-red-500 hover:bg-red-600 transition-colors text-white rounded-lg flex items-center justify-center gap-2 w-full">
                                                Удалить окончательно
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
