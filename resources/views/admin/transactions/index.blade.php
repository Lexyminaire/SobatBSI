<!-- resources/views/admin/menu/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-start gap-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Order') }}
            </h2>

        </div>

    </x-slot>
    <div>
        <div class="m-12">

            @if (session('success'))
            <div>{{ session('success') }}</div>
            @endif
            <div class="w-full p-12">
                <div class="">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        User
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Payment Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $transaction->id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $transaction->user->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($transaction->payment_status == 'paid')
                                        <span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Paid</span>
                                        @else
                                        <span class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Unpaid</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        {{-- <a href="{{ route('admin.users.edit', $user->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> --}}
                                        <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="{{ route('admin.transactions.show', $transaction->id) }}" class="btn btn-primary">View</a>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
