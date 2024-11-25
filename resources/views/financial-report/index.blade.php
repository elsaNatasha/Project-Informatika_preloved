@extends('layout')

@section('content')
<main class="content">
    <header>Laporan Keuangan</header>

    <div class="filter-container">
        <label for="filter">Tampilkan laporan:</label>
        <select id="filter" onchange="filterTransactions()">
            <option value="bulanan" {{ $filter == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
            <option value="mingguan" {{ $filter == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
        </select>
        <label for="month" class="month-label" id="month-label" style="display: none;">Bulan:</label>
        <select id="month" class="month-select" onchange="filterTransactions()">
            @foreach(range(1, 12) as $month)
                <option value="{{ $month }}" {{ $month == $this->month ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="summary-container">
        <div class="summary-box" id="total-pemasukan">
            <div>Total Pemasukan</div>
            <div class="value">Rp{{ number_format($totalRevenue, 2, ',', '.') }}</div>
        </div>
        <div class="summary-box" id="barang-terjual">
            <div>Barang Terjual</div>
            <div class="value">{{ $itemsSold }} Barang</div>
        </div>
        <div class="summary-box" id="barang-dibatalkan">
            <div>Barang Dibatalkan</div>
            <div class="value">{{ $itemsCancelled }} Barang</div>
        </div>
    </div>ss

    <div class="transaction-list">
        @foreach ($transactions as $transaction)
            <div class="transaction-group">
                <div class="transaction-date">{{ $transaction->created_at->format('d F Y') }}</div>
                <div class="transaction-item">
                    <div class="transaction-name">{{ $transaction->product->name }}</div>
                    <div class="transaction-amount">
                        @if($transaction->status == 'terjual')
                            + Rp{{ number_format($transaction->amount, 2, ',', '.') }}
                        @else
                            - Rp{{ number_format($transaction->amount, 2, ',', '.') }} (Dibatalkan)
                        @endif
                    </div>
                    <div class="transaction-time">{{ $transaction->created_at->format('H:i:s') }} WIB</div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="footer-summary">
        Total Pemasukan: Rp{{ number_format($totalRevenue, 2, ',', '.') }}
    </div>
</main>
<script>
    function filterTransactions() {
        const filterValue = document.getElementById('filter').value;
        const monthValue = document.getElementById('month').value;
        window.location.href = `{{ url('laporan-keuangan') }}?filter=${filterValue}&month=${monthValue}`;
    }
</script>
@endsection
