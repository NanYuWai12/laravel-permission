<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <p class="mt-2">Name : {{auth()->user()->name}}</p>
                    <p class="mt-2">Role :
                        @foreach (auth()->user()->roles as $role)
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-30">
                                {{$role->name}}
                            </span>
                        @endforeach 
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
