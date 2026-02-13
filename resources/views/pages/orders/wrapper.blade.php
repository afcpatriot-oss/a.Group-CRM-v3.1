@extends('layout.wrapper')

@section('content')

<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        @include('misc.heading-crumbs')
        <!--Page Title & Bread Crumbs -->

        <!-- action buttons -->
        @include('pages.components.list-page-actions')
        <!-- action buttons -->

    </div>
    <!--page heading-->

    <!--stats panel-->
    @if(auth()->user()->is_team)
    <div id="orders-stats-wrapper" class="stats-wrapper">
        @include('pages.orders.components.misc.list-pages-stats')
    </div>
    @endif
    <!--stats panel-->

    <!-- page content -->
    <div class="row">
        <div class="col-12">
            <!--orders table-->
            @include('pages.orders.components.table.wrapper')
            <!--orders table-->
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
@include('pages.task.modal')

@endsection
