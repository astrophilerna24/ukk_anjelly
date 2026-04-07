<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Siswa | Aplikasi Aspirasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 15px; border: none; }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary">Daftar Akun Siswa</h3>
                    <p class="text-muted">Silakan isi data diri untuk mulai menyampaikan aspirasi</p>
                </div>

                
                <form action="{{ route('siswa.register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nomor Induk Siswa (NIS)</label>
                        <input type="number" name="nis" class="form-control @error('nis') is-invalid @enderror" placeholder="Contoh: 12345" required>
                        @error('nis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kelas</label>
                        <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" placeholder="Contoh: XI-RPL 1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 5 karakter" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">Daftar Sekarang</button>
                    
                    <div class="text-center mt-3">
                        <small>Sudah punya akun? <a href="{{ route('siswa.login') }}" class="text-decoration-none">Login di sini</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>