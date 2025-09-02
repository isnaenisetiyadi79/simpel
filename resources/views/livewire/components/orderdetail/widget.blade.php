  <!-- Grid -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-6 gap-4 sm:gap-6">
      <!-- Card -->
      <div
          class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
              <div class="flex items-center gap-x-2">
                  <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                      Total Pesanan Masuk
                  </p>
                  <div class="hs-tooltip">
                      <div class="hs-tooltip-toggle">
                          <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round">
                              <circle cx="12" cy="12" r="10" />
                              <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                              <path d="M12 17h.01" />
                          </svg>
                          <span
                              class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-md shadow-2xs dark:bg-neutral-700"
                              role="tooltip">
                              The number of all transactions
                          </span>
                      </div>
                  </div>
              </div>

              <div class="mt-1 flex items-center gap-x-2">
                  <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                      {{ $orderdetail->count() }}
                  </h3>

              </div>
          </div>
      </div>
      <!-- End Card -->

      <!-- Card -->
      <div
          class="flex flex-col bg-white border-l-2 border-orange-500 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
              <div class="flex items-center gap-x-2">
                  <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                      Belum dikerjakan
                  </p>
              </div>

              <div class="mt-1 flex items-center gap-x-2">
                  <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                      {{ $orderdetail->where('process_status', 'pending')->count() }}
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
                      DiProses
                  </p>
              </div>

              <div class="mt-1 flex items-center gap-x-2">
                  <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                      {{ $orderdetail->where('process_status', 'process')->count() }}
                  </h3>

              </div>
          </div>
      </div>
      <!-- End Card -->

      <!-- Card -->
      <div
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
      </div>
      <!-- End Card -->
      <!-- Card -->
      <div
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
      </div>
      <!-- End Card -->
      <!-- Card -->
      <div
          class="flex flex-col bg-white border-l-2 border-green-700 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
              <div class="flex items-center gap-x-2">
                  <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                      Pembayaran di Depan
                  </p>
              </div>

              <div class="mt-1 flex items-center gap-x-2">
                  <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                      Rp. {{ number_format($order_payment,0,',','.') }}
                  </h3>
              </div>
          </div>
      </div>
      <!-- End Card -->
  </div>
  <!-- End Grid -->
