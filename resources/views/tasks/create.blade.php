@extends('layouts.app')

@section('title', 'Tambah Task')

@section('content')
<div class="container mt-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">➕ Tambah Task Baru</h2>

        <a href="{{ route('tasks.index') }}" class="btn btn-secondary rounded-pill shadow-sm px-4">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Card Form --}}
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                {{-- Nama Task --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Nama Task</label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           class="form-control form-control-lg rounded-pill shadow-sm @error('name') is-invalid @enderror"
                           placeholder="Masukkan nama task">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status"
                            class="form-select form-select-lg rounded-pill shadow-sm">
                        <option value="0">Belum</option>
                        <option value="1">Selesai</option>
                    </select>
                </div>

                {{-- Prioritas --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Prioritas (1-5)</label>
                    <input type="number"
                           name="priority"
                           min="1"
                           max="5"
                           value="{{ old('priority', 3) }}"
                           class="form-control form-control-lg rounded-pill shadow-sm @error('priority') is-invalid @enderror"
                           placeholder="Masukkan prioritas">

                    @error('priority')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Due Date --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Tenggat Waktu (Due Date)</label>
                    <input type="date"
                           name="due_date"
                           value="{{ old('due_date') }}"
                           class="form-control form-control-lg rounded-pill shadow-sm">
                </div>

                {{-- Submit --}}
                <div class="mt-4">
                    <button class="btn btn-primary rounded-pill px-5 py-2 shadow-sm fw-semibold">
                        <i class="bi bi-save2 me-1"></i> Simpan Task
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

{{-- Custom UI --}}
<style>
    .form-control,
    .form-select {
        border: 1.5px solid #d9e2ef;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #80aaff !important;
        box-shadow: 0 0 0 0.15rem rgba(0, 123, 255, 0.2) !important;
    }
</style>
@endsection
