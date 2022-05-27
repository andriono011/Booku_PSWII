@extends('admin.layout')
@section('title', 'View Coupon')
@section('content')

<!-- Content View Coupons -->
<div class="content-wrapper">
    <!-- Content Header (Page Header) -->
    <section class="content-header">
    </section>
    @if(Session::has('flash_message_error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ session('flash_message_error') }}</strong>
    </div>
    @endif
    @if(Session::has('flash_message_success'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ session('flash_message_success') }}</strong>
    </div>
    @endif

    <div id="message_success" style="display:none;" class="alert alert-sm alert-success">Status Enabled</div>
    <div id="message_error" style="display:none;" class="alert alert-sm alert-danger">Status Disabled</div>
    <!-- Main Content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel=heading">
                        <div class="btn=group" id="buttonexport">
                            <a href="#">
                                <h4>View Coupons</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="btn=group">
                            <div class="buttonexport" id="buttonlist">
                                <a class="btn btn-primary" href="{{url('/admin/add_coupon')}}"> <i class="mdi mdi-plus"></i> Add Coupons
                            </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table_id" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="infon">
                                    <th>Coupon ID</th>
                                    <th>Coupon Code</th>
                                    <th> Amount</th>
                                    <th>Amount Type</th>
                                    <th>Expiry Date</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->id }}</td>
                                    <td>{{ $coupon->coupon_code }}</td>
                                    <td>
                                        {{ $coupon->amount }}
                                        @if($coupon->amount_type == "Percentage") % @else Rp @endif
                                    </td>
                                    <td>{{ $coupon->amount_type }}</td>
                                    <td>{{ $coupon->expiry_date }}</td>
                                    <td>{{ $coupon->created_at }}</td>
                                    <td>
                                        <input type="checkbox" class="CouponStatus btn btn-success" rel="{{ $coupon->id }}" data-toggle="toggle" 
                                        data-on="Enabled" data-off="Disabled" data-onstyle="success" data-offstyle="danger" 
                                        @if($coupon['status']=="1") checked @endif>
                                        <div id="myElem" style="display:none" class="alert alert-success">Status Enabled</div>
                                    </td>
                                    <td>
                                        <a href="{{ url('/admin/edit-coupon/'.$coupon->id)}}"class="btn btn-warning btn-sm"><i class="mdi mdi-lead-pencil"></i></a>
                                        <a href="{{ url('/admin/view_coupons/')}}" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection