<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tags') }}
        </h2>
    </x-slot>
    <div class="my-6">
        <div class="grid sm:grid-cols items-center gap-16 p-8 mx-auto max-w-4xl bg-white shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md text-[#333] font-[sans-serif]">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                 <div class="flex justify-end mb-4">
                    <a href="{{ route('tags.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Tag</a>
                </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" style="table-layout: fixed;">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Tag Name</th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td class="px-6 py-4">{{ $tag->tag_name }}</td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('tags.edit', $tag->id) }}" class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit mr-2"></i></a>
                                            <form id="deleteForm{{ $tag->id }}" action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete('{{ $tag->id }}')" class="text-red-500 hover:text-red-700 ml-2"><i class="fa fa-trash"></i></button>
                                            </form>
                                            <script>
                                                function confirmDelete(tagId) {
                                                    // Display confirmation dialog
                                                    if (window.confirm('Are you sure you want to delete this tag?')) {
                                                        // If user confirms, submit the form
                                                        document.getElementById('deleteForm' + tagId).submit();
                                                    }
                                                }
                                            </script>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            {{ $tags->links() }}
        </div>
    </div>
</x-app-layout>