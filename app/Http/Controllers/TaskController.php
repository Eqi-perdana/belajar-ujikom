<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('priority', 'asc')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'priority' => 'required|integer|min:1|max:5'
    ]);

    Task::create([
        'name' => $request->name,
        'status' => $request->status,
        'priority' => $request->priority,
        'due_date' => $request->due_date
    ]);

    return redirect()->route('tasks.index')->with('success', 'Task berhasil ditambahkan!');
}

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'status'    => 'boolean',
            'priority'  => 'integer|min:1|max:5',
            'due_date'  => 'date|nullable',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task berhasil diperbarui');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task berhasil dihapus');
    }
}
