<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Roles
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-9/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('roles.store')}}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role Name</label>
                            <input type="text" name="role"  value="{{old('role')}}" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('role')
                                <p id="filled_success_help" class="mt-2 text-xs text-red-600 dark:text-red-400">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex items-start mb-6">
                            @foreach ($permissions as $permission)
                                <div class="flex items-center h-5">
                                    <input id="permission"
                                        type="checkbox"
                                        name="permissions[]"
                                        value="{{$permission->name}}"
                                        {{ (collect(old('permissions'))->contains($permission->name)) ? 'checked':'' }}
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" >
                                </div>
                                <label for="permission" class="ml-2 mr-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{$permission->name}}</label>
                            @endforeach
                            @error('permissions')
                                <p id="filled_success_help" class="mt-2 text-xs text-red-600 dark:text-red-400">{{$message}}</p>
                            @enderror
                        </div>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
