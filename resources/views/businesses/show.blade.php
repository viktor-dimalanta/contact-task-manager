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
                                        <li>
                                            @if($task->status === '1')
                                                <i class="fa fa-check" style="color: green;"></i>
                                                <div class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full">    
                                                <p> Completed</p>
                                                </div>
                                            @else
                                                <button type="button" onclick="confirmUpdateStatus('{{ $task->id }}')" class="text-yellow-500 hover:text-yellow-700 ml-2"><i class="fa fa-share"></i></button>
                                                <div class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-red-200 text-red-700 rounded-full">    
                                                    <p>Open</p>
                                                </div>
                                            @endif
                                            <b>{{ $task->task_name }}</b>
                                        </li>
                                        <li>Description: {{ $task->description }}</li>
                                        <br>
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

        function confirmUpdateStatus(taskId) {
            if (confirm('Are you sure you want to update the status?')) {
                updateToCompletedStatus(taskId);
            }
        }
        function updateToCompletedStatus(taskId) {
            //Send an AJAX request to update the status
            axios.put('/tasks/' + taskId + '/update-to-completed-status')
                .then(response => {
                    alert("Task Update Successfully!")
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                });
            }
    </script>
</x-app-layout>
