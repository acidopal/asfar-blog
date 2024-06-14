<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ __('Add Post') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="container mt-5 mb-5">
                <div class="flex justify-center">
                    <div class="w-full md:w-3/4 lg:w-1/2">
                        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                            <form action="{{ route('blog-posts.store') }}" method="POST">
                                @csrf
                                @method('POST')

                                <div class="mb-4">
                                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                                    <input type="text" id="title" name="title" required
                                        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror">

                                    @error('title')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content</label>
                                    <textarea id="content" rows="6" name="content" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror focus:ring-0 dark:text-white dark:placeholder-gray-400 dark:bg-gray-800" placeholder="Write a content..." required></textarea>
                                    @error('content')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex items-center justify-between">
                                    <a href="{{ route('blog-posts.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Cancel</a>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

