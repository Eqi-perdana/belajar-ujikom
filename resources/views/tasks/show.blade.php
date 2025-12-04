@extends('layouts.app')

@section('title', 'Detail Task')

@section('content')
<style>
    .card-task {
        transition: transform .2s ease, box-shadow .3s ease;
        border-left: 6px solid #0d6efd;
    }
    .card-task:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
</style>

@php
    // warna prioritas otomatis
    $priorityColor = 'bg-primary';
    if ($task->priority <= 2) $priorityColor = 'bg-success';
    if ($task->priority >= 4) $priorityColor = 'bg-danger';

    // warna border card
    $borderColor = '#0d6efd';
    if ($task->priority <= 2) $borderColor = '#198754';
    if ($task->priority >= 4) $borderColor = '#dc3545';
@endphp

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📌 Detail Task</h2>

        <a href="{{ route('tasks.index') }}" class="btn btn-secondary shadow-sm">
            Kembali
        </a>
    </div>

    <div class="card card-task shadow-sm border-0" style="border-left-color: {{ $borderColor }};">
        <div class="card-body p-4">

            {{-- Nama Task --}}
            <h3 class="fw-bold text-dark mb-3">{{ $task->name }}</h3>

            {{-- Status --}}
            <p class="mb-2">
                <strong>Status:</strong>
                @if ($task->status)
                    <span class="badge bg-success px-3 py-2">Selesai</span>
                @else
                    <span class="badge bg-warning text-dark px-3 py-2">Belum</span>
                @endif
            </p>

            {{-- Prioritas --}}
            <p class="mb-2">
                <strong>Prioritas:</strong>
                <span class="badge {{ $priorityColor }} px-3 py-2">
                    Level {{ $task->priority }}
                </span>
            </p>

            {{-- Due Date --}}
            <p class="mb-3">
                <strong>Due Date:</strong> 
                {{ $task->due_date ? date('d M Y', strtotime($task->due_date)) : '-' }}
            </p>

            {{-- Progress Bar --}}
            <div class="mb-4">
                <label class="fw-bold">Progress:</label>
                <div class="progress" style="height: 12px;">
                    <div class="progress-bar {{ $task->status ? 'bg-success' : 'bg-warning' }}"
                         role="progressbar"
                         style="width: {{ $task->status ? '100%' : '40%' }}">
                    </div>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="mt-4">

                {{-- Button Mark Complete / Undo --}}
                <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button class="btn {{ $task->status ? 'btn-outline-warning' : 'btn-success' }} px-4">
                        {{ $task->status ? 'Tandai Belum' : 'Tandai Selesai' }}
                    </button>
                </form>

                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning px-4 ms-1">
                    Edit
                </a>

                <a href="{{ route('tasks.index') }}" class="btn btn-secondary px-4 ms-1">
                    Kembali
                </a>

            </div>

        </div>
    </div>

</div>
@endsection
