@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Edit Task</h2>
            <a href="{{ route('tasks.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                &larr; Back to Dashboard
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700">Task Name</label>
                    <input type="text" name="name" value="{{ old('name', $task->name) }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-3 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Project</label>
                    <div class="mt-1 relative">
                        <select name="project_id" required
                            class="block w-full rounded-md border-gray-300 shadow-sm border p-3 focus:ring-indigo-500 focus:border-indigo-500">
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3">
                    <a href="{{ route('tasks.index') }}"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 text-sm font-medium transition-colors">Cancel</a>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm font-medium shadow-sm transition-colors">
                        Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection