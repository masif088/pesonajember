<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <div class="bg-yellow-100 text-blue-700 hover:bg-blue-100 bg-blue-200 bg-green-100 bg-green-200 iconify text-yellow-900 text-gray-700 text-gray-600 bg-green-900 hover:bg-green-200"></div>
                <div class="bg-green-900"></div>
            </div>
            <div class="bg-white text-sm bg-blue-100 hover:bg-blue-200 text-blue-900 text-wishka-500 bg-black font-black text-xs bg-wishka-300 bg-wishka-200 overflow-hidden shadow-xl sm:rounded-lg text-wishka-500 w-[400px] pr-3 pl-3 pr-5 pl-5 text-error">
                <x-welcome />
                as
            </div>
        </div>
    </div>
</x-app-layout>
