  <!-- Grid -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-6">


      <!-- Card -->
      <div
          class="flex flex-col bg-white border-l-2 border-orange-500 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
              <div class="flex items-center gap-x-2">
                  <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                      Nilai Transaksi
                  </p>
              </div>

              <div class="mt-1 flex items-center gap-x-2">
                  <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                      Rp. {{ number_format($total, 0, ',', '.') }}
                      {{-- Rp. {{ number_format(optional(optional($pickupdetail->first())->orderdetail)->sum('subtotal'), 0, ',', '.') }} --}}
                  </h3>
              </div>
          </div>
      </div>
      <!-- End Card -->

      <!-- Card -->
      <div
          class="flex flex-col bg-white border-l-2 border-yellow-500 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
              <div class="flex items-center gap-x-2">
                  <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                      Total Pembayaran
                  </p>
              </div>

              <div class="flex justify-between">
                  <div class="mt-1 flex items-center gap-x-2">
                      <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                          Rp. {{ number_format($total_payment, 0, ',', '.') }}
                      </h3>

                  </div>
                  <div class="mt-1 flex flex-col items-end text-xs text-gray-600 dark:text-neutral-300">
                      <span class="text-xs">

                          {{ number_format($order_payment_cash + $pickup_payment_cash, 0, ',', '.') }} (cash)
                      </span>
                      <span class="text-xs">
                          {{ number_format($order_payment_transfer + $pickup_payment_transfer, 0, ',', '.') }}
                          (transfer)
                      </span>
                  </div>
              </div>
          </div>
      </div>
      <!-- End Card -->
      <!-- Card -->
      <div
          class="flex flex-col bg-white border-l-2 border-yellow-500 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
              <div class="flex items-center gap-x-2">
                  <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                      Pembayaran Di Depan (diambil {{ $pickupdetail->count() }})
                  </p>
              </div>

              {{-- <div class="mt-1 flex items-center gap-x-2">
                  <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                      {{ number_format($order_payment, 0, ',', '.') }}
                  </h3>
              </div> --}}
              <div class="flex justify-between">
                  <div class="mt-1 flex items-center gap-x-2">
                      <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                          Rp. {{ number_format($order_payment, 0, ',', '.') }}
                      </h3>

                  </div>
                  <div class="mt-1 flex flex-col items-end text-xs text-gray-600 dark:text-neutral-300">
                      <span class="text-xs">

                          {{ number_format($order_payment_cash, 0, ',', '.') }} (cash)
                      </span>
                      <span class="text-xs">
                          {{ number_format($order_payment_transfer, 0, ',', '.') }} (transfer)
                      </span>
                  </div>
              </div>
          </div>
      </div>
      <!-- End Card -->
      <!-- Card -->
      <div
          class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
              <div class="flex items-center gap-x-2">
                  <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                      Pembayaran di Depan (Belum Diambil)
                  </p>
              </div>


              <div class="flex justify-between">
                  <div class="mt-1 flex items-center gap-x-2">
                      <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                          Rp. {{ number_format(max(0, $order_payment_notpickup - $order_payment), 0, ',', '.') }}
                      </h3>

                  </div>
                  <div class="mt-1 flex flex-col items-end text-xs text-gray-600 dark:text-neutral-300">
                      <span class="text-xs">

                          {{ number_format(max(0, $order_payment_notpickup_cash - $order_payment_cash), 0, ',', '.') }}
                          (cash)
                      </span>
                      <span class="text-xs">
                          {{ number_format(max(0, $order_payment_notpickup_transfer - $order_payment_transfer), 0, ',', '.') }}
                          (transfer)
                      </span>
                  </div>
              </div>
          </div>
      </div>
      <!-- End Card -->
      <!-- Card -->
      <div
          class="flex flex-col bg-white border-l-2 border-yellow-500 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
              <div class="flex items-center gap-x-2">
                  <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                      Pembayaran Pengambilan
                  </p>
              </div>

              {{-- <div class="mt-1 flex items-center gap-x-2">
                  <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                      {{ number_format($pickup_payment, 0, ',', '.') }}
                  </h3>

              </div> --}}
              <div class="flex justify-between">
                  <div class="mt-1 flex items-center gap-x-2">
                      <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                          Rp. {{ number_format($pickup_payment, 0, ',', '.') }}
                      </h3>

                  </div>
                  <div class="mt-1 flex flex-col items-end text-xs text-gray-600 dark:text-neutral-300">
                      <span class="text-xs">

                          {{ number_format($pickup_payment_cash, 0, ',', '.') }} (cash)
                      </span>
                      <span class="text-xs">
                          {{ number_format($pickup_payment_transfer, 0, ',', '.') }} (transfer)
                      </span>
                  </div>
              </div>
          </div>
      </div>
      <!-- End Card -->

      <!-- Card -->
      {{-- <div
          class="flex flex-col bg-white border-l-2 border-green-500 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
              <div class="flex items-center gap-x-2">
                  <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                     Selesai
                  </p>
              </div>

              <div class="mt-1 flex items-center gap-x-2">
                  <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                       {{ $orderdetail->where('process_status', 'done')->count() }}
                  </h3>
              </div>
          </div>
      </div> --}}
      <!-- End Card -->
      <!-- Card -->
      {{-- <div
          class="flex flex-col bg-white border-l-2 border-green-700 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
              <div class="flex items-center gap-x-2">
                  <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                      Sudah diserahkan
                  </p>
              </div>

              <div class="mt-1 flex items-center gap-x-2">
                  <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                       {{ $orderdetail->where('pickup_status', 'completed')->count() }}
                  </h3>
              </div>
          </div>
      </div> --}}
      <!-- End Card -->
  </div>
  <!-- End Grid -->
