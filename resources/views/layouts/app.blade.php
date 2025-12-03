<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Task Manager</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f7f7f7;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .card {
            border-radius: 10px;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('tasks.index') }}">Task Manager</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
                    aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>
            </button>

        </div>
    </nav>

    {{-- Content --}}
    @yield('content')

    {{-- Bootstrap JS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
