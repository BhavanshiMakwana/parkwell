@extends('website.layouts.app')
@section('content')
    <section class="section cta-subscribe" style="height:77vh;">
        <div class="container">
            <div class="row justify-content-md-center bg-elipse-red">
                <div class="col-md-5 align-self-center">
                    @include('website.error')
                    <div class="content ml-0">
                        <div class="title text-center">
                            <h2>Login</h2>
                        </div>
                        {!! Form::open(['url' => url('signin'), 'files'=>true]) !!}
                            <div class="form-group mb-3">
                                {!! Form::text('mobile', null, ['class' => 'form-control main','placeholder'=>'Enter your mobile number']) !!}
                                @if ($errors->has('mobile'))
                                    <span class="help-block mb-3">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                {!! Form::text('captcha', null, ['class' => 'form-control main','placeholder'=>'Enter captcha']) !!}
                                @if ($errors->has('captcha'))
                                    <span class="help-block mb-3">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="mb-3 text-center">
                                <button type="button" id="send_otp" class="btn btn-main-rounded other-btn">Send OTP</button>
                            </div>

                            <div class="form-group mb-3">
                                {!! Form::text('otp', null, ['class' => 'form-control main','placeholder'=>'Enter your otp']) !!}
                                @if ($errors->has('otp'))
                                    <span class="help-block mb-3">
                                        <strong>{{ $errors->first('otp') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-main-rounded float-right">Login</button>
                            </div>

                            <div class="mb-3">
                                Don't have account? <a href="{{url('register')}}">Register Now</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection