<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business') }} - {{ $business->business_name }}
        </h2>
    </x-slot>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-xl font-bold mb-4">Business Details</h3>
                            <p><strong>Business Name:</strong> {{ $business->business_name }}</p>
                            <p><strong>Contact Email:</strong> {{ $business->email }}</p>
                            <p><strong>Categories:</strong> {{ $business->categories }}</p>
                            <!-- Add left column content -->
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <form action="{{ route('tasks.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                    <input type="text" name="title" id="title" class="mt-1 p-2 block w-full border-gray-300 rounded-md" required>
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea name="description" id="description" rows="3" class="mt-1 p-2 block w-full border-gray-300 rounded-md" required></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status" class="mt-1 p-2 block w-full border-gray-300 rounded-md" required>
                                        <option value="open">Open</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Add Task</button>
                                </div>
                            </form>
                        </div>
                        sasasa
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
