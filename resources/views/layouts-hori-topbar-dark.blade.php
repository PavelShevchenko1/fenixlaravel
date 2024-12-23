@extends('layouts.master-layouts')
@section('title')
@lang('translation.Dark_Topbar')
@endsection
@section('body')

<body data-layout="horizontal" data-topbar="dark">
    @endsection
    @section('content')
    @component('common-components.breadcrumb')
    @slot('pagetitle') Horizontal @endslot
    @slot('title') Dark Topbar @endslot
    @endcomponent

    

    @endsection
    @section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
    @endsection
