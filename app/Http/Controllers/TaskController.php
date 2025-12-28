<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $projects = Project::orderBy('name')->get();
        $selectedProjectId = $request->query('project_id');

        $query = Task::ordered()->with('project');

        if ($selectedProjectId) {
            $query->where('project_id', $selectedProjectId);
        }

        $tasks = $query->get();

        return view('tasks.index', compact('tasks', 'projects', 'selectedProjectId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Auto-calculate priority: Last item + 1
        $maxPriority = Task::where('project_id', $validated['project_id'])
            ->max('priority') ?? 0;

        $validated['priority'] = $maxPriority + 1;

        Task::create($validated);

        return redirect()->route('tasks.index', ['project_id' => $validated['project_id']])
            ->with('success', 'Task created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        $projects = Project::orderBy('name')->get();
        return view('tasks.edit', compact('task', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());

        return redirect()->route('tasks.index', ['project_id' => $task->project_id])
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $projectId = $task->project_id;
        $task->delete();

        return redirect()->route('tasks.index', ['project_id' => $projectId])
            ->with('success', 'Task deleted successfully.');
    }

    /**
     * Reorder tasks via Drag and Drop API.
     */
    public function reorder(Request $request): JsonResponse
    {
        $request->validate([
            'tasks' => ['required', 'array'],
            'tasks.*' => ['integer', 'exists:tasks,id'],
        ]);

        // Using a transaction for safety
        \DB::transaction(function () use ($request) {
            foreach ($request->input('tasks') as $index => $id) {
                Task::where('id', $id)->update(['priority' => $index + 1]);
            }
        });

        return response()->json(['status' => 'success', 'message' => 'Tasks reordered.']);
    }
}
