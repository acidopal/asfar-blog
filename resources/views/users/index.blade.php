<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage User') }}
            </h2>
        </div>
    </x-slot>

    @canany('user-list')
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
                                            <th class="px-6 py-3 border border-gray-300">Email</th>
                                            <th class="px-6 py-3 border border-gray-300">Roles</th>
                                            @canany(['user-edit', 'user-delete'])
                                                <th class="px-6 py-3 border border-gray-300">Action</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                            <tr>
                                                <td class="px-6 py-3 border border-gray-300">{{ $user->name }}</td>
                                                <td class="px-6 py-3 border border-gray-300">{{ $user->email }}</td>
                                                <td class="px-6 py-3 border border-gray-300">
                                                    @if(!empty($user->getRoleNames()))
                                                        @foreach($user->getRoleNames() as $role)
                                                        <label class="badge bg-success">{{ $role }}</label>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                @canany(['user-edit', 'user-delete'])
                                                <td class="px-6 py-3 border border-gray-300">
                                                    @can('user-edit')
                                                        <a href="{{ route('users.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                            Edit
                                                        </a>
                                                    @endcan

                                                    @can('user-delete')
                                                        <form onsubmit="return confirm('Are you sure ?');" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                                Delete User
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

                            {{ $users->links() }}  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
</x-app-layout>