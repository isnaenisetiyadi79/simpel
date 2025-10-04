@extends('layouts.master')

@section('title', 'Rubah Password')


@section('content')
    <!-- Content -->
    <div class="w-full lg:ps-64">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">



            {{-- @livewire('components.pickup.widget') --}}
            {{-- @livewire('components.salary.widget') --}}
            @livewire('components.user.RubahPassword')
        </div>
    </div>
    <!-- End Content -->


@endsection
