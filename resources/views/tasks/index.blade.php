@extends('layouts.app')

@section('title', 'Daftar Task')

@section('content')
    <div class="container mt-5">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">📌 Daftar Task</h2>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary shadow-sm rounded-pill px-4">
                <i class="bi bi-plus-circle me-1"></i> Tambah Task
            </a>
        </div>

        {{-- Search & Filter --}}
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3">

                    {{-- Search --}}
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control rounded-pill" placeholder="🔍 Cari task..."
                            value="{{ request('search') }}">
                    </div>

                    {{-- Filter Status --}}
                    <div class="col-md-3">
                        <select name="status" class="form-select rounded-pill">
                            <option value="">Filter Status</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Selesai</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Belum</option>
                        </select>
                    </div>

                    {{-- Filter Prioritas --}}
                    <div class="col-md-3">
                        <select name="priority" class="form-select rounded-pill">
                            <option value="">Filter Prioritas</option>
                            <option value="1" {{ request('priority') == '1' ? 'selected' : '' }}>Tinggi</option>
                            <option value="2" {{ request('priority') == '2' ? 'selected' : '' }}>Sedang</option>
                            <option value="3" {{ request('priority') == '3' ? 'selected' : '' }}>Rendah</option>
                        </select>
                    </div>

                    <div class="col-md-2 d-grid">
                        <button class="btn btn-outline-primary rounded-pill">
                            Terapkan
                        </button>
                    </div>

                </form>
            </div>
        </div>

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="alert alert-success shadow-sm rounded-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-body p-0">

                <table class="table table-hover mb-0 align-middle">

                    <thead class="table-light" style="background: #eef4ff;">
                        <tr class="text-primary">
                            <th width="70">Id</th>
                            <th>Nama Task</th>
                            <th width="140">Status</th>
                            <th width="120">Prioritas</th>
                            <th width="160">Due Date</th>
                            <th width="220" class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($tasks as $task)
                            @php
                                $isOverdue = $task->due_date && now()->gt($task->due_date) && !$task->status;
                            @endphp

                            <tr class="table-row-hover {{ $isOverdue ? 'table-danger' : '' }}">

                                <td class="fw-bold text-secondary">{{ $loop->iteration }}</td>

                                {{-- Name + Description --}}
                                <td class="fw-semibold">
                                    <span class="text-dark fs-6 fw-bold">{{ $task->name }}</span>
                                    <br>
                                    <small class="text-muted fst-italic">
                                        (Tidak ada deskripsi)
                                    </small>
                                </td>

                                {{-- Status --}}
                                <td>
                                    @if ($task->status)
                                        <span class="badge status-badge bg-success-subtle text-success">
                                            ✔ Selesai
                                        </span>
                                    @else
                                        <span class="badge status-badge bg-warning-subtle text-warning">
                                            ⏳ Belum
                                        </span>
                                    @endif
                                </td>

                                {{-- Priority --}}
                                <td>
                                    @php
                                        $color =
                                            [
                                                1 => 'danger',
                                                2 => 'warning',
                                                3 => 'secondary',
                                            ][$task->priority] ?? 'secondary';

                                        $label =
                                            [
                                                1 => 'Tinggi',
                                                2 => 'Sedang',
                                                3 => 'Rendah',
                                            ][$task->priority] ?? 'Tidak ada';
                                    @endphp

                                    <span class="badge px-3 py-2 rounded-pill bg-{{ $color }} text-white shadow-sm">
                                        {{ $label }}
                                    </span>
                                </td>

                                {{-- Due date --}}
                                <td class="fw-semibold text-secondary">
                                    {{ $task->due_date ? date('d M Y', strtotime($task->due_date)) : '-' }}
                                </td>

                                <td>
                                    <div class="d-flex align-items-center gap-2">

                                        <a href="{{ route('tasks.show', $task->id) }}"
                                            class="btn btn-outline-info btn-sm rounded-pill px-3 d-flex align-items-center gap-1">
                                            <i class="bi bi-eye"></i>
                                            <span>Detail</span>
                                        </a>

                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                            class="btn btn-outline-warning btn-sm rounded-pill px-3 d-flex align-items-center gap-1">
                                            <i class="bi bi-pencil-square"></i>
                                            <span>Edit</span>
                                        </a>

                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus task ini?');">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="btn btn-outline-danger btn-sm rounded-pill px-3 d-flex align-items-center gap-1">
                                                <i class="bi bi-trash"></i>
                                                <span>Hapus</span>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <div>
                                        <h5 class="fw-bold text-secondary mb-1">Belum ada task</h5>
                                        <p class="small">Silakan tambah task baru</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $tasks->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>

    </div>

    {{-- Custom UI --}}
    <style>
        .table-row-hover:hover {
            background: #f4f7ff !important;
            transition: 0.2s ease;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.04);
        }

        .status-badge {
            font-size: 0.85rem;
            padding: 6px 12px;
            border-radius: 18px;
            font-weight: 600;
        }
    </style>
@endsection
