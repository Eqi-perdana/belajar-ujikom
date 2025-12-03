@extends('layouts.app')

@section('title', 'Tambah Task')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">➕ Tambah Task Baru</h2>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary shadow-sm">
            Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                {{-- Nama Task --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Task</label>
                    <input type="text" name="name"
                           value="{{ old('name') }}"
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
                        <option value="0">Belum</option>
                        <option value="1">Selesai</option>
                    </select>
                </div>

                {{-- Prioritas --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Prioritas (1-5)</label>
                    <input type="number" name="priority" min="1" max="5"
                           value="{{ old('priority', 3) }}"
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
                           value="{{ old('due_date') }}"
                           class="form-control rounded-3">
                </div>

                <button class="btn btn-primary px-4 py-2 shadow-sm rounded-3">
                    Simpan Task
                </button>
            </form>

        </div>
    </div>

</div>
@endsection
