@extends('layouts.master')
@section('title')
    @lang('translation.Preloader')
@endsection
@section('body')

    <body>
        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <i class="uil-shutter-alt spin-icon"></i>
                </div>
            </div>
        </div>
    @endsection
    @section('content')
        @component('common-components.breadcrumb')
            @slot('pagetitle')
                Vertical
            @endslot
            @slot('title')
                Preloader
            @endslot
        @endcomponent

        
    @endsection
    @section('script')
        <!-- apexcharts -->
        <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
    @endsection
