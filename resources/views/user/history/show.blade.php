<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-start gap-6 items-center">
            <a href="{{ url()->previous() }}" class="text-gray-800 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Order Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <ul class="divide-y divide-gray-200">
                    @foreach($details as $detail)
                        <li class="py-4 flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $detail['menu_name'] }}</p>
                                <p class="text-sm text-gray-500">{{ __('Qty: ') . $detail['qty'] }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ Number::currency($detail['price'], 'IDR', 'id') }}</p>
                                <p class="text-sm text-gray-500">{{ Number::currency($detail['total_price'], 'IDR', 'id') }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('Total Payment: ') . Number::currency($totalPayment, 'IDR', 'id') }}</h3>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>