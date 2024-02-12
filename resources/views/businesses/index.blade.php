<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business') }}
        </h2>
    </x-slot>
    <div class="my-6">
        <div class="grid sm:grid-cols items-center gap-16 p-8 mx-auto max-w-4xl bg-white shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md text-[#333] font-[sans-serif]">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                 <div class="flex justify-end mb-4">
                    <a href="{{ route('businesses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Business</a>
                </div>        
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Business Name</th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Name</th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Categories</th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Tags</th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($businesses as $business)
                                <tr>
                                    <td class="px-6 py-4"><a href="{{ route('businesses.show', $business->id) }}" class="text-yellow-500 hover:text-yellow-700 ml-2">{{ $business->business_name }}</a></td>
                                    <td class="px-6 py-4">{{ $business->email }}</td>
                                    <td class="px-6 py-4">
                                        @foreach(json_decode($business->tags) as $tag)
                                            <div class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full">    
                                                <div><p>{{ $business->categories }}</p></div>
                                            </div>
                                        @endforeach
                                    <td class="px-6 py-4">
                                        @foreach(json_decode($business->tags) as $tag)
                                            <div class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full">    
                                                <div><p>{{ $tag }}</p></div>
                                            </div>
                                        @endforeach

                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('businesses.edit', $business->id) }}" class="text-yellow-500 hover:text-yellow-700 ml-2"><i class="fas fa-edit mr-2"></i></a>
                                        <form id="deleteForm{{ $business->id }}" action="{{ route('businesses.destroy', $business->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete('{{ $business->id }}')" class="text-red-500 hover:text-red-700 ml-2"><i class="fa fa-trash"></i></button>
                                        </form>
                                        <script>
                                            function confirmDelete(businessId) {
                                                // Display confirmation dialog
                                                if (window.confirm('Are you sure you want to delete this business?')) {
                                                    // If user confirms, submit the form
                                                    document.getElementById('deleteForm' + businessId).submit();
                                                }
                                            }
                                        </script>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
            {{ $businesses->links() }}
        </div>
    </div>
</x-app-layout>