<?php

namespace App\Http\Controllers;


use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():Response
    {
        return Inertia::render('Tasks/Index', [
            'tasks' => Task::with('user:id,name')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

     public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
        ]);
 
        $request->user()->tasks()->create($validated);
 
        return redirect(route('tasks.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);
 
        $validated = $request->validate([
            'tasks_name' => 'required|string|max:255',
        ]);
 
        $task->update($validated);
 
        return redirect(route('tasks.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task):RedirectResponse
    {
        $this->authorize('delete', $task);
 
        $task->delete();
 
        return redirect(route('tasks.index'));
    }
}
