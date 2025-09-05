@extends('layouts.master')

@section('title', 'Upah Karyawan')


@section('content')
    <!-- Content -->
    <div class="w-full lg:ps-64">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <!-- Grid -->



            @livewire('components.work.table')
        </div>
    </div>
    <!-- End Content -->

@endsection
