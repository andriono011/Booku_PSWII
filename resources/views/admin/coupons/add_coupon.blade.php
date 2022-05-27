@extends('admin.layout')
@section('title', 'Add Coupon')
@section('content')

<!-- Content Wrapper, Contains page content -->
<div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">

<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
        </div>
        <div class="header-title">
            <h1>Add Coupon</h1>
    
</section>
            @if(Session::has('flash_message_success'))
            <div class="alert alert-sm alert-success alert-block" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{!! session('flash_message_success') !!}</strong>
        </div>
        @endif
        <!-- Main Content -->
        <section class="content">
            <div class="row">
                <!-- Form Controls -->
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonlist">
                                <a class="btn btn-add" href="{{ url('admin/view_coupons')}}">
                                    <i class="fa fa-eye"></i> View Coupons </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form class="col-sm-6" enctype="multipart/form-data" action="{{url('/admin/add_coupon')}}" method="post" name="add_coupon" id="add_coupon">{{ csrf_field() }} 
                            <div class="form-group">
                            <label>Coupon Code</label>
                                <input type="text" class="form-control" placeholder="Enter Coupon Code" name="coupon_code" id="coupon_code" required>
                            </div>
                            <div class="form-group">
                                <label>Amount </label>
                                <input type="text" class="form-control" placeholder="Enter Amount" name="coupon_amount" id="coupon_amount" required>
                            </div>
                            <div class="form-group">
                                <label>Coupon Type</label>
                                <select name="amount_type" id="amount_type" class="form-control">
                                    <option value="Percentage">Percentage</option>
                                    <option value="Fixed">Fixed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> Expiry Date</label>
                                <input type="text" class="form-control" name="expiry_date" id="datepicker" required>
                            </div>
                            <div class="reset-button">
                                <a class="btn btn-add" href="{{ url('/admin/add_coupon') }}">
                                <input type="submit" class="btn btn-success" value="Add Coupon"></a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
        </div>
</div>
@endsection