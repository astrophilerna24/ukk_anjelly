<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa | Aplikasi Aspirasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #e9ecef; }
        .card { border-radius: 15px; border: none; }
    </style>
</head>
<body>
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-success">Login Siswa</h3>
                    <p class="text-muted">Gunakan NIS dan Password kamu</p>
                </div>

                
                <form action="{{ route('siswa.login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">NIS</label>
                        <input type="number" name="nis" class="form-control" placeholder="Masukkan NIS" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                    </div>

                    

                    @if($errors->has('msg'))
                        <div class="alert alert-danger p-2 small text-center">{{ $errors->first('msg') }}</div>
                    @endif

                    <button type="submit" class="btn btn-success w-100 py-2 fw-bold shadow-sm">Masuk</button>
                    
                    <div class="text-center mt-3">
                        <small>Belum punya akun? <a href="{{ route('siswa.register') }}" class="text-decoration-none">Daftar Akun</a></small>
                    </div>

                    <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-muted text-decoration-none small">Login sebagai Admin</a>
            </div>

                </form>
            </div>
            
        </div>
    </div>
</div>
</body>
</html>