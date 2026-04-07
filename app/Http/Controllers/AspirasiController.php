<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        // Cek apakah siswa login
        if (!Auth::guard('siswa')->check()) {
            return redirect()->route('login');
        }

        $aspirasis = Aspirasi::where('nis', Auth::guard('siswa')->user()->nis)
                    ->with('kategori')
                    ->latest()
                    ->get();

        return view('aspirasi_input', compact('kategoris', 'aspirasis'));
    }

    public function store(Request $request) {
    $request->validate([
        'nis' => 'required',
        'id_kategori' => 'required',
        'lokasi' => 'required',
        'ket' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('public/storage/'), $nama_file);
        $data['foto'] = $nama_file;
    }

    Aspirasi::create($data);

    return back()->with('success', 'Aspirasi berhasil dikirim!');
}

    public function edit($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        $kategoris = Kategori::all();

        if ($aspirasi->status !== 'Menunggu') {
            return redirect()->route('siswa.dashboard')->with('error', 'Data sudah diproses!');
        }

        return view('aspirasi_edit', compact('aspirasi', 'kategoris'));
    }

    public function updateData(Request $request, $id)
    {
        $request->validate([
            'id_kategori' => 'required',
            'lokasi' => 'required',
            'ket' => 'required',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        
        if ($aspirasi->status !== 'Menunggu') {
            return redirect()->route('siswa.dashboard')->with('error', 'Gagal update!');
        }

        $aspirasi->update($request->only(['id_kategori', 'lokasi', 'ket']));

        return redirect()->route('siswa.dashboard')->with('success', 'Aspirasi diperbarui!');
    }

    public function destroy($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);

        if ($aspirasi->status !== 'Menunggu') {
            return back()->with('error', 'Tidak bisa menghapus data!');
        }

        $aspirasi->delete();
        return back()->with('success', 'Aspirasi dihapus!');
    }

    // Bagian Admin
    public function adminIndex(Request $request) {
    $query = Aspirasi::with(['kategori', 'siswa']);

    // Filter per Tanggal
    if ($request->filled('tanggal')) {
        $query->whereDate('created_at', $request->tanggal);
    }

    // Filter per Bulan
    if ($request->filled('bulan')) {
        $query->whereMonth('created_at', date('m', strtotime($request->bulan)))
              ->whereYear('created_at', date('Y', strtotime($request->bulan)));
    }

    // Filter per Siswa (NIS)
    if ($request->filled('nis')) {
        $query->where('nis', $request->nis);
    }

    // Filter per Kategori
    if ($request->filled('id_kategori')) {
        $query->where('id_kategori', $request->id_kategori);
    }

    $aspirasis = $query->latest()->get();
    $kategoris = Kategori::all(); // Untuk pilihan di dropdown filter

    return view('admin.dashboard', compact('aspirasis', 'kategoris'));
}


    public function updateStatus(Request $request, $id) {
    $aspirasi = Aspirasi::findOrFail($id);
    
    $aspirasi->update([
        'status' => $request->status, 
        'feedback' => $request->feedback,
        
        'tgl_feedback' => now()->format('Y-m-d') 
    ]);
    
    return back()->with('success', 'Status dan Tanggapan berhasil diperbarui!');
    } 


    
}