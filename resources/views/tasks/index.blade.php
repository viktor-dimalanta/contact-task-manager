<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>
    <div class="my-6">
        <div class="grid sm:grid-cols items-center gap-16 p-8 mx-auto max-w-4xl bg-white shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md text-[#333] font-[sans-serif]">
            <b>Open Tasks List</b>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin-top: -50px;">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" style="table-layout: fixed;">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Task Name</th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">For</th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Status</th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($completedTasks as $task)
                            <tr>
                                <td class="px-6 py-4">{{ $task->task_name }}</td>
                                <td class="px-6 py-4">
                                    @if ($task->taskable_type === 'App\Models\Person')
                                        <i class="fa fa-user"></i>&nbsp;&nbsp;{{ $task->for }}
                                    @else
                                        <i class="fa fa-building"></i>&nbsp;&nbsp;{{ $task->for }}
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $task->status == 1 ? 'Completed' : 'Open'}}</td>
                                <td class="px-6 py-4">
                                <button onclick="confirmUpdateStatus('{{ $task->id }}')" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">Complete</a>
                                    <script>
                                        function confirmUpdateStatus(taskId) {
                                            if (confirm('Are you sure you want to update the status?')) {
                                                updateToOpenStatus(taskId);
                                            }
                                        }
                                        function updateToOpenStatus(taskId) {
                                            //Send an AJAX request to update the status
                                            axios.put('/tasks/' + taskId + '/update-to-open-status')
                                                .then(response => {
                                                    alert("Task Update Successfully!")
                                                    window.location.reload();
                                                })
                                                .catch(error => {
                                                    console.error('Error updating status:', error);
                                                });
                                        }
                                    </script>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
             </div>
                {{ $completedTasks->links() }}
             <div>
                <hr>
             </div>
             <div>
             <b>Completed Tasks List</b>
             <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" style="table-layout: fixed;">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Task Name</th>
                            <th cope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">For</th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Status</th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($openTasks as $task)
                            <tr>
                                <td class="px-6 py-4" style="width: 300px;">{{ $task->task_name }}</td>
                                <td class="px-6 py-4">
                                    @if ($task->taskable_type === 'App\Models\Person')
                                        <i class="fa fa-user"></i>&nbsp;&nbsp;{{ $task->for }}
                                    @else
                                        <i class="fa fa-building"></i>&nbsp;&nbsp;{{ $task->for }}
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $task->status == 1 ? 'Completed' : 'Open' }}</td>
                                <td class="px-6 py-4">
                                    <button onclick="confirmUpdateStatus('{{ $task->id }}')" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Re-Open</a>
                                    <script>
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
             </div>
        </div>
        {{ $openTasks->links() }}
        </div>
    </div>
</x-app-layout>