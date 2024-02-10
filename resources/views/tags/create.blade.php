<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>
    <div class="my-6">
        <div class="grid sm:grid-cols items-center gap-16 p-8 mx-auto max-w-4xl bg-white shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md text-[#333] font-[sans-serif]">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="padding: 30px;">
                <h4 class="text-2xl font-bold mt-4 mb-2">Add New Tag</h4>
                    <form action="{{ route('tags.store') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                            <div class="bg-red-500 text-white font-bold px-4 py-2 rounded-md">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-business-name">
                                Tag Name
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-business-name" type="text">
                        </div>
                        <div class="flex justify-end mb-4 space-x-2">
                            <a href="{{ route('tags.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Tags</button>
                         </div>
                    </form>
            </div>
        </div>
    </div>
</x-app-layout>