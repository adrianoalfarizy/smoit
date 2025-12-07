<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SMO IT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Pakai Bootstrap CDN biar cepat --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">SMO IT</a>
    </div>
</nav>

<div class="container mb-5">
    {{-- Flash message sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validasi error global (kalau mau tampil di semua halaman) --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>

</body>
</html>

