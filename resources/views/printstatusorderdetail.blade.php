<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Putra Makarti</title>
    <style>
        @page {
            size: {{ $toko->printer_width }}mm auto;
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

    {{-- END: TOMBOL Untuk print manual --}}
    <div class="header">
        <div class="shop-name">PEKERJAAN SELESAI</div>
        <div class="shop-address">
            Tgl:
            {{ \Illuminate\Support\Carbon::parse($orderdetail->updated_at)->locale('id')->translatedFormat('d F Y') }}
            Pukul:
            {{ \Illuminate\Support\Carbon::parse($orderdetail->updated_at)->locale('id')->translatedFormat('H:i') }}

        </div>
    </div>
    <div class="divider"></div>

    <div class="transaction-info">
        <div class="info-row">
            <span>{{ $orderdetail->order->customer->name }}</span>
            <span>{{ $orderdetail->order->customer->phone_number }}</span>
        </div>
        <div class="info-row">
            <span>{{ $orderdetail->order->note }}</span>
        </div>
    </div>

    <div class="divider"></div>
    <table class="items-table">
        {{-- <thead>
            <tr>
                <th>Item</th>
                <th class="align-right">Status</th>
            </tr>
        </thead> --}}
        <tbody>
            {{-- @foreach ($orderdetail as $pd) --}}
            <tr>
                <td>
                    {{ $orderdetail->description }} <br>
                    qty: {{ number_format($orderdetail->qty, 1, ',', '.') }}
                    {{-- @if (optional($pd->orderdetail)->length && optional($pd->orderdetail)->width) --}}
                    @if ($orderdetail->length != 0 && $orderdetail->width != 0)
                        > ({{ number_format($orderdetail->length, 1, ',', '.') }} x
                        {{ number_format($orderdetail->width, 1, ',', '.') }})
                    @endif
                    {{-- @endif --}}

                </td>
                <td class="align-right">
                    @if (!$orderdetail->service->is_package)
                        @if ($orderdetail->qty_asli != $orderdetail->qty_final)
                            {{ number_format($orderdetail->qty_final * $orderdetail->price, 1, ',', '.') }}
                        @else
                            {{ number_format(
                                $orderdetail->length * $orderdetail->width * $orderdetail->qty * $orderdetail->price,
                                1,
                                ',',
                                '.',
                            ) }}
                        @endif
                    @else
                        @if ($orderdetail->qty_asli != $orderdetail->qty_final)
                            {{ number_format($orderdetail->qty_final * $orderdetail->price, 1, ',', '.') }}
                        @else
                            {{ number_format($orderdetail->qty * $orderdetail->price, 1, ',', '.') }}
                        @endif
                    @endif
                </td>
            </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>
    <div class="divider"></div>
    @if ($order->orderdetail->count() > 1)
        <div class="transaction-info -mb-4">
            <div class="info-row ">
                <span class="font-bold">STATUS PESANAN DALAM 1 ORDER:</span>
            </div>
        </div>
        <table class="items-table -mt-2 pt-0">
            <thead class="p-0">
                <tr>
                    <th>Item</th>
                    <th class="align-right">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderdetail as $od)
                    @if ($od->id != $orderdetail->id)
                        <tr>
                            <td>
                                {{ $od->description }} <br>
                                qty: {{ number_format($od->qty, 1, ',', '.') }}
                                {{-- @if (optional($od->orderdetail)->length && optional($od->orderdetail)->width) --}}
                                @if ($od->length != 0 && $od->width != 0)
                                    > ({{ number_format($od->length, 1, ',', '.') }} x
                                    {{ number_format($od->width, 1, ',', '.') }})
                                @endif
                                {{-- @endif --}}

                            </td>
                            <td class="align-right">
                                @if ($od->process_status == 'done')
                                    SELESAI
                                @elseif ($od->process_status == 'process')
                                    PROSES
                                @else
                                    BELUM DIPROSES
                                @endif
                                <br>
                                @if (!$od->service->is_package)
                                    @if ($od->qty_asli != $od->qty_final)
                                        {{ number_format($od->qty_final * $od->price, 1, ',', '.') }}
                                    @else
                                        {{ number_format($od->length * $od->width * $od->qty * $od->price, 1, ',', '.') }}
                                    @endif
                                @else
                                    @if ($od->qty_asli != $od->qty_final)
                                        {{ number_format($od->qty_final * $od->price, 1, ',', '.') }}
                                    @else
                                        {{ number_format($od->qty * $od->price, 1, ',', '.') }}
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="divider"></div>
    @endif
    <div class="info-row">
        <span>PEMBAYARAN:</span>
    </div>
    @if ($payment->count() > 0)
        <table class="items-table">

            @foreach ($payment as $pm)
                <td>
                    {{ \Illuminate\Support\Carbon::parse($pm->created_at)->locale('id')->translatedFormat('d F Y') }}
                </td>
                <td>
                    {{ $pm->payment_method }}
                </td>
                <td class="align-right">
                    {{ number_format($pm->amount, 1, ',', '.') }}
                </td>
                </tbody>
            @endforeach
        </table>
    @else
        <div class="info-row">
            <span>Belum ada pembayaran</span>
        </div>
    @endif

    {{-- <div class="total-section">
        <div class="total-row">
            <span>Total:</span>
            <span>{{ number_format($total_order, 2, ',', '.') }}</span>
        </div>
        <div class="total-row">
            <span>Pembayaran:</span>
            <span>{{ number_format($order->paid_sum, 2, ',', '.') }}</span>
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
    </div> --}}


    {{--
    <div class="footer">
        <div>{{ $toko->note }}</div>
        <div><b>{{ $toko->slogan }}</b></div>
    </div> --}}

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
