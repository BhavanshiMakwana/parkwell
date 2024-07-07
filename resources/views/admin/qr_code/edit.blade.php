@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper" style="min-height: 946px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$menu}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/qr_code')}}">{{$menu}}</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit {{$menu}}</h3>
                        </div>
                        {!! Form::model($qr_code,['url' => url('admin/qr_code/'.$qr_code->id),'method'=>'patch' ,'class' => 'form-horizontal','files'=>true]) !!}
                        <div class="card-body">
                            @include ('admin.qr_code.form')
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('admin/qr_code') }}" ><button class="btn btn-default" type="button">Back</button></a>
                            <button class="btn btn-info pull-right" type="submit">Update</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

