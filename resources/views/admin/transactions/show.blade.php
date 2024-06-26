<!-- resources/views/admin/menu/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-start gap-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Order') }} {{$transaction->id}} 
            </h2>

        </div>

    </x-slot>
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Transaction Details</h1>
            <div class="mb-4">
                <span class="font-semibold">User:</span>
                <span>{{ $transaction->user->name }}</span>
            </div>
            <div class="mb-4">
                <span class="font-semibold">Payment Status:</span>
                @if($transaction->payment_status == 'paid')
                    <span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Paid</span>
                @else
                    <span class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Unpaid</span>
                @endif
            </div>
    
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Menu</th>
                            <th scope="col" class="px-6 py-3">Quantity</th>
                            <th scope="col" class="px-6 py-3">Price</th>
                            <th scope="col" class="px-6 py-3">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->detailTransactions as $detail)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $detail->menu->name }}</td>
                            <td class="px-6 py-4">{{ $detail->qty }}</td>
                            <td class="px-6 py-4">{{ Number::currency($detail->menu->price, in: 'IDR', locale: 'id')}}</td>
                            <td class="px-6 py-4">{{ Number::currency($detail->menu->price * $detail->qty, in: 'IDR', locale: 'id')}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-50 dark:bg-gray-700">
                            <th colspan="3" class="px-6 py-3 text-right font-medium text-gray-900 dark:text-white">Total</th>
                            <th class="px-6 py-3 font-medium text-gray-900 dark:text-white">{{ Number::currency($total, in: 'IDR', locale: 'id')}} </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
    
            <h3 class="text-lg font-semibold mt-6 mb-2">Update Payment Status</h3>
            <form action="{{ route('admin.transactions.updatePaymentStatus', $transaction->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="payment_status" class="block text-sm font-medium text-gray-700">Payment Status</label>
                    <select id="payment_status" name="payment_status" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <option value="unpaid" {{ $transaction->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="paid" {{ $transaction->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                </div>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Update
                </button>
            </form>
        </div>
    </div>

</x-app-layout>
