@extends('layout.wrapper')

@section('content')

<!-- main content -->
<div class="container-fluid" id="wrapper-orders">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        @include('misc.heading-crumbs')
        <!--Page Title & Bread Crumbs -->

    </div>
    <!--page heading-->

    <!-- page content -->
    <div class="row">
        <div class="col-12" id="orders-table-wrapper">
            <!--orders compose-->
            @include('pages.orders.components.create.compose')
            <!--orders compose-->
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->

@endsection
