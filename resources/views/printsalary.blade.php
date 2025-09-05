<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Putra Makarti</title>
    <style>
        @page {
            size: 210mm 297mm;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            width: 210mm 297mm;
            margin: 0;
            padding: 2mm;
            font-size: 10px;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 3mm;
        }

        .shop-name {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 1mm;
        }

        .shop-address {
            font-size: 11px;
            margin-bottom: 2mm;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 3mm 0;
        }

        .transaction-info {
            margin-bottom: 3mm;
        }

        .info-row {
            display: flex;
            font-size: 11px;
            justify-content: space-between;
            margin-bottom: 1mm;
        }

        .items-table {
            width: 100%;
            font-size: 12px;
            border-collapse: collapse;
            margin-bottom: 3mm;
        }

        .items-table th {
            text-align: left;
            border-bottom: 1px dashed #000;
            padding-bottom: 1mm;
        }

        .items-table td {
            padding: 1mm 0;
        }

        .items-table .align-right {
            text-align: right;
        }

        .total-section {
            border-top: 1px dashed #000;
            padding-top: 2mm;
            margin-bottom: 3mm;
        }

        .total-row {
            font-size: 14px;
            display: flex;
            justify-content: space-between;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            margin-top: 5mm;
        }

        ` @media print {
            .no-print {
                display: none;
            }

            body {
                padding: 1mm;
            }
        }

        .print-btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 10px 0;
            cursor: pointer;
            border-radius: 3px;
        }
    </style>
</head>

<body>

    {{-- TOMBOL Untuk print manual --}}
    {{-- <div class="no-print">
        <button class="print-btn" onclick="window.print()">
            Cetak Struck
        </button>
    </div> --}}
    {{-- END: TOMBOL Untuk print manual --}}
    <div class="header">
        <div class="shop-name">{{ $toko->name }}</div>
        <div class="shop-address">{{ $toko->address }}</div>
        <div class="shop-address">Telp: {{ $toko->phone_number }}</div>
    </div>
    {{-- <div class="divider"></div> --}}

    <div class="header">
        <div class="shop-address">DAFTAR UPAH KARYAWAN</div>
    </div>
    <div class="transaction-info">
        <div class="info-row">
            <span>Dari Tanggal:</span>
            <span>{{ \Illuminate\Support\Carbon::parse($start_date)->locale('id')->translatedFormat('d F Y') }}</span>
        </div>
        <div class="info-row">
            <span>Sampai Tanggal</span>
            <span>{{ \Illuminate\Support\Carbon::parse($end_date)->locale('id')->translatedFormat('d F Y') }}</span>
        </div>
        {{-- <div class="info-row">
            <span>No. HP:</span>
            <span>{{ $order->customer->phone_number }}</span>
        </div>
        <div class="info-row">
            <span>Order No: # {{ $order->id }}</span>
            <span>{{ $order->note }}</span>
        </div> --}}
    </div>

    {{-- <div class="divider"></div> --}}
    <table class="items-table">
        <thead>
            <tr>
                <th>Tanggal Pickup</th>
                <th>Customer</th>
                <th class="align-right">Lebar</th>
                <th class="align-right">Panjang</th>
                <th class="align-right">Qty</th>
                <th class="align-right">Qty Final</th>
                <th class="align-right">Subtotal</th>
                @foreach ($employees as $emp)
                    <th class="align-right">{{ $emp }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    <td>{{ $row->pickup_date }}</td>
                    <td>{{ $row->customer }}</td>
                    <td>{{ number_format($row->width, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->length, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->qty, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->qty_final, 0, ',', '.') }}</td>
                    <td class="align-right">{{ number_format($row->subtotal, 0, ',', '.') }}</td>
                    @foreach ($employees as $emp)
                        <td class="align-right">{{ number_format($row->$emp, 0, ',', '.') ?? 0 }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="total-section">
        <div class="total-row">
            <span>Total:</span>
            <span>{{ number_format($total_order, 0, ',', '.') }}</span>
        </div>
        <div class="total-row">
            <span>Pembayaran:</span>
            <span>{{ number_format($order->paid_sum, 0, ',', '.') }}</span>
        </div>
        @if ($kembali > 0)
            <div class="total-row">
                <span>Kembali:</span>
                <span>{{ number_format($kembali, 0, ',', '.') }}</span>
            </div>
        @endif
        @if ($outstanding > 0)
            <div class="total-row">
                <span>Sisa Hutang:</span>
                <span>{{ number_format($outstanding, 0, ',', '.') }}</span>
            </div>
        @endif
    </div> --}}

    <div class="divider"></div>

    <div class="footer">
        <div>{{ $toko->note }}</div>
        <div><b>{{ $toko->slogan }}</b></div>
    </div>

    <script>
        // Fungsi untuk mencetak otomatis saat halaman dimuat
        window.onload = function() {
            // Untuk demo, kita tidak mencetak otomatis
            window.print(); //bagian ini bisa dinonaktifkan, agar tidak langsung print.
        };

        // close window after print
        window.onafterprint = function() {
            // redirect ke halaman sebelumnya
            window.location.href = "{{ url()->previous() }}";
        }
    </script>
</body>

</html>
