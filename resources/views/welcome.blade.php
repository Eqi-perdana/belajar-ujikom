@extends('layouts.app')

@section('title', 'ToDoList — Manage Your Tasks')

@section('content')
<style>
    body {
        background: #f5f7fb;
    }
    .hero-section {
        padding: 100px 0;
    }
    .hero-title {
        font-size: 3rem;
        font-weight: 700;
        color: #2c3e50;
    }
    .hero-subtitle {
        font-size: 1.3rem;
        color: #555;
    }
    .feature-card:hover {
        transform: translateY(-5px);
        transition: 0.3s ease;
    }
</style>

<div class="container">

    {{-- HERO SECTION --}}
    <div class="row align-items-center hero-section">
        <div class="col-md-6">
            <h1 class="hero-title mb-3">Stay Organized and Productive</h1>
            <p class="hero-subtitle mb-4">
                Kelola aktivitas harian Anda dengan mudah menggunakan aplikasi ToDoList modern,
                cepat, elegan, dan nyaman digunakan.
            </p>

            <a href="{{ route('tasks.index') }}" class="btn btn-primary btn-lg shadow-lg px-4 py-2 rounded-pill">
                <i class="bi bi-check2-circle me-2"></i> Mulai Kelola Task
            </a>
        </div>

        <div class="col-md-6 text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/4206/4206277.png"
                 class="img-fluid"
                 style="max-width: 70%;"
                 alt="ToDo Illustration">
        </div>
    </div>

    {{-- FEATURES --}}
    <div class="row mt-5 mb-5">
        <div class="col-md-12 text-center mb-4">
            <h2 class="fw-bold">Fitur Utama</h2>
            <p class="text-muted">Kelola task dengan cara yang lebih cerdas dan efisien.</p>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 rounded-4 feature-card p-4">
                <div class="text-center mb-3">
                    <i class="bi bi-ui-checks-grid fs-1 text-primary"></i>
                </div>
                <h5 class="fw-bold text-center">Manajemen Task Modern</h5>
                <p class="text-muted text-center">
                    Tambah, edit, hapus, dan tandai task selesai dengan mudah.
                </p>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 rounded-4 feature-card p-4">
                <div class="text-center mb-3">
                    <i class="bi bi-phone fs-1 text-primary"></i>
                </div>
                <h5 class="fw-bold text-center">Responsif & Mobile Friendly</h5>
                <p class="text-muted text-center">
                    Tampilan sangat rapi di semua ukuran layar, baik PC maupun HP.
                </p>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 rounded-4 feature-card p-4">
                <div class="text-center mb-3">
                    <i class="bi bi-cloud-check fs-1 text-primary"></i>
                </div>
                <h5 class="fw-bold text-center">Data Aman</h5>
                <p class="text-muted text-center">
                    Semua task Anda tersimpan dengan aman dan dapat diakses kapan saja.
                </p>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="text-center text-muted mb-4 mt-5">
        <small>© {{ date('Y') }} Todolist App — Elegant Task Manager</small>
    </div>

</div>
@endsection
