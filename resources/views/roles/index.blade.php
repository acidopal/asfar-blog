<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Roles') }}
            </h2>
            @can('role-create')
            <div class="ml-4">
                <a href="{{ route('roles.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Role
                </a>
            </div>
            @endcan
        </div>
    </x-slot>

    @canany('role-list')
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-12">
                        @if (session('message'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-5 rounded relative" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <div class="shadow-md rounded-md bg-white p-6"> 
                            <table class="w-full text-center border-collapse mt-2 pb-8 mb-5">
                                <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-6 py-3 border border-gray-300">Name</th>
                                            @canany(['role-edit', 'role-delete'])
                                                <th class="px-6 py-3 border border-gray-300">Action</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($roles as $role)
                                            <tr>
                                                <td class="px-6 py-3 border border-gray-300">{{ $role->name }}</td>
                                                @canany(['role-edit', 'role-delete'])
                                                <td class="px-6 py-3 border border-gray-300">
                                                    @can('role-edit')
                                                        <a href="{{ route('roles.edit', $role->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                            Edit
                                                        </a>
                                                    @endcan

                                                    @can('role-delete')
                                                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                            Delete Role
                                                        </button>
                                                    </form>
                                                    @endcan
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

                            {{ $roles->links() }}  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
</x-app-layout>