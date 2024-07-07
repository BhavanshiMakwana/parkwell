@extends('admin.layouts.app')
@section('content')
    <style>
        .select2-height {height: 38px !important;}
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
                            {!! Form::open(['url' => url('admin/notify_reason'), 'method' => 'get', 'id'=>'NotifyReason', 'class' => 'form-horizontal','files'=>false]) !!}
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-4 col-xs-12 mar-bot">
                                            <input  class="form-control select2-height" type="text" @if(!empty($search)) value="{{$search}}" @else placeholder="Search" @endif name="search" id="search">
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-xs-12 mar-bot">
                                            {!! Form::select('language', [
                                                '' => 'Select Language',
                                                'af' => 'Afrikaans',
                                                'sq' => 'Albanian',
                                                'am' => 'Amharic',
                                                'ar' => 'Arabic',
                                                'hy' => 'Armenian',
                                                'az' => 'Azerbaijani',
                                                'eu' => 'Basque',
                                                'be' => 'Belarusian',
                                                'bn' => 'Bengali',
                                                'bs' => 'Bosnian',
                                                'bg' => 'Bulgarian',
                                                'ca' => 'Catalan',
                                                'ceb' => 'Cebuano',
                                                'ny' => 'Chichewa',
                                                'zh' => 'Chinese (Simplified)',
                                                'zh-TW' => 'Chinese (Traditional)',
                                                'co' => 'Corsican',
                                                'hr' => 'Croatian',
                                                'cs' => 'Czech',
                                                'da' => 'Danish',
                                                'nl' => 'Dutch',
                                                'en' => 'English',
                                                'eo' => 'Esperanto',
                                                'et' => 'Estonian',
                                                'tl' => 'Filipino',
                                                'fi' => 'Finnish',
                                                'fr' => 'French',
                                                'fy' => 'Frisian',
                                                'gl' => 'Galician',
                                                'ka' => 'Georgian',
                                                'de' => 'German',
                                                'el' => 'Greek',
                                                'gu' => 'Gujarati',
                                                'ht' => 'Haitian Creole',
                                                'ha' => 'Hausa',
                                                'haw' => 'Hawaiian',
                                                'iw' => 'Hebrew',
                                                'hi' => 'Hindi',
                                                'hmn' => 'Hmong',
                                                'hu' => 'Hungarian',
                                                'is' => 'Icelandic',
                                                'ig' => 'Igbo',
                                                'id' => 'Indonesian',
                                                'ga' => 'Irish',
                                                'it' => 'Italian',
                                                'ja' => 'Japanese',
                                                'jw' => 'Javanese',
                                                'kn' => 'Kannada',
                                                'kk' => 'Kazakh',
                                                'km' => 'Khmer',
                                                'rw' => 'Kinyarwanda',
                                                'ko' => 'Korean',
                                                'ku' => 'Kurdish (Kurmanji)',
                                                'ky' => 'Kyrgyz',
                                                'lo' => 'Lao',
                                                'la' => 'Latin',
                                                'lv' => 'Latvian',
                                                'lt' => 'Lithuanian',
                                                'lb' => 'Luxembourgish',
                                                'mk' => 'Macedonian',
                                                'mg' => 'Malagasy',
                                                'ms' => 'Malay',
                                                'ml' => 'Malayalam',
                                                'mt' => 'Maltese',
                                                'mi' => 'Maori',
                                                'mr' => 'Marathi',
                                                'mn' => 'Mongolian',
                                                'my' => 'Myanmar (Burmese)',
                                                'ne' => 'Nepali',
                                                'no' => 'Norwegian',
                                                'or' => 'Odia (Oriya)',
                                                'ps' => 'Pashto',
                                                'fa' => 'Persian',
                                                'pl' => 'Polish',
                                                'pt' => 'Portuguese',
                                                'pa' => 'Punjabi',
                                                'ro' => 'Romanian',
                                                'ru' => 'Russian',
                                                'sm' => 'Samoan',
                                                'gd' => 'Scots Gaelic',
                                                'sr' => 'Serbian',
                                                'st' => 'Sesotho',
                                                'sn' => 'Shona',
                                                'sd' => 'Sindhi',
                                                'si' => 'Sinhala',
                                                'sk' => 'Slovak',
                                                'sl' => 'Slovenian',
                                                'so' => 'Somali',
                                                'es' => 'Spanish',
                                                'su' => 'Sundanese',
                                                'sw' => 'Swahili',
                                                'sv' => 'Swedish',
                                                'tg' => 'Tajik',
                                                'ta' => 'Tamil',
                                                'tt' => 'Tatar',
                                                'te' => 'Telugu',
                                                'th' => 'Thai',
                                                'tr' => 'Turkish',
                                                'tk' => 'Turkmen',
                                                'uk' => 'Ukrainian',
                                                'ur' => 'Urdu',
                                                'ug' => 'Uyghur',
                                                'uz' => 'Uzbek',
                                                'vi' => 'Vietnamese',
                                                'cy' => 'Welsh',
                                                'xh' => 'Xhosa',
                                                'yi' => 'Yiddish',
                                                'yo' => 'Yoruba',
                                                'zu' => 'Zulu'
                                            ], request('language'), ['class' => 'form-control select2-height' ]) !!}
                                        </div>
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <button type="submit" class="btn btn-info mr-1" name="submit" value="Search">Search</button>
                                            <a href="{{url('admin/notify_reason')}}"><button type="button" class="btn btn-danger mr-1" name="submit" value="Search">Clear</button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ url('admin/notify_reason') }}" ><button class="btn btn-default pull-right" type="button"><span class="fa fa-refresh"></span></button></a>
                                    <a href="{{ url('admin/notify_reason/create') }}"><button class="btn btn-info pull-right" type="button" style="margin-right: 1.5%;">Add Notify Reason</button></a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="card-body table-responsive">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Edit</th>
                                        <th style="width: 20%;">Language Code</th>
                                        <th style="width: 20%;">Notify Reason</th>
                                        <th style="width: 20%;">Iocns</th>
                                        <th style="width: 20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($notify_reason as $list)
                                    <tr class="ui-state-default" id="arrayorder_{{$list['id']}}">
                                        <td>
                                            <div class="btn-group-horizontal">
                                                {{ Form::open(array('url' => 'admin/notify_reason/'.$list['id'].'/edit', 'method' => 'get','style'=>'display:inline')) }}
                                                    <button class="btn btn-info tip" data-toggle="tooltip" title="Edit Translation Reason" data-trigger="hover" type="submit" ><i class="fa fa-edit"></i></button>
                                                {{ Form::close() }}
                                            </div>
                                        </td>
                                        <td>{{ $list['language'] }}</td>
                                        <td>{{ $list['reasons']  }}</td>
                                        <td> <img src="{{ asset('resource/reasonIcon/' . $list['image']) }}" alt="Not Found" width="40" height="40">
                                            </td>
                                        <td>
                                            <div class="btn-group-horizontal">
                                                <span data-toggle="tooltip" title="Delete Translation Reason" data-trigger="hover">
                                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#myModal{{$list['id']}}"><i class="fa fa-trash"></i></button>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <!--------------------------------DELETE MODEL-------------------------------->
                                    <div id="myModal{{$list['id']}}" class="fade modal modal-danger" role="dialog">
                                        {{ Form::open(array('url' => 'admin/notify_reason/'.$list['id'], 'method' => 'delete','style'=>'display:inline')) }}
                                        <div class="modal-dialog">
                                            <div class="modal-content ml-0">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Delete Translation Reason</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete this Notify Reason?</p>
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
                            <div style="text-align:right;float:right;"> @include('admin.pagination.limit_links', ['paginator' => $notify_reason])</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
