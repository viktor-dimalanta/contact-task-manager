<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Businesses') }}
        </h2>
    </x-slot>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mt-4 mb-2">Businesses</h1>
        <a href="{{ route('businesses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Business</a>
        <table class="table-auto mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">Business Name</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($businesses as $business)
                    <tr>
                        <td class="border px-4 py-2">{{ $business->business_name }}</td>
                        <td class="border px-4 py-2">{{ $business->email }}</td>
                        <td class="border px-4 py-2">{{ $business->categories }}</td>
                        <td class="border px-4 py-2">{{ $business->tags }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('businesses.show', $business->id) }}" class="text-blue-500 hover:text-blue-700">View</a>
                            <a href="{{ route('businesses.edit', $business->id) }}" class="text-yellow-500 hover:text-yellow-700 ml-2">Edit</a>
                            <form action="{{ route('businesses.destroy', $business->id) }}" method="POST" class="inline">
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