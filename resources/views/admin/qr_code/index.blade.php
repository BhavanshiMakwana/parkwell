@extends('admin.layouts.app')
@section('content')
    <style>
        .select2-selection{height: 28px !important; padding: 3px 12px!important;}
        .select2-container--default .select2-selection--single .select2-selection__arrow{top: 2px!important;}
    </style>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$menu}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{$menu}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @include ('admin.error')
            <div id="responce" class="alert alert-success" style="display: none">
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            {!! Form::open(['url' => url('admin/qr_code'), 'method' => 'get', 'id'=>'QRForm', 'class' => 'form-horizontal','files'=>false]) !!}
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-12 mar-bot">
                                            <input  class="form-control" type="text" @if(!empty($search)) value="{{$search}}" @else placeholder="Search" @endif name="search" id="search">
                                        </div>
                                        <div class="col-md-5 col-sm-3 col-xs-12">
                                            <button type="submit" class="btn btn-info mr-1" name="submit" value="Search">Search</button>
                                            <a href="{{url('admin/qr_code')}}"><button type="button" class="btn btn-danger mr-1" name="submit" value="Search">Clear</button></a>
                                            <a href="{{url('admin/qr_code/status')}}"><button type="button" class="btn btn-primary" name="submit" value="Search">Status Wise Filter</button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ url('admin/qr_code') }}" ><button class="btn btn-default pull-right" type="button"><span class="fa fa-refresh"></span></button></a>
                                    <a href="{{ url('admin/qr_code/create') }}"><button class="btn btn-info pull-right" type="button" style="margin-right: 1.5%;">Add QR Code</button></a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="card-body table-responsive">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Edit</th>
                                        <th style="width: 20%;">Code</th>
                                        <th style="width: 20%;">Type</th>
                                        <th style="width: 20%;">Status</th>
                                        <th style="width: 20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($qr_code as $list)
                                    <tr class="ui-state-default" id="arrayorder_{{$list['id']}}">
                                        <td>
                                            <div class="btn-group-horizontal">
                                                {{ Form::open(array('url' => 'admin/qr_code/'.$list['id'].'/edit', 'method' => 'get','style'=>'display:inline')) }}
                                                    <button class="btn btn-info tip" data-toggle="tooltip" title="Edit QR Code" data-trigger="hover" type="submit" ><i class="fa fa-edit"></i></button>
                                                {{ Form::close() }}
                                            </div>
                                        </td>
                                        <td>{{ $list['code'] }}</td>
                                        <td>{{ ucfirst($list['type']) }}</td>
                                        <td>
                                            @if($list['status'] == '0')
                                                <label class="label label-info" style="height:28px; padding:0 12px">Generated</label>
                                            @elseif($list['status'] == '1')
                                                <span class="label label-primary" style="height:28px; padding:4px 12px">Sale</span>
                                            @elseif($list['status'] == '2')
                                                <span class="label label-success" style="height:28px; padding:4px 12px">Registered</span>
                                            @elseif($list['status'] == '3')
                                                <span class="label label-danger" style="height:28px; padding:4px 12px">Block</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group-horizontal">
                                                <span data-toggle="tooltip" title="Delete QR Code" data-trigger="hover">
                                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#myModal{{$list['id']}}"><i class="fa fa-trash"></i></button>
                                                </span>
                                                <span class="ml-2"  data-toggle="tooltip" title="Download QR Code" data-trigger="hover">
                                                    <button class="btn btn-warning download_qr" type="button" data-id="{{$list['id']}}"><i class="fa fa-download"></i></button>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <!--------------------------------DELETE MODEL-------------------------------->
                                    <div id="myModal{{$list['id']}}" class="fade modal modal-danger" role="dialog">
                                        {{ Form::open(array('url' => 'admin/qr_code/'.$list['id'], 'method' => 'delete','style'=>'display:inline')) }}
                                        <div class="modal-dialog">
                                            <div class="modal-content ml-0">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Delete QR Code</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete this QR Code?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline pull-right">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                            <div style="text-align:right;float:right;"> @include('admin.pagination.limit_links', ['paginator' => $qr_code])</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
