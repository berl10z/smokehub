@extends('index')

@section('content')
<body class="bg-gray-100 full-screen">
    <div class="bg-gray-900 p-6 flex-1 flex flex-col content">
       <div class="flex justify-between items-center mb-6">
          <h1 class="text-white text-xl font-medium">Панель управления</h1>
          <button class="px-4 py-2 bg-red-600 hover:bg-red-700 transition-colors rounded-lg text-white text-sm">
            <a href="{{ route('logout') }}">Выйти</a>
          </button>
       </div>
       @if (session('success'))
       <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
           {{ session('success') }}
       </div>
       @endif
       <div class="grid grid-cols-3 gap-4 mb-6">
          <div class="bg-white p-4 max-md:col-span-3 flex items-center gap-3 hover:shadow-lg transition-shadow">
             <span class="material-icons text-green-500">inventory_2</span>
             <div>
                <p class="text-sm text-gray-600">Товаров в наличии</p>
                <p class="text-xl font-semibold text-gray-900">{{ $productCount }}</p>
             </div>
          </div>
       </div>
       <div class="bg-white p-4 mb-6">
          <div class="flex max-md:flex-col justify-end gap-3 mb-6">
             <button id="addProductButton" class="px-4 py-2 bg-green-500 hover:bg-green-600 transition-colors text-white rounded-lg flex items-center gap-2">
                <a class="flex items-center" href="{{ route('admin.product.create') }}">
                    <span class="material-icons">add</span>
                    Добавить товар
                </a>
             </button>
             <button id="addProductButton" class="primary-button">
                <a class="flex items-center" href="{{ route('admin.category.index') }}">
                    <span class="material-icons">category</span>
                    Категории
                </a>
             </button>
             <button id="addProductButton" class="primary-button">
                <a class="flex items-center" href="{{ route('admin.brand.index') }}">
                    <span class="material-icons">shop</span>
                    Бренды
                </a>
             </button>
             <button id="addProductButton" class="px-4 py-2 bg-red-500 hover:bg-red-700 transition-colors text-white rounded-lg flex items-center gap-2">
                <a class="flex items-center" href="{{ route('admin.trash') }}">
                    <span class="material-icons">delete</span>
                    Удаленные товары
                </a>
             </button>
          </div>
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
                        @foreach ($products as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/250' }}" alt="{{ $product->name }}" alt="Product" class="w-20 h-20 object-contain">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $product->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">
                                        {{ $product->category?->name ?? 'Без категории'}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">
                                        {{ $product->brand?->name ?? 'Без бренда'}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ Str::limit($product->description, 50) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <form action="{{ route('admin.product.decrement',$product->id) }}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <button class="delete-button">
                                                <span class="material-icons">remove</span>
                                            </button>
                                        </form>
                                        <div class="text-sm font-semibold text-gray-900">{{ Str::limit($product->count, 50) }}</div>
                                        <form action="{{ route('admin.product.increment',$product->id) }}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <button class="cursor-pointer bg-green-500 hover:bg-green-600transition-colors text-white rounded-lg flex items-center justify-center gap-2 w-full">
                                                <span class="material-icons">add</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $product->price }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="space-y-2 flex flex-col items-center">
                                        <button class="edit-button px-4 py-2 cursor-pointer bg-yellow-500 hover:bg-yellow-600 transition-colors text-white rounded-lg flex items-center justify-center gap-2 w-full">
                                            <a href="{{ route('admin.product.edit',parameters: $product->id) }}">
                                                <span class="material-icons">edit</span>
                                                Изменить</a>
                                        </button>
                                        <form class="w-full" action="{{ route('admin.product.destroy', $product->id) }}" method="post">
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
 </body>
 </html>
@endsection
