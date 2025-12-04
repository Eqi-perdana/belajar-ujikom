@extends('layouts.app')

@section('title', 'Edit Task')

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
    // warna prioritas
    $priorityColor = '#0d6efd';
    if ($task->priority <= 2) $priorityColor = '#198754';
    if ($task->priority >= 4) $priorityColor = '#dc3545';
@endphp

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">✏️ Edit Task</h2>

        <a href="{{ route('tasks.index') }}" class="btn btn-secondary shadow-sm">
            Kembali
        </a>
    </div>

    <div class="card card-task shadow-sm border-0" style="border-left-color: {{ $priorityColor }};">
        <div class="card-body p-4">

            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Task --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Task</label>
                    <input type="text" name="name"
                           value="{{ old('name', $task->name) }}"
                           class="form-control rounded-3 @error('name') is-invalid @enderror"
                           placeholder="Masukkan nama task">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select rounded-3">
                        <option value="0" {{ !$task->status ? 'selected' : '' }}>Belum</option>
                        <option value="1" {{ $task->status ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                {{-- Prioritas --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Prioritas (1-5)</label>
                    <input type="number" name="priority" min="1" max="5"
                           value="{{ old('priority', $task->priority) }}"
                           class="form-control rounded-3 @error('priority') is-invalid @enderror"
                           placeholder="Masukkan prioritas">

                    @error('priority')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Due Date --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tenggat Waktu (Due Date)</label>
                    <input type="date" name="due_date"
                           value="{{ old('due_date', $task->due_date) }}"
                           class="form-control rounded-3">
                </div>

                {{-- Tombol --}}
                <button class="btn btn-primary px-4 py-2 shadow-sm rounded-3">
                    Update Task
                </button>

                <a href="{{ route('tasks.index') }}" class="btn btn-light px-4 py-2 shadow-sm rounded-3 ms-2">
                    Batal
                </a>

            </form>

        </div>
    </div>

</div>
@endsection
