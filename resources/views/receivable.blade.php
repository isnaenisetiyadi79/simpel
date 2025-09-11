@extends('layouts.master')

@section('title', 'Hutang Piutang')


@section('content')
    <!-- Content -->
    <div class="w-full lg:ps-64">
        <div class="p-4 space-y-4 sm:p-6 sm:space-y-6">



            @livewire('components.order.widget')
            {{-- @livewire('components.salary.widget') --}}
            @livewire('components.receivable.table')
        </div>
    </div>
    <!-- End Content -->


@endsection
