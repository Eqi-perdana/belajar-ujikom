@extends('layouts.app')

@section('title', 'Detail Task')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Detail Task</h2>

    <div class="card">
        <div class="card-body">

            <h4>{{ $task->name }}</h4>

            <p><strong>Status:</strong>
                @if ($task->status)
                    <span class="badge bg-success">Selesai</span>
                @else
                    <span class="badge bg-warning text-dark">Belum</span>
                @endif
            </p>

            <p><strong>Prioritas:</strong> {{ $task->priority }}</p>
            <p><strong>Due Date:</strong> {{ $task->due_date ?? '-' }}</p>

            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Kembali</a>

        </div>
    </div>
</div>
@endsection
