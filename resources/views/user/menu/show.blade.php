<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-start gap-6 items-center">
            <a href="{{ url()->previous() }}" class="text-gray-800 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $menu->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <img src="{{ asset('storage/' . $menu->thumbnail) }}" alt="{{ $menu->description }}" />
                    <p>{{ Number::currency($menu->price, 'IDR', 'id') }}</p>
                    <p>{{ $menu->description }}</p>

                    <form method="POST" action="{{ route('user.order.add') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <div>
                            <label for="quantity">Quantity:</label>
                            <input type="number" id="quantity" name="qty" min="1" value="1"">
                        </div>
                        <div>
                            @if($menu->is_available == 0)
                            <button disabled type=" submit" class="bg-gray-500 text-white font-bold py-2 px-4 rounded shadow-lg mt-4">Add
                            to Order</button>
                            <p class="text-gray-700">this menu is not available</p>
                            @else
                            <button type=" submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg mt-4">Add
                                to Order</button>
                            @endif

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
