<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-start gap-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('History') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto px-4 mt-4">
        @if($histories->count())
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach($histories as $history)
                    <div
                        class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="{{ route('user.history.show', $history['transaction_id']) }}"
                            class="border rounded-lg p-4 block text-black no-underline hover:bg-gray-100">
                            <h2 class="font-bold text-lg mb-2">{{ $history['top_item']['menu']->name }}</h2>
                            <p class="mb-2">Total Items: {{ $history['total_items'] }}</p>  
                            <p class="font-bold">Total Price: {{ Number::currency($history['total_price'], 'IDR', 'id') }}</p>
                        </a>
                    </div>

                @endforeach
            </div>
        @else
            <p class="text-gray-600">No paid transactions found.</p>
        @endif
    </div>
</x-app-layout>