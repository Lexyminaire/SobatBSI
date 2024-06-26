<!-- resources/views/admin/menu/index.blade.php -->
<x-app-layout>
        <x-slot name="header">
            <div class="flex justify-start gap-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Menu') }}
                </h2>
                <a href="{{ route('admin.menu.create') }}">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create New Menu Item</button>
                </a>
            </div>
            
        </x-slot>
    <div>
        <div class="m-12">

            @if (session('success'))
            <div>{{ session('success') }}</div>
            @endif
            <div class="flex justify-between gap-6 flex-wrap">
                @foreach($menus as $menu)
                <div class="max-w-60 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{ route('admin.menu.show', $menu->id) }}">
                        <img class="rounded-t-lg" src="{{asset("storage/$menu->thumbnail")}}" alt="{{asset("storage/$menu->thumbnail")}}" />
                    </a>
                    <div class="p-2 ">
                        <a href="{{ route('admin.menu.show', $menu->id) }}">
                            <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">{{$menu->name}}</h5>
                        </a>
                        @if($menu->is_available)
                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">available</span>
                        @else
                        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">not available</span>
                        @endif
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{Number::currency($menu->price, in: 'IDR', locale: 'id');}}</p>
                        <div class="flex-row gap-2">
                            {{-- <a href="{{ route('admin.menu.show', $menu->id) }}" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Read more
                            </a> --}}
                            <a href="{{ route('admin.menu.edit', $menu->id) }}" class="py-2 px-3 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                Edit
                            </a>
                            <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{-- <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Thumbnail</th>
                        <th>Available</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $menu)
                    <tr>
                        <td>{{ $menu->name }}</td>
            <td>{{ $menu->price }}</td>
            <td><img src="{{ $menu->thumbnail }}" alt="{{ $menu->name }}" width="50"></td>
            <td>{{ $menu->is_available ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('admin.menu.show', $menu->id) }}">View</a>
                <a href="{{ route('admin.menu.edit', $menu->id) }}">Edit</a>
                <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
            </tr>
            @endforeach
            </tbody>
            </table> --}}
        </div>
    </div>

</x-app-layout>
