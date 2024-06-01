<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-sm text-wishka-500 bg-black font-black text-xs bg-wishka-300 bg-wishka-200 overflow-hidden shadow-xl sm:rounded-lg text-wishka-500 w-[400px] pr-3 pl-3 pr-5 pl-5 text-error">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
