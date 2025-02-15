@extends('layouts.master-vertical')
@section('title')
    @lang('translation.Vertical')
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Minible
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent

    
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
@endsection
