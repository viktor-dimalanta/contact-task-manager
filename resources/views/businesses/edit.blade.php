<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Businesses') }}- {{ $business->business_name }}
        </h2>
    </x-slot>
  <div class="my-6">
        <div class="grid sm:grid-cols items-center gap-16 p-8 mx-auto max-w-4xl bg-white shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md text-[#333] font-[sans-serif]">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="padding: 30px;">
                <form action="{{ route('businesses.update', $business->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @if ($errors->any())
                        <div class="bg-red-500 text-white font-bold px-4 py-2 rounded-md">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-business-name">
                                Business Name
                            </label>
                            <input value="{{ old('name', $business->business_name) }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-business-name" type="text" name="business_name">
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-email">
                                Contact Email
                            </label>
                            <input value="{{ old('name', $business->email) }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-email" type="email" name="email">
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-technology">
                                Categories
                            </label>
                            <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach($categories as $category)
                                        <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                            <div class="flex items-center ps-3">
                                                <?php 
                                                    // Explode the $business->tags string into an array and remove any double quotes and trim whitespace
                                                    preg_match('/\[(.*?)\]/', $business->categories, $matches);
                                                    $array = explode(',', str_replace('"', '', $business->categories));
                                                    $array = array_map('trim', $array);
                                                    $array = array_map('trim', explode(',', str_replace('"', '', $matches[1])));
                                                    // Check if the tag is in the $business->tags array

                                                    $categoryChecked = in_array(trim($category->category_name), $array); 
                                                ?>
                                                <input id="{{ $category->category_name }}" 
                                                    type="checkbox" 
                                                    value="{{ $category->category_name }}" 
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" 
                                                    name="categories[]" 
                                                    {{ $categoryChecked ? 'checked' : '' }}>
                                                <label for="{{ $category->category_name }}" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->category_name }}</label>                                     
                                            </div>
                                        </li>
                                    @endforeach
                            </ul>                        
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-technology">
                                Tags
                            </label>
                            <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach($tags as $tag)
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center ps-3">
                                            <?php 
                                                // Explode the $business->tags string into an array and remove any double quotes and trim whitespace
                                                preg_match('/\[(.*?)\]/', $business->tags, $matches);
                                                $array = explode(',', str_replace('"', '', $business->tags));
                                                $array = array_map('trim', $array);
                                                $array = array_map('trim', explode(',', str_replace('"', '', $matches[1])));
                                                // Check if the tag is in the $business->tags array
                                                $tagChecked = in_array(trim($tag->tag_name), $array); 
                                            ?>
                                            <input id="{{ $tag->tag_name }}" 
                                                type="checkbox" 
                                                value="{{ $tag->tag_name }}" 
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" 
                                                name="tags[]" 
                                                {{ $tagChecked ? 'checked' : '' }}>
                                            <label for="{{ $tag->tag_name }}" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $tag->tag_name }}</label>                                     
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="flex justify-end mb-4 space-x-2">
                        <a href="{{ route('businesses.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Business</button>
                    </div>
                </form>
                </form>
                <form id="deleteForm{{ $business->id }}" action="{{ route('businesses.destroy', $business->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete('{{ $business->id }}')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>

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
            </div>
        </div>
  </div>
</x-app-layout>
