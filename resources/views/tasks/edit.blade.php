@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Edit Task</h2>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Task</label>
            <input type="text" name="name" value="{{ old('name', $task->name) }}"
                   class="form-control @error('name') is-invalid @enderror">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="0" {{ !$task->status ? 'selected' : '' }}>Belum</option>
                <option value="1" {{ $task->status ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Prioritas</label>
            <input type="number" name="priority" min="1" max="5"
                   value="{{ old('priority', $task->priority) }}"
                   class="form-control @error('priority') is-invalid @enderror">

            @error('priority')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Due Date</label>
            <input type="date" name="due_date" value="{{ old('due_date', $task->due_date) }}"
                   class="form-control">
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
