@extends('layouts.app')

@section('title', 'Daftar Task')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📌 Daftar Task</h2>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary shadow-sm">
            + Tambah Task
        </a>
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th width="70">id</th>
                        <th>Nama Task</th>
                        <th width="140">Status</th>
                        <th width="120">Prioritas</th>
                        <th width="140">Due Date</th>
                        <th width="220">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($tasks as $task)
                        <tr class="table-row-hover">
                            <td class="fw-bold">{{ $loop->iteration }}</td>

                            <td class="fw-semibold">
                                <span class="text-dark">{{ $task->name }}</span>
                                <br>
                                <small class="text-muted">{{ Str::limit($task->description, 40) }}</small>
                            </td>

                            {{-- Status --}}
                            <td>
                                @if ($task->status)
                                    <span class="badge bg-success px-3 py-2 shadow-sm">Selesai</span>
                                @else
                                    <span class="badge bg-warning text-dark px-3 py-2 shadow-sm">Belum</span>
                                @endif
                            </td>

                            {{-- Prioritas --}}
                            <td>
                                @php
                                    $color = match($task->priority) {
                                        1 => 'danger',
                                        2 => 'warning',
                                        default => 'secondary'
                                    };
                                @endphp

                                <span class="badge bg-{{ $color }} px-3 py-2 shadow-sm">
                                    P{{ $task->priority }}
                                </span>
                            </td>

                            {{-- Due date --}}
                            <td class="fw-semibold">
                                {{ $task->due_date ? date('d M Y', strtotime($task->due_date)) : '-' }}
                            </td>

                            <td>
                                <a href="{{ route('tasks.show', $task->id) }}"
                                   class="btn btn-info btn-sm shadow-sm me-1">
                                    Detail
                                </a>

                                <a href="{{ route('tasks.edit', $task->id) }}"
                                   class="btn btn-warning btn-sm shadow-sm me-1">
                                    Edit
                                </a>

                                <form action="{{ route('tasks.destroy', $task->id) }}"
                                      class="d-inline"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus task ini?');">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm shadow-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <div class="py-4">
                                    <h5 class="text-muted mb-1">Belum ada task</h5>
                                    <p class="small">Silakan tambah task baru</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

<style>
    .table-row-hover:hover {
        background: #f7f9fc !important;
        transition: 0.2s;
    }
</style>
@endsection
