<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('People') }}
        </h2>
    </x-slot>
    <div class="my-6">
        <div class="grid sm:grid-cols items-center gap-16 p-8 mx-auto max-w-4xl bg-white shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md text-[#333] font-[sans-serif]">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                 <div class="flex justify-end mb-4">
                    <a href="{{ route('people.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Person</a>
                </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" style="table-layout: fixed;">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Name</th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Email</th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Phone</th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Business</th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Tags</th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($people as $person)
                                <tr>
                                    <td class="px-6 py-4 truncate"><a href="{{ route('people.show', $person->id) }}" class="text-yellow-500 hover:text-yellow-700 ml-2">{{ $person->first_name }} {{ $person->last_name }}</a></td>
                                    <td class="px-6 py-4 truncate">{{ $person->email }}</td>
                                    <td class="px-6 py-4 truncate">{{ $person->phone }}</td>
                                    <td class="px-6 py-4 truncate">{{ $person->business }}</td>
                                    <td class="px-6 py-4 truncate">
                                    @foreach(json_decode($person->tags) as $tag)
                                    <div class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full">    
                                            <div><p>{{ $tag }}</p></div>
                                    </div>
                                    @endforeach
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('people.edit', $person->id) }}" class="text-yellow-500 hover:text-yellow-700 ml-2"><i class="fas fa-edit mr-2"></i></a>
                                        <form id="deleteForm{{ $person->id }}" action="{{ route('people.destroy', $person->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete('{{ $person->id }}')" class="text-red-500 hover:text-red-700 ml-2"><i class="fa fa-trash"></i></button>
                                        </form>
                                        <script>
                                            function confirmDelete(personId) {
                                                // Display confirmation dialog
                                                if (window.confirm('Are you sure you want to delete this person?')) {
                                                    // If user confirms, submit the form
                                                    document.getElementById('deleteForm' + personId).submit();
                                                }
                                            }
                                        </script>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                </div>
        {{ $people->links() }}
        </div>
    </div>
</x-app-layout>