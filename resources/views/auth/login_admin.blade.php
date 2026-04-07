<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Aplikasi Aspirasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .card { border-radius: 15px; border: none; }
        .btn-admin { background-color: #dc3545; border: none; color: white; }
        .btn-admin:hover { background-color: #bb2d3b; color: white; }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-danger">Panel Admin</h3>
                    <p class="text-muted">Khusus Petugas & Administrator</p>
                </div>

                @if($errors->has('msg'))
                    <div class="alert alert-danger text-sm p-2 text-center">
                        {{ $errors->first('msg') }}
                    </div>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="******" required>
                    </div>

                    <button type="submit" class="btn btn-admin w-100 py-2 fw-bold shadow-sm">Masuk ke Dashboard</button>
                    
                    <div class="text-center mt-3">
                        <a href="/" class="text-decoration-none text-muted small">← Kembali Ke Halaman Utama</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>