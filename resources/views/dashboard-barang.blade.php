<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Data Barang - TC-05 & TC-06</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Dashboard - Data Peminjaman Barang</h4>
                        <a href="{{ url('/barang/create') }}" class="btn btn-primary btn-sm">+ Tambah Barang</a>
                    </div>
                    <div class="card-body">
                        
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <!-- TC-06: Tabel responsif untuk scroll horizontal di ukuran kecil (misal 375px) -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle text-nowrap">
                                <thead class="table-primary">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Status (TC-05)</th>
                                        <th>Tanggal Ditambahkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($barangs as $index => $barang)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $barang->kode_barang }}</td>
                                            <td>{{ $barang->nama_barang }}</td>
                                            <td class="text-center">{{ $barang->jumlah }}</td>
                                            
                                            <!-- TC-05: Pewarnaan Status Dinamis (Merah jika Dipinjam) -->
                                            <td class="text-center">
                                                @if($barang->status == 'Dipinjam')
                                                    <span class="badge bg-danger">Dipinjam</span>
                                                @else
                                                    <span class="badge bg-success">Tersedia</span>
                                                @endif
                                            </td>

                                            <td>{{ $barang->created_at }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">Belum ada data barang.</td>
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
</body>
</html>