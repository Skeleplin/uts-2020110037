@extends('layouts.app')
@if(session('success'))
<div class="alert alert-success" id="successAlert">
    {{ session('success') }}
</div>
@endif

@if(session('danger'))
<div class="alert alert-danger" id="dangerAlert">
    {{ session('danger') }}
</div>
@endif

@section('content')
<div class="container">
    <div class="card alert alert-secondary">
        <div class="card-body">
            <h1 class="card-title"><i class="fas fa-list"></i> Daftar Transaksi</h1>
            <hr style="border: 2px solid black;">
            <p class="card-text">
                <i class="fas fa-wallet"></i> Saldo Saat Ini: Rp {{ number_format($balance, 0, ',', '.') }}
            </p>
            <p class="card-text">
                <i class="fas fa-arrow-up"></i> Total Pemasukan: Rp {{ number_format($totalIncome, 0, ',', '.') }}
            </p>
            <p class="card-text">
                <i class="fas fa-arrow-down"></i> Total Pengeluaran: Rp {{ number_format($totalExpense, 0, ',', '.') }}
            </p>
            <p class="card-text">
                <i class="fas fa-plus"></i> Jumlah Transaksi Pemasukan: {{ $totalIncomeCount }}
            </p>
            <p class="card-text">
                <i class="fas fa-minus"></i> Jumlah Transaksi Pengeluaran: {{ $totalExpenseCount }}
            </p>
        </div>
    </div>
    <a href="{{ route('transactions.create') }}" class="btn btn-success mt-3 mb-3"><i class="fas fa-plus"></i> Tambah Transaksi Baru</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID</th>
                        <th>Jumlah</th>
                        <th>Tipe</th>
                        <th>Kategori</th>
                        <th>Catatan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $nomor }}</td>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ 'Rp ' . number_format($transaction->amount, 0, ',', '.') }}</td>
                        <td>{{ $transaction->type }}</td>
                        <td>{{ $transaction->category }}</td>
                        <td>{{ $transaction->notes }}</td>
                        <td>{{ $transaction->created_at }}</td>
                        <td>
                            <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info"><i class="fas fa-eye"></i> Lihat</a>&nbsp;&nbsp;
                            <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>&nbsp;
                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display: inline;">&nbsp;
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @php
                    $nomor++; // Tambahkan nilai penghitung
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    setTimeout(function() {
        var successAlert = document.getElementById('successAlert');
        var dangerAlert = document.getElementById('dangerAlert');

        if (successAlert) {
            successAlert.style.display = 'none';
        }

        if (dangerAlert) {
            dangerAlert.style.display = 'none';
        }
    }, 3000);
</script>
@endsection