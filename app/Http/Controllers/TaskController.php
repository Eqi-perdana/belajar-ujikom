<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   public function index(Request $request)
{
    $query = Task::query();

    // Search (hanya berdasarkan name)
    if ($request->search) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Filter status
    if ($request->status !== null && $request->status !== '') {
        $query->where('status', $request->status);
    }

    // Filter priority
    if ($request->priority !== null && $request->priority !== '') {
        $query->where('priority', $request->priority);
    }

    // Urutkan berdasarkan priority
    $query->orderBy('priority', 'asc');

    // Pagination
    $tasks = $query->paginate(10);

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

    public function toggle($id)
{
    $task = Task::findOrFail($id);

    // toggle status: jika 1 jadi 0, jika 0 jadi 1
    $task->status = !$task->status;
    $task->save();

    return redirect()->route('tasks.index')
        ->with('success', 'Status task berhasil diperbarui!');
}
}
