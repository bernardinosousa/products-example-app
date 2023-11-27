<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session()->has('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <span class="font-medium">{{ session()->get('success') }}</span>
                </div>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-medium">{{ $error }}</span>
                </div>
                @endforeach
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="container mx-auto mx-auto p-4">
                    
                    @if(count($products) == 0)
                        <div class="p-2 text-gray-900 dark:text-gray-100">
                            Currently no products are available in shop.
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-4">
                        @foreach($products as $product)
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-blue-200">
                            <img src="https://placehold.co/300x200/d1d4ff/352cb5.png" alt="Placeholder Image" class="w-full h-48 rounded-md object-cover">
                            <div class="px-1 py-4">
                                <div class="font-bold text-xl mb-2 dark:text-gray-200">{{ $product->name }}</div>
                                <p class="text-gray-700 dark:text-gray-200 text-base">
                                    Price: {{ $product->price }} €
                                </p>
                                <p class="text-gray-700 dark:text-gray-200 text-sm">
                                    Quantity: {{ $product->quantity }}
                                </p>
                                @guest
                                <p class="text-gray-700 dark:text-gray-200 text-xs">
                                    To see product price and make reservation you must be <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="{{ route('login') }}">logged in</a>
                                </p>
                                @endguest
                                @auth
                                <form class="py-4" method="POST" action="{{ route('reservations.store') }}">
                                    @csrf
                                    <input name="product_id" type="hidden" value="{{ $product->id }}"/> 
                                    <input name="quantity" class=class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" placeholder="Quantity" value="1" min="1" max="{{ $product->quantity }}"/>
                                    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit">Book</button>
                                </form>
                                @endauth
                            </div>
                            <div class="px-1 py-4">
                            <a href="{{ route('products.show', ['product' => $product->id]) }}" class="text-blue-500 hover:underline">View More</a>
                            </div>
                        </div>
                        @endforeach
                        </div>
                        {{ $products->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
