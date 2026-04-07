<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Aspirasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .img-edit-preview {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
            border: 2px solid #dee2e6;
        }
    </style>
</head>
<body class="p-5 bg-light">
    <div class="container" style="max-width: 600px">
        <div class="card border-0 shadow-sm p-4">
            <h4 class="fw-bold mb-4">Edit Data Aspirasi</h4>
            
            <form action="{{ route('aspirasi.updateData', $aspirasi->id_aspirasi) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                
                <div class="mb-3 text-center">
                    <label class="form-label d-block fw-bold text-start">Foto Saat Ini</label>
                    @if($aspirasi->foto)
                        <img src="{{ asset('public/storage/' . $aspirasi->foto) }}" class="img-edit-preview shadow-sm" id="preview-lama">
                    @else
                        <div class="p-4 bg-light border rounded mb-2 text-muted small">
                            <i class="bi bi-image"></i> Belum ada foto terupload
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto.</div>
                </div>

                <hr>

                
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="id_kategori" class="form-select" required>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id_kategori }}" {{ $aspirasi->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                                {{ $k->ket_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" value="{{ $aspirasi->lokasi }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="ket" class="form-control" rows="4" required>{{ $aspirasi->ket }}</textarea>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                    <a href="{{ route('siswa.dashboard') }}" class="btn btn-light">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>