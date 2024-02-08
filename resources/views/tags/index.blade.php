<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tags') }}
        </h2>
    </x-slot>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mt-4 mb-2">Tags</h1>
        <a href="{{ route('tags.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add New Tag</a>
        <table class="table-auto mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td class="border px-4 py-2">{{ $tag->id }}</td>
                        <td class="border px-4 py-2">{{ $tag->name }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('tags.edit', $tag->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>