<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Blog') }}
            </h2>
            @can('blog-post-create')
            <div class="ml-4">
                <a href="{{ route('blog-posts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Post
                </a>
            </div>
            @endcan
        </div>
    </x-slot>
    @can('blog-post-list')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-12">
                    @if (session('message'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative p-6 mb-5" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="shadow-md rounded-md bg-white p-6"> 
                        <table class="w-full text-center border-collapse mt-2 pb-8 mb-5">
                            <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-6 py-3 border border-gray-300">Title</th>
                                        <th class="px-6 py-3 border border-gray-300">Content</th>
                                        <th class="px-6 py-3 border border-gray-300">Writer</th>
                                        @canany(['blog-post-edit', 'blog-post-delete'])
                                            <th class="px-6 py-3 border border-gray-300">Action</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($blogPosts as $blogPost)
                                        <tr>
                                            <td class="px-6 py-3 border border-gray-300">{{ $blogPost->title }}</td>
                                            <td class="px-6 py-3 border border-gray-300">{{ $blogPost->content }}</td>
                                            <td class="px-6 py-3 border border-gray-300">{{ $blogPost->user->name }}</td>
                                            @canany(['blog-post-edit', 'blog-post-delete'])
                                            <td class="px-6 py-3 border border-gray-300">
                                                <form onsubmit="return confirm('Are you sure ?');" action="{{ route('blog-posts.destroy', $blogPost->id) }}" method="POST">
                                                    <a href="{{ route('blog-posts.edit', $blogPost->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                            Edit
                                                    </a>

                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                            @endcan
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-gray-500" colspan="4">Nothing show in here.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                        </table>

                        {{ $blogPosts->links() }}  
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
</x-app-layout>