@extends('website.layouts.app')
@section('content')
    <section class="section cta-subscribe" id="contact">
        <div class="container">
            <div class="row justify-content-md-center bg-elipse-red">
                <div class="col-md-6 align-self-center">
                    <div class="content ml-0">
                        <div class="title text-center">
                            <h2>Order Now</h2>
                        </div>
                        <form action="#">
                            <div class="input-group mb-3">
                                <input type="text" name="name" class="form-control main" placeholder="Enter your name">
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="email" class="form-control main" placeholder="Enter your email address">
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="mobile" class="form-control main" placeholder="Enter your mobile number">
                            </div>

                            <div class="input-group mb-3">
                                <textarea name="address" class="form-control main" rows="5" placeholder="Address..."></textarea>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="state" class="form-control main" placeholder="Enter your state name">
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="city" class="form-control main" placeholder="Enter your city name">
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="pin_code" class="form-control main" placeholder="Enter your pin code">
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="captcha" class="form-control main" placeholder="Enter your captcha">
                            </div>

                            <div class="mb-3">
                                <button type="button" class="btn btn-main-rounded float-right" data-toggle="modal" data-target="#OrderTag">Order Your Tags</button>
                            </div>
                        </form>

                        <!--------------------------------ORDER TAG MODEL-------------------------------->
                        <div id="OrderTag" class="fade modal" role="dialog">
                            {{ Form::open(array('url' => '#', 'style'=>'display:inline')) }}
                            <div class="modal-dialog">
                                <div class="modal-content ml-0">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Order Your Tags</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span class="text-danger" aria-hidden="true" style="font-size: 25px;">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-12 align-self-center">
                                                <div class="content ml-0">
                                                    <form action="#">
                                                        <h5>How many Tags?</h5>
                                                        <div class="row mt-4">
                                                            <div class="col-md-6">
                                                                <h6>Big</h6>
                                                                <div class="input-group mb-3">
                                                                    <select name="big_tags" class="form-control main">
                                                                        @for($i=1; $i<=20; $i++)
                                                                            <option value="{{$i}}">{{$i}}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6>Small</h6>
                                                                <div class="input-group mb-3">
                                                                    <select name="small_tags" class="form-control main">
                                                                        @for($i=1; $i<=20; $i++)
                                                                            <option value="{{$i}}">{{$i}}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h6>Total</h6>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="amount" class="form-control main" placeholder="Total Amount">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-main-rounded other-btn-cls" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-main-rounded other-btn">Pay Now</button>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection