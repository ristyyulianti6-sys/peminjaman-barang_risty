<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/barang/create');
});

// Halaman form tambah barang
Route::get('/barang/create', function () {
    return view('tambah-barang');
});

// Proses simpan data dengan validasi lengkap (TC-02, TC-03, TC-04)
Route::post('/barang', function (Request $request) {
    $request->validate([
        'kode_barang' => 'required|unique:barangs,kode_barang',
        'nama_barang' => 'required',
        'jumlah'      => 'required|numeric|min:0',
        'status'      => 'required',
    ], [
        'kode_barang.required' => 'Kode barang wajib diisi.',
        'kode_barang.unique'   => 'Kode barang sudah terdaftar (Duplikat).',
        'nama_barang.required' => 'Nama barang wajib diisi.',
        'jumlah.required'      => 'Jumlah stok wajib diisi.',
        'jumlah.numeric'       => 'Jumlah harus berupa angka.',
        'jumlah.min'           => 'Stok tidak boleh negatif (minimal 0).',
        'status.required'      => 'Status barang wajib dipilih.',
    ]);

    // Simpan ke database MySQL
    \DB::table('barangs')->insert([
        'kode_barang' => $request->kode_barang,
        'nama_barang' => $request->nama_barang,
        'jumlah'      => $request->jumlah,
        'status'      => $request->status,
        'created_at'  => now(),
        'updated_at'  => now(),
    ]);

    return redirect()->route('barang.index')->with('success', 'Data berhasil disimpan dan divalidasi!');
})->name('barang.store');

// Halaman Dashboard
Route::get('/barang', function () {
    $barangs = \DB::table('barangs')->get();
    return view('dashboard-barang', compact('barangs'));
})->name('barang.index');