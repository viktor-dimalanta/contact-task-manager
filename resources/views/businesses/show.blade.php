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
                            @foreach(json_decode($business->categories) as $business_category)
                                <div class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full">    
                                    <p><strong>Categories:</strong> {{ $business_category }}</p>
                                </div>
                            @endforeach
                            <!-- Add left column content -->
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <form id="taskForm" action="{{ route('tasks.store') }}" method="POST">
                                @csrf
                                <div>
                                    <input type="hidden" value="{{ $business->business_name }}" name="for">
                                    <input type="hidden" value="{{ $business->id }}" name="person_id">
                                    <input type="hidden" value="App\Models\Business" name="taskable_type">
                                </div>
                                <div class="mb-4">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                    <input type="text" name="title" id="title" class="mt-1 p-2 block w-full border-gray-300 rounded-md" required name="task_name">
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea name="description" id="description" rows="3" class="mt-1 p-2 block w-full border-gray-300 rounded-md" required name="description"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status" class="mt-1 p-2 block w-full border-gray-300 rounded-md" required name="status">
                                        <option value="open">Open</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Add Task</button>
                                </div>
                            </form>
                        </div>
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-xl font-bold mb-4">Task</h3>
                            @if ($tasks->isEmpty())
                                <p>No tasks found.</p>
                            @else
                                <ul>
                                    @foreach ($tasks as $task)
                                        <li><b>{{ $task->task_name }}</b></li>
                                        <li>{{ $task->description }}</li>
                                        <li>{{ $task->status === '1' ? 'Completed' : 'Open' }}</li>
                                        <hr>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Prevent form submission and handle it with JavaScript
        document.getElementById('taskForm').addEventListener('submit', function(event) {
            event.preventDefault();
            fetch(this.action, {
                method: this.method,
                body: new FormData(this)
            })
            .then(response => {
                if (response.ok) {
                    console.log('Form submitted successfully');
                    location.reload();
                } else {
                    console.error('Form submission failed');
                }
            })
            .catch(error => {
                console.error('An error occurred:', error);
            });
        });
    </script>
</x-app-layout>
