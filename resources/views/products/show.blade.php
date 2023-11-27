<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-xl">
                {{ __('Product') }} : <strong>{{ $product->name }}</strong>
                </div>
                <div class="container mx-auto mx-auto p-4">
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-blue-200">
                        <img src="https://placehold.co/300x200/d1d4ff/352cb5.png" alt="Placeholder Image" class="w-full h-30 rounded-md object-cover">
                        <div class="px-1 py-4">
                            <div class="font-bold text-xl mb-2 dark:text-gray-200">{{ $product->name }}</div>
                            <p class="py-2 text-gray-700 dark:text-gray-200 text-base">
                                Price: {{ $product->price }} €
                            </p>
                            <p class="py-2 text-gray-700 dark:text-gray-200 text-sm">
                                Quantity: {{ $product->quantity }}
                            </p>
                            <p class="py-2 text-gray-700 dark:text-gray-200 text-sm">
                                Description: {{ $product->description }}
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
