<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Categories:') }}- {{$category->category_name}}
        </h2>
    </x-slot>
    <div class="my-6">
        <div class="grid sm:grid-cols items-center gap-16 p-8 mx-auto max-w-4xl bg-white shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md text-[#333] font-[sans-serif]">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="padding: 30px;">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-category-name">
                                Category Name
                            </label>
                            <input value="{{ old('category_name', $category->category_name) }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-category-name" type="text">
                        </div>
                        <div class="flex justify-end mb-4 space-x-2">
                            <a href="{{ route('categories.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Category</button>
                         </div>
                    </form>
                    <form id="deleteForm{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete('{{ $category->id }}')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                    </form>
                    <script>
                        function confirmDelete(categoryId) {
                            // Display confirmation dialog
                            if (window.confirm('Are you sure you want to delete this category?')) {
                                // If user confirms, submit the form
                                document.getElementById('deleteForm' + categoryId).submit();
                            }
                        }
                    </script>
            </div>
        </div>
    </div>
</x-app-layout>
