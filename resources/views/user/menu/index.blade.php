<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-start gap-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Menu') }}
            </h2>
        </div>

    </x-slot>
    <div>
        <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 text-sm font-medium text-green-600 bg-green-100 rounded-lg p-4">
                    {{ session('success') }}
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($menus as $menu)
                    <div class="overflow-hidden rounded-lg shadow-lg bg-white dark:bg-gray-800">
                        <a href="{{ route('user.menu.show', $menu->id) }}">
                            <img class="w-full h-48 object-cover object-center"
                                src="{{ asset("storage/$menu->thumbnail") }}" alt="{{ $menu->name }}">
                        </a>
                        <div class="p-6">
                            <a href="{{ route('user.menu.show', $menu->id) }}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $menu->name }}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                {{ Number::currency($menu->price, 'IDR', 'id') }}</p>
                                
                            <div class="flex items-center justify-between">
                                <a href="{{ route('user.menu.show', $menu->id) }}"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Read more
                                </a>
                                @if($menu->is_available)
                                    <span
                                        class="text-xs font-semibold mr-2 px-2.5 py-0.5 rounded bg-green-100 text-green-800">Available</span>
                                @else
                                    <span class="text-xs font-semibold mr-2 px-2.5 py-0.5 rounded bg-red-100 text-red-800">Not
                                        Available</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>