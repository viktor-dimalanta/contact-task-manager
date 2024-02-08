<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold mt-4 mb-2">Tasks</h1>
            <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add New Task</a>
            <table class="table-auto mt-4">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="border px-4 py-2">{{ $task->id }}</td>
                            <td class="border px-4 py-2">{{ $task->title }}</td>
                            <td class="border px-4 py-2">{{ $task->description }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
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