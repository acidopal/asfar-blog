<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ __('Create Roles') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="container mt-5 mb-5">
                <div class="flex justify-center">
                    <div class="w-full md:w-3/4 lg:w-1/2">
                        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                            <form action="{{ route('roles.store') }}" method="POST" class="max-w-md mx-auto mt-8">
                                @csrf
                                @method('POST')

                                <div class="mb-4">
                                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                                    <input type="text" id="name" name="name" required 
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-blue-500 @error('name') border-red-500 @enderror">

                                    @error('name')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p> 
                                    @enderror
                                </div>

                                <div class="col-span-12 sm:col-span-12 md:col-span-12">
                                    <div class="mb-4">
                                        <strong class="block font-medium mb-2">Permission:</strong>
                                        <div class="space-y-2">  
                                            @foreach($permission as $value)
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" name="permission[{{$value->id}}]" value="{{$value->id}}" 
                                                        class="form-checkbox h-4 w-4 text-blue-600">
                                                    <span class="ml-2 text-sm text-gray-700">{{ $value->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <a href="{{ route('roles.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
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
</x-app-layout>

