<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Putra Makarti</title>
    <style>
        @page {
            size: {{ $toko->printer_width }}80mm auto;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            width: {{ $toko->printer_width }}mm;
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
            font-size: 12px;
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
    <div class="divider"></div>

    <div class="transaction-info">
        <div class="info-row">
            <span>Tanggal:</span>
            {{-- <span>{{ date('d-F-Y H:i', strtotime($order->created_at)) }}</span> --}}
            <span>{{ \Illuminate\Support\Carbon::parse($pickup->created_at)->locale('id')->translatedFormat('d F Y H:i') }}</span>
        </div>
        <div class="info-row">
            <span>Pelanggan:</span>
            <span>{{ $pickup->customer->name }}</span>
        </div>
        <div class="info-row">
            <span>No. HP:</span>
            <span>{{ $pickup->customer->phone_number }}</span>
        </div>
        <div class="info-row">
            <span>Pickup No: # {{ $pickup->id }}</span>
            <span>{{ $pickup->note }}</span>
        </div>
    </div>

    <div class="divider"></div>
    <table class="items-table">
        <thead>
            <tr>
                <th>Item</th>
                <th class="align-right">Qty</th>
                <th class="align-right">Harga</th>
                <th class="align-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pickup->pickupdetail as $pd)
                <tr>
                    <td>
                        {{ $pd->orderdetail->description }} <br>
                        qty: {{ number_format($pd->orderdetail->qty, 1, ',', '.') }}
                        @if (optional($pd->orderdetail)->length && optional($pd->orderdetail)->width)
                            @if ($pd->orderdetail->length != 0 && $pd->orderdetail->width != 0)
                                > ({{ number_format($pd->orderdetail->length, 1, ',', '.') }} x
                                {{ number_format($pd->orderdetail->width, 1, ',', '.') }})
                            @endif
                        @endif

                    </td>
                    <td class="align-right">{{ number_format($pd->orderdetail->qty_final, 1, ',', '.') }}
                        {{ $pd->orderdetail->service->unit }}</td>
                    <td class="align-right">{{ number_format($pd->orderdetail->price, 0, ',', '.') }}</td>
                    <td class="align-right">{{ number_format($pd->orderdetail->subtotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-row">
            <span>Total:</span>
            <span>{{ number_format($total_order, 2, ',', '.') }}</span>
        </div>
        <div class="total-row">
            <span>Pembayaran:</span>
            <span>{{ number_format($paid_sum, 2, ',', '.') }}</span>
        </div>
        @if ($kembali > 0)
            <div class="total-row">
                <span>Kembali:</span>
                <span>{{ number_format($kembali, 2, ',', '.') }}</span>
            </div>
        @endif
        @if ($outstanding > 0)
            <div class="total-row">
                <span>Sisa Hutang:</span>
                <span>{{ number_format($outstanding, 2, ',', '.') }}</span>
            </div>
        @endif
    </div>
    <div class="transaction-info">
        {{-- @if ($order_payments) --}}

        @if ($paid_sum > 0)
            <div class="info-row">
                <span>RINCIAN PEMBAYARAN</span>
            </div>
        @endif
        @foreach ($order_payments as $od)
            @foreach ($od->payment as $pym)
                <div class="info-row">
                    <span>
                        {{-- {{ $loop->iteration }}. --}}
                        {{ date('d F Y', strtotime($pym->created_at)) }}</span>
                    <span>{{ number_format($pym->amount, 2, ',', '.') }}</span>
                </div>
            @endforeach
        @endforeach
        {{-- @endif --}}
        @foreach ($pickup_payments as $pd)
            {{-- <div class="info-row">
            <span>Pembayaran</span>
        </div> --}}
            @foreach ($pd->payment as $pym)
                <div class="info-row">
                    <span>
                        {{-- {{ $loop->iteration }}. --}}
                        {{ date('d F Y', strtotime($pym->created_at)) }}</span>
                    <span>{{ number_format($pym->amount, 2, ',', '.') }}</span>
                </div>
            @endforeach
        @endforeach
    </div>
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
