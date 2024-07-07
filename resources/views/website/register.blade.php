@extends('website.layouts.app')
@section('content')
    <section class="section cta-subscribe" style="height:77vh;">
        <div class="container">
            <div class="row justify-content-md-center bg-elipse-red">
                <div class="col-md-5 align-self-center">
                    @include('website.error')
                    <div class="content ml-0">
                        <div class="title text-center">
                            <h2>Register</h2>
                        </div>
                        {!! Form::open(['url' => url('signup'), 'class' => 'form-horizontal', 'files'=>true]) !!}
                            <div class="form-group">
                                {!! Form::text('code', null, ['class' => 'form-control main','placeholder'=>'Enter your 10 digits code']) !!}
                                @if ($errors->has('code'))
                                    <span class="help-block mb-3">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                {!! Form::text('name', null, ['class' => 'form-control main','placeholder'=>'Enter your name']) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block mb-3">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                {!! Form::text('mobile', null, ['class' => 'form-control main','placeholder'=>'Enter your mobile number']) !!}
                                @if ($errors->has('mobile'))
                                    <span class="help-block mb-3">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="mb-3 text-center">
                                <button type="button" id="send_otp" class="btn btn-main-rounded other-btn">Verify Mobile Number</button>
                            </div>

                            <div class="form-group">
                                {!! Form::text('otp', null, ['class' => 'form-control main','placeholder'=>'Enter your otp']) !!}
                                @if ($errors->has('otp'))
                                    <span class="help-block mb-3">
                                        <strong>{{ $errors->first('otp') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-main-rounded float-right">Register Tag</button>
                            </div>

                            <div class="mb-3">
                                Do you have account? <a href="{{url('login')}}">Login</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection