<!-- resources/views/admin/menu/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-start gap-6">
            <a href="{{ route('admin.menu.index') }}">
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</button>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Menu') }}
            </h2>

        </div>

    </x-slot>
    <div>

        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="flex justify-center grow m-12">
            <form action="{{ route('admin.menu.store') }}" class="w-full" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Menu Name</label>
                    <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="put the menu name here" value="{{ old('name') }}" required />
                </div>
                <div>
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price:</label>
                    <input type="number" id="price" name="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="put the menu name here" value="{{ old('price') }}" required>
                </div>

                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="thumbnail">Thumbnail</label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="thumbnail" name="thumbnail" type="file" value="{{ old('thumbnail') }}" required>
                <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">Thumbnail to show in the card menu</div>

                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Is Available:</label>
                <select id="countries" name="is_available" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="1" {{ old('is_available') == 1 ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_available') == 0 ? 'selected' : '' }}>No</option>
                </select>
                <button type="submit" class="mt-5 w-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>

    </div>

</x-app-layout>
