@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar / Controls -->
        <div class="md:w-1/3 space-y-6">
            <!-- Project Filter -->
            <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 shadow-sm">
                <h2 class="text-lg font-bold text-gray-700 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                        </path>
                    </svg>
                    Filter by Project
                </h2>
                <form method="GET" action="{{ route('tasks.index') }}">
                    <select name="project_id" onchange="this.form.submit()"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 pl-3 pr-10 text-base sm:text-sm border">
                        <option value="">All Projects</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ $selectedProjectId == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
                @if($selectedProjectId)
                    <div class="mt-3 text-right">
                        <a href="{{ route('tasks.index') }}"
                            class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 uppercase tracking-wider">Clear
                            Filter &times;</a>
                    </div>
                @endif
            </div>

            <!-- Create Form -->
            <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 shadow-sm">
                <h2 class="text-lg font-bold text-gray-700 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Task
                </h2>
                <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Task Name</label>
                        <input type="text" name="name" required placeholder="What needs to be done?"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Project</label>
                        <select name="project_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="" disabled {{ !$selectedProjectId ? 'selected' : '' }}>Select a project...
                            </option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ $selectedProjectId == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Add Task
                    </button>
                </form>
            </div>
        </div>

        <!-- Task List -->
        <div class="md:w-2/3">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center justify-between">
                <span>Task List</span>
                <span class="text-sm font-normal text-gray-500 bg-gray-100 px-2 py-1 rounded-full">{{ $tasks->count() }}
                    tasks</span>
            </h2>

            @if($tasks->isEmpty())
                <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No tasks found</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new task.</p>
                </div>
            @else
                <ul id="sortable-tasks" class="space-y-3">
                    @foreach($tasks as $task)
                        <li data-id="{{ $task->id }}"
                            class="bg-white border rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow group flex items-center justify-between cursor-move relative overflow-hidden">
                            <!-- Drag Handle Indicator (Left Border) -->
                            <div
                                class="absolute left-0 top-0 bottom-0 w-1 bg-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>

                            <div class="flex items-center gap-4">
                                <span class="text-gray-300 cursor-grab group-hover:text-gray-500 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16">
                                        </path>
                                    </svg>
                                </span>

                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">{{ $task->name }}</h3>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $task->project->name }}
                                        </span>
                                        <span class="text-xs text-gray-400">Priority: {{ $task->priority }}</span>
                                        <span class="text-xs text-gray-400">&bull; {{ $task->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity focus-within:opacity-100">
                                <a href="{{ route('tasks.edit', $task) }}"
                                    class="p-2 text-gray-400 hover:text-indigo-600 transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </a>

                                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition-colors"
                                        title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <p class="text-xs text-gray-400 mt-2 text-right">Drag and drop to reorder tasks.</p>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            const el = document.getElementById('sortable-tasks');
            if (el) {
                Sortable.create(el, {
                    animation: 150,
                    handle: 'li', // Make the whole list item draggable
                    ghostClass: 'sortable-ghost',
                    dragClass: 'sortable-drag',
                    onEnd: function (evt) {
                        // Collect IDs
                        let orderedIds = [];
                        el.querySelectorAll('li').forEach(function (node) {
                            orderedIds.push(node.getAttribute('data-id'));
                        });

                        // Send API Request
                        fetch('{{ route("tasks.reorder") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ tasks: orderedIds })
                        })
                            .then(response => response.json())
                            .then(data => {
                                console.log('Order updated:', data);
                                // Optional: Show a toast notification here
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            }
        </script>
    @endpush
@endsection