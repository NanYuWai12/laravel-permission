<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-9/12">

            @can('create posts')
            <a
                href="{{route('post.create')}}"
                class="bg-sky-900 hover:bg-indigo-600 px-4 py-1 text-white rounded "
            >
                Create
            </a>
            @endcan


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$post->title}}
                                </th>

                                <td class="px-6 py-4">
                                    @can('edit posts')
                                        <a href="{{route('post.edit',$post->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    @endcan

                                    @can('view posts')
                                        <a href="{{route('post.show',$post->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</x-app-layout>
