<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Aspirasi Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; }
        .sidebar { min-height: 100vh; background: #212529; color: white; padding: 20px; z-index: 100; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .table thead { background-color: #f8f9fa; }
        .filter-section { background: white; padding: 20px; border-radius: 12px; margin-bottom: 25px; }
        /* Style tambahan untuk thumbnail foto */
        .img-admin { width: 50px; height: 50px; object-fit: cover; border-radius: 5px; transition: 0.3s; cursor: pointer; }
        .img-admin:hover { transform: scale(1.1); }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar d-none d-md-block position-fixed">
            <h4 class="fw-bold text-center mt-3">ADMIN PANEL</h4>
            <p class="text-muted text-center small">Manajemen Aspirasi</p>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-white active">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
            </ul>
            <hr>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm w-100 shadow-sm">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
        </div>

        <div class="col-md-10 offset-md-2 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold m-0">Daftar Aspirasi Siswa</h2>
                <span class="badge bg-primary px-3 py-2">Total: {{ $aspirasis->count() }} Data</span>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            
            <div class="filter-section shadow-sm">
                <h6 class="fw-bold mb-3"><i class="bi bi-filter-left me-1"></i> Filter Data</h6>
                <form action="{{ route('admin.dashboard') }}" method="GET" class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label small fw-semibold">Per Tanggal</label>
                        <input type="date" name="tanggal" class="form-control form-control-sm" value="{{ request('tanggal') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-semibold">Per Bulan</label>
                        <input type="month" name="bulan" class="form-control form-control-sm" value="{{ request('bulan') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold">Kategori</label>
                        <select name="id_kategori" class="form-select form-select-sm">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id_kategori }}" {{ request('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                                    {{ $k->ket_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-semibold">NIS Siswa</label>
                        <input type="number" name="nis" class="form-control form-control-sm" placeholder="Cari NIS..." value="{{ request('nis') }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary btn-sm px-3">
                            <i class="bi bi-search me-1"></i> Cari
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-sm px-3 border">Reset</a>
                    </div>
                </form>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Siswa (NIS)</th>
                                    <th>Bukti</th> <th>Kategori</th>
                                    <th>Keterangan & Lokasi</th>
                                    <th>Status & Tanggapan Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($aspirasis as $item)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $item->siswa->nama ?? 'Siswa' }}</div>
                                        <div class="text-muted small">NIS: {{ $item->nis }}</div>
                                        <div class="text-muted" style="font-size: 10px;">{{ $item->created_at->format('d/m/Y H:i') }}</div>
                                    </td>
                                    <td>
                                        @if($item->foto)
                                            <a href="{{ asset('public/storage' . $item->foto) }}" target="_blank">
                                                <img src="{{ asset('public/storage/' . $item->foto) }}" class="img-admin img-thumbnail" title="Klik untuk memperbesar">
                                            </a>
                                        @else
                                            <span class="text-muted small italic">No Photo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-info text-dark px-3">{{ $item->kategori->ket_kategori }}</span>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-primary"><i class="bi bi-geo-alt me-1"></i>{{ $item->lokasi }}</div>
                                        <div class="small" style="max-width: 200px;">{{ $item->ket }}</div>
                                    </td>
                                    <td class="pe-4">
                                        <form action="{{ route('aspirasi.update', $item->id_aspirasi) }}" method="POST">
                                            @csrf
                                            <input type="text" name="feedback" class="form-control form-control-sm mb-2" 
                                                   placeholder="Beri tanggapan..." value="{{ $item->feedback }}" required>
                                            
                                            <div class="input-group input-group-sm">
                                                <select name="status" class="form-select">
                                                    <option value="Menunggu" {{ $item->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                    <option value="Proses" {{ $item->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                                    <option value="Selesai" {{ $item->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                </select>
                                                <button type="submit" class="btn btn-dark shadow-sm">Update</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-clipboard-x fs-1 d-block mb-2"></i>
                                        Data aspirasi tidak ditemukan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>