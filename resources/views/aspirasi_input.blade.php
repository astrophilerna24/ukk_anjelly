<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Aspirasi | Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card { border: none; border-radius: 15px; }
        .table-primary { --bs-table-bg: #0d6efd; --bs-table-color: #fff; }
        .badge { font-weight: 500; padding: 0.5em 0.8em; }
        .img-preview { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; cursor: pointer; }
    </style>
</head>
<body class="p-4 p-md-5">
    <div class="container" style="max-width: 1100px">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-primary m-0">Sampaikan Aspirasi Anda</h3>
                <p class="text-muted m-0">Gunakan form di bawah untuk mengirim pengaduan sarana prasarana.</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm px-3 shadow-sm">Logout</button>
            </form>
        </div>
        
        <div class="card shadow-sm p-4 mb-5 border-top border-primary border-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">NIS Anda</label>
                        <input type="number" name="nis" class="form-control bg-light fw-bold text-muted" value="{{ Auth::guard('siswa')->user()->nis ?? '' }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="id_kategori" class="form-select" required>
                            <option value="" selected disabled>Pilih Kategori...</option>
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id_kategori }}">{{ $k->ket_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                     <div class="col-md-4 mb-3">
                        <label class="form-label
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Foto Bukti (Opsional)</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Lokasi Kejadian</label>
                    <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Lab Komp 2, Kantin, atau Kamar Mandi" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Keterangan Aspirasi</label>
                    <textarea name="ket" class="form-control" rows="4" placeholder="Ceritakan detail aspirasi atau keluhan Anda secara lengkap..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                    <i class="bi bi-send-fill me-2"></i> Kirim Aspirasi Sekarang
                </button>
            </form>
        </div>

        <h4 class="fw-bold mb-3 text-dark">Histori & Progres Aspirasi</h4>
        <div class="card shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th width="120">Tgl Lapor</th>
                            <th width="100">Foto</th> <th>Keterangan</th>
                            <th width="120">Status</th>
                            <th>Umpan Balik Admin</th>
                            <th width="140">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aspirasis as $aspi)
                        <tr>
                            <td class="text-center small fw-bold text-muted">
                                {{ $aspi->created_at->format('d/m/Y') }}
                            </td>
                            <td class="text-center">
                                @if($aspi->foto)
                                    <a href="{{ asset('/public/storage/' . $aspi->foto) }}" target="_blank">
                                        <img src="{{ asset('/public/storage/' . $aspi->foto) }}" class="img-preview img-thumbnail">
                                    </a>
                                @else
                                    <i class="bi bi-image text-muted fs-3"></i>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $aspi->kategori->ket_kategori ?? 'Umum' }}</div>
                                <div class="text-muted small">{{ Str::limit($aspi->ket, 50) }}</div>
                                <div class="badge bg-light text-dark border mt-1" style="font-size: 10px;">📍 {{ $aspi->lokasi }}</div>
                            </td>
                            <td class="text-center">
                                @if($aspi->status == 'Menunggu')
                                    <span class="badge bg-secondary">Menunggu</span>
                                @elseif($aspi->status == 'Proses')
                                    <span class="badge bg-warning text-dark">Proses</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                            <td>
                                @if($aspi->feedback)
                                    <div class="p-2 rounded bg-light border-start border-primary border-3">
                                        <div class="small fw-bold text-primary mb-1">
                                            <i class="bi bi-calendar-check me-1"></i> 
                                            Ditanggapi: {{ $aspi->tgl_feedback ? \Carbon\Carbon::parse($aspi->tgl_feedback)->format('d/m/Y') : '-' }}
                                        </div>
                                        <div class="small text-dark fst-italic">"{{ $aspi->feedback }}"</div>
                                    </div>
                                @else
                                    <span class="text-muted small fst-italic">Menunggu tanggapan admin...</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($aspi->status == 'Menunggu')
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('aspirasi.edit', $aspi->id_aspirasi) }}" class="btn btn-sm btn-warning text-white px-3 shadow-sm">Edit</a>
                                        <form action="{{ route('aspirasi.destroy', $aspi->id_aspirasi) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger px-2 shadow-sm">Hapus</button>
                                        </form>
                                    </div>
                                @else
                                    <div class="text-muted small">
                                        <i class="bi bi-lock-fill"></i> 🔒 Terkunci
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center py-5 text-muted">Belum ada aspirasi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>