<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-start gap-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Order') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto px-4 mt-4">
        @if(isset($details) && $details->count())
            @php
                $total = 0;
            @endphp
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach($details as $detail)
                    <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-70 p-4 relative">
                        <form action="{{ route('user.order.delete', $detail->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete
                            </button>
                        </form>
                        <h2 class="font-bold text-lg mb-2">{{ $detail->menu->name }}</h2>
                        <p class="mb-2">{{ $detail->menu->description }}</p>
                        <div class="flex justify-between items-center">
                            <p class="font-bold">{{ Number::currency($detail->menu->price, 'IDR', 'id') }}</p>
                            <form action="{{ route('user.order.update', $detail->id) }}" method="POST" class="flex items-center">
                                @csrf
                                <input type="number" name="quantity" value="{{ $detail->qty }}" min="1" class="text-center w-16">
                                <button type="submit" class="ml-2 px-2 py-1 bg-blue-500 text-white rounded">Save    </button>
                            </form>
                        </div>
                    </div>
                    @php
                        $total += $detail->menu->price * $detail->qty;
                    @endphp
                @endforeach
            </div>
            <div class="mt-4">
                <h2 class="font-bold text-lg">Total: {{ Number::currency($total, 'IDR', 'id') }}</h2>
            </div>
        @else
            <p>No unpaid orders found.</p>
        @endif
    </div>
</x-app-layout>