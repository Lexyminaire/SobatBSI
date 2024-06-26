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
        <h1>{{ $menu->name }}</h1>
        <p>Price: {{ $menu->price }}</p>
        <p><img src="{{ $menu->thumbnail }}" alt="{{ $menu->name }}" width="150"></p>
        <p>Available: {{ $menu->is_available ? 'Yes' : 'No' }}</p>
        <a href="{{ route('admin.menu.edit', $menu->id) }}">Edit</a>
        <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
        <a href="{{ route('admin.menu.index') }}">Back to Menu</a>
    </div>

</x-app-layout>
