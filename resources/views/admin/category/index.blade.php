@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
        {{ session('success') }}
    </div>
@endif
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

        <div class="bg-white p-4 mb-6">
            <div class="overflow-x-auto">
                <div class="flex justify-end gap-3 mb-6">
                    <button id="addProductButton" class="px-4 py-2 bg-green-500 hover:bg-green-600 transition-colors text-white rounded-lg items-center gap-2">
                        <a class="flex items-center" href="{{ route('admin.category.create') }}">
                            <span class="material-icons">add</span>
                            Добавить категорию
                        </a>
                     </button>
                  </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Название
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($categories as $сategory)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $сategory->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="space-y-2 flex flex-col items-center">
                                        <button class="edit-button px-4 py-2 cursor-pointer bg-yellow-500 hover:bg-yellow-600 transition-colors text-white rounded-lg flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.category.edit', $сategory->id) }}">
                                                <span class="material-icons">edit</span>
                                                Изменить</a>
                                        </button>
                                        <form action="{{ route('admin.category.destroy', $сategory->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="delete-button px-4 py-2 cursor-pointer bg-red-500 hover:bg-red-600 transition-colors text-white rounded-lg flex items-center justify-center gap-2">
                                            <span class="material-icons">delete</span>
                                                Удалить
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
