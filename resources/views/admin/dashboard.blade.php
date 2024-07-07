@extends('admin.layouts.app')
@section('content')
	<div class="content-wrapper">
        <section class="content pt-3">
            <div class="container-fluid">
                <!--**********************************************COUNTER**********************************************-->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <a href="{{url('admin/users')}}" class="small-box-footer">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$total_user}}</h3>
                                    <p>Total Users</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-6">
                        <a href="{{url('admin/qr_code')}}" class="small-box-footer">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{$total_qr_code}}</h3>
                                    <p>Total QR Code</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-qrcode"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
