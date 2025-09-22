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
      <div wire:click="setProcessStatus('pending')"
          class="flex flex-col border-l-2 border-orange-500 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700 cursor-pointer hover:shadow-md hover:bg-orange-100 active:bg-orange-300 {{ $processStatus == 'pending' ? 'bg-orange-200' : 'bg-gray-100' }}">
          <div class="p-4 md:p-5">

              <div class="flex items-center gap-x-2">
                  <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                      Belum dikerjakan
                  </p>
                  <div class="hs-tooltip" {{ $processStatus != 'pending' ? 'hidden' : '' }}>
                      <div class="hs-tooltip-toggle">
                         <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none"><path fill="#ffef5e" d="M10.814 2.074a1.52 1.52 0 0 1 2.372 0l1.41 1.755a1.52 1.52 0 0 0 1.35.558l2.237-.243a1.52 1.52 0 0 1 1.674 1.676l-.244 2.236a1.52 1.52 0 0 0 .56 1.35l1.753 1.409a1.52 1.52 0 0 1 0 2.372l-1.754 1.41a1.52 1.52 0 0 0-.56 1.349l.245 2.237a1.522 1.522 0 0 1-1.676 1.675l-2.237-.243a1.52 1.52 0 0 0-1.35.559l-1.408 1.752a1.518 1.518 0 0 1-2.372 0l-1.408-1.754a1.52 1.52 0 0 0-1.35-.56l-2.237.244a1.52 1.52 0 0 1-1.675-1.675l.243-2.237a1.52 1.52 0 0 0-.559-1.349l-1.754-1.408a1.52 1.52 0 0 1 0-2.372l1.754-1.409a1.52 1.52 0 0 0 .56-1.35L4.143 5.82a1.52 1.52 0 0 1 1.675-1.676l2.237.243a1.52 1.52 0 0 0 1.35-.558z"/><path fill="#fff9bf" d="M4.58 19.42a1.52 1.52 0 0 1-.436-1.239l.243-2.237a1.52 1.52 0 0 0-.559-1.349l-1.754-1.408a1.52 1.52 0 0 1 0-2.372l1.754-1.409a1.52 1.52 0 0 0 .56-1.35L4.143 5.82a1.52 1.52 0 0 1 1.675-1.676l2.237.243a1.52 1.52 0 0 0 1.35-.558l1.408-1.755a1.52 1.52 0 0 1 2.372 0l1.41 1.755a1.52 1.52 0 0 0 1.35.558l2.237-.243a1.52 1.52 0 0 1 1.24.437z"/><path stroke="#191919" stroke-linecap="round" stroke-linejoin="round" d="M10.814 2.074a1.52 1.52 0 0 1 2.372 0l1.41 1.755a1.52 1.52 0 0 0 1.35.558l2.237-.243a1.52 1.52 0 0 1 1.674 1.676l-.244 2.236a1.52 1.52 0 0 0 .56 1.35l1.753 1.409a1.52 1.52 0 0 1 0 2.372l-1.754 1.41a1.52 1.52 0 0 0-.56 1.349l.245 2.237a1.522 1.522 0 0 1-1.676 1.675l-2.237-.243a1.52 1.52 0 0 0-1.35.559l-1.408 1.752a1.518 1.518 0 0 1-2.372 0l-1.408-1.754a1.52 1.52 0 0 0-1.35-.56l-2.237.244a1.52 1.52 0 0 1-1.675-1.675l.243-2.237a1.52 1.52 0 0 0-.559-1.349l-1.754-1.408a1.52 1.52 0 0 1 0-2.372l1.754-1.409a1.52 1.52 0 0 0 .56-1.35L4.143 5.82a1.52 1.52 0 0 1 1.675-1.676l2.237.243a1.52 1.52 0 0 0 1.35-.558z" stroke-width="1"/><path stroke="#191919" stroke-linecap="round" stroke-linejoin="round" d="m15.65 9.72l-3.714 4.95a.7.7 0 0 1-1.054.077l-2.228-2.23" stroke-width="1"/></g></svg>
                          <span
                              class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-md shadow-2xs dark:bg-neutral-700"
                              role="tooltip">
                              Menampilkan pesanan belum dikerjakan
                          </span>
                      </div>
                  </div>
              </div>
              <div class="flex justify-between mt-1">
                  <div class="flex items-center gap-x-2">
                      <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                          {{ $orderdetail->where('process_status', 'pending')->count() }}
                      </h3>
                  </div>
                  <div class="flex items-center gap-x-2">
                      <h4 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                          {{ $orderdetail_notpickup->where('process_status', 'pending')->count() }}
                      </h4>
                  </div>
              </div>
              <div class="flex justify-between">
                  <div class="text-xs text-gray-500 dark:text-neutral-500">
                      <span>Bulan ini</span>
                  </div>
                  <div class="text-right text-xs text-gray-500 dark:text-neutral-500">
                      <span>Periode Lain</span>
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
                      DiProses
                  </p>
              </div>
              <div class="flex justify-between mt-1">
                  <div class="flex items-center gap-x-2">
                      <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                          {{ $orderdetail->where('process_status', 'process')->count() }}
                      </h3>
                  </div>
                  <div class="flex items-center gap-x-2">
                      <h4 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                          {{ $orderdetail_notpickup->where('process_status', 'process')->count() }}
                      </h4>
                  </div>
              </div>
              <div class="flex justify-between">
                  <div class="text-xs text-gray-500 dark:text-neutral-500">
                      <span>Bulan ini</span>
                  </div>
                  <div class="text-right text-xs text-gray-500 dark:text-neutral-500">
                      <span>Periode Lain</span>
                  </div>
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
              <div class="flex justify-between mt-1">
                  <div class="flex items-center gap-x-2">
                      <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                          {{ $orderdetail->where('process_status', 'done')->count() }}
                      </h3>
                  </div>
                  <div class="flex items-center gap-x-2">
                      <h4 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                          {{ $orderdetail_notpickup->where('process_status', 'done')->count() }}
                      </h4>
                  </div>
              </div>
              <div class="flex justify-between">
                  <div class="text-xs text-gray-500 dark:text-neutral-500">
                      <span>Bulan ini</span>
                  </div>
                  <div class="text-right text-xs text-gray-500 dark:text-neutral-500">
                      <span>Periode Lain</span>
                  </div>
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
                      Rp. {{ number_format($order_payment, 0, ',', '.') }}
                  </h3>
              </div>
          </div>
      </div>
      <!-- End Card -->
  </div>
  <!-- End Grid -->
