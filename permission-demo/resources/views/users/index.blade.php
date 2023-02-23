<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Users
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-9/12">

            <a
            href="{{route('user.create')}}"
            class="bg-indigo-500 hover:bg-indigo-600 px-4 py-1 text-white rounded "
            >
                Create
            </a>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                @if (Session::has('message'))
                    <div class="p-4 mb-4 mt-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-gray-800 dark:text-blue-400" role="alert">
                        <span class="font-medium">{{Session::get('message')}}</span>
                    </div>
                @endif

                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-4">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                User Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$user->name}}
                                </th>

                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @foreach ($user->roles as $role)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{$role->name}}</span>

                                    @endforeach
                                </th>

                                <td class="px-6 py-4">
                                    <div class="flex">
                                        <a href="{{route('user.edit',$user->id)}}" class="mr-3 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        <form action="{{route('user.destroy',$user->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
</x-app-layout>
