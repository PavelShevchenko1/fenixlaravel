@extends('layouts.master')
@section('title')
@lang('translation.Colored_Sidebar')
@endsection
@section('body')

<body data-sidebar="colored">
    @endsection
    @section('content')
    @component('common-components.breadcrumb')
    @slot('pagetitle') Vertical @endslot
    @slot('title') Colored Sidebar @endslot
    @endcomponent

   

    @endsection
    @section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
    @endsection
