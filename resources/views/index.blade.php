@extends("layouts.app")
@section('content')
    <div class="container mx-auto p-4">
        <main class="mt-8 antialiased container my-5">
            <section class="mt-8">
                <h2 class="text-center text-2xl font-bold mb-4 uppercase">последние товары</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach ($products as $product)
                        <div class="bg-white p-4 text-lg rounded-lg shadow-md product" data-id="2" data-name="Товар 2" data-price="2000">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/250' }}" alt="{{ $product->name }}" class="w-[250px] h-auto object-contain">
                            <p class="mt-2 text-2xl font-bold">{{ $product->name }}</p>
                            <p class="text-gray-600">
                                <strong>Цена:</strong>
                                {{ $product->price }}
                            </p>
                            <p class="text-gray-600">
                                <strong>Бренд:</strong>
                                {{ $product->brand?->name ?? 'Без бренда'}}
                            </p>
                            <p class="text-gray-600">
                                <strong>Категория:</strong>
                                {{ $product->category?->name ?? 'Без категории'}}
                            </p>
                            <form action="{{ route('product.show', $product->id) }}" method="get">
                                <button class="mt-3 primary-button">Подробнее</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
    </div>
 @endsection

