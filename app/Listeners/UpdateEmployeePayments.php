<?php

namespace App\Listeners;

use App\Events\OrderDetailUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateEmployeePayments
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderDetailUpdated $event): void
    {
        // Ambil objek OrderDetail yang diperbarui dari event
        $orderDetail = $event->orderDetail;

        // Pastikan relasi 'service' sudah di-load agar bisa diakses
        // Ini untuk menghindari N+1 query problem
        $orderDetail->load('service');

        // Load relasi 'pickupDetails' beserta 'pickupDetailEmployeeWorks' dan 'work'
        $pickupDetails = $orderDetail->pickupdetail()
            ->with('pickupDetailEmployeeWorks.work')
            ->get();

        // Iterasi melalui setiap detail pengambilan yang terkait dengan order detail ini
        foreach ($pickupDetails as $pickupDetail) {
            // Iterasi melalui setiap entri penggajian (pivot)
            foreach ($pickupDetail->pickupDetailEmployeeWorks as $pivot) {

                // Langkah 1: Terapkan logika untuk upah 'one_time'
                // Jika pekerjaan adalah one-time (sekali bayar) DAN sudah ditandai sebagai 'is_paid',
                // maka kita tidak perlu memprosesnya lagi.
                if ($pivot->work->one_time && $pivot->is_paid) {
                    continue; // Lewati iterasi ini dan lanjut ke item berikutnya
                }

                // Inisialisasi nilai pembayaran baru
                $newPayDefault = 0;

                // Langkah 2: Terapkan logika perhitungan berdasarkan jenis service
                // Jika service yang terkait dengan order detail BUKAN merupakan paket ('is_package' == false)
                if ($orderDetail->service && !$orderDetail->service->is_package) {
                    // Pay default dihitung berdasarkan kuantitas, dimensi, dan harga order detail.
                    $newPayDefault = $pickupDetail->qty * $orderDetail->length * $orderDetail->width * $orderDetail->price;
                } else {
                    // Jika service adalah paket ('is_package' == true),
                    // Pay default hanya dihitung berdasarkan kuantitas dan harga order detail.
                    $newPayDefault = $pickupDetail->qty * $orderDetail->price;
                }

                // Perbarui nilai 'pay_default' pada tabel pivot
                $pivot->pay_default = $newPayDefault;

                // Langkah 3: Tandai 'is_paid' jika jenis pekerjaan adalah 'one_time'
                // Jika pekerjaan adalah one-time, kita tandai sebagai sudah dibayar setelah perhitungan ini.
                if ($pivot->work->one_time) {
                     $pivot->is_paid = true;
                }

                // Simpan perubahan pada tabel pivot
                $pivot->save();
            }
        }
    }
}
