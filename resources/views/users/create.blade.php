<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    @can('user-create')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="container mt-5 mb-5">
                <div class="flex justify-center">
                    <div class="w-full md:w-3/4 lg:w-1/2">
                        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <form action="{{ route('users.store') }}" method="POST" class="max-w-md mx-auto mt-8">
                                @csrf
                                @method('POST')
                                <div class="mb-4">
                                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                                    <input type="text" id="name" name="name" required 
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-blue-500 @error('name') border-red-500 @enderror">
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                                    <input type="email" id="email" name="email" required 
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-blue-500 @error('email') border-red-500 @enderror">
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                                    <input type="password" id="password" name="password" required 
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-blue-500 @error('email') border-red-500 @enderror">
                                </div>

                                <div class="col-span-12 sm:col-span-12 md:col-span-12 mb-4"> 
                                    <label for="roles" class="block font-medium mb-2">Role:</label>
                                    <select name="roles[]" id="roles" class="form-select w-full" multiple>
                                        @foreach ($roles as $value => $label)
                                            <option value="{{ $value }}" {{ isset($userRole[$value]) ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('roles')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p> 
                                    @enderror
                                </div>


                                <div class="flex items-center justify-between">
                                    <a href="{{ route('users.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                                        Cancel
                                    </a>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                        Create
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endcan
</x-app-layout>

