@extends('website.layouts.app')
@section('content')
    <!--********* HOME *********-->
    <section class="banner bg-1" id="home">
        <div class="container">
            <div class="row">
                <div class="col-md-8 align-self-center">
                    <div class="content-block">
                        <h1>Amazing Website Best for business</h1>
                        <h5>Let you track everything in your life with a simple way</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="image-block">
                        <img class="img-fluid" src="{{url('assets/website/images/phones/iphone-banner1.png')}}" alt="iphone-banner">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--********* About Us *********-->
    <section class="about section bg-2" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mr-auto">
                    <!-- Image Content -->
                    <div class="image-block">
                        <img src="{{url('assets/website/images/phones/iphone-banner1.png')}}" alt="iphone-feature" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 col-md-10 m-md-auto align-self-center ml-auto">
                    <div class="about-block">
                        <!-- About 01 -->
                        <div class="about-item">
                            <div class="icon">
                                <i class="tf-ion-ios-paper-outline"></i>
                            </div>
                            <div class="content">
                                <h5>Creative Design</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                        <!-- About 02 -->
                        <div class="about-item active">
                            <div class="icon">
                                <i class="tf-globe"></i>
                            </div>
                            <div class="content">
                                <h5>Easy to Use</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                        <!-- About 03 -->
                        <div class="about-item">
                            <div class="icon">
                                <i class="tf-circle-compass"></i>
                            </div>
                            <div class="content">
                                <h5>Best User Experience</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--********* Pricing Plan *********-->
    <section class="pricing section bg-primary-shape" id="pricing">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2 class="text-white">Choose Your Plan</h2>
                        <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-table text-center">
                        <div class="title">
                            <h5>Free</h5>
                        </div>
                        <div class="price">
                            <p>$0<span>/month</span></p>
                        </div>
                        <ul class="feature-list">                    
                            <li>One time payment</li>
                            <li>Build & Publish</li>
                            <li>Life time support</li>
                        </ul>
                        <div class="action-button">
                            <a href="" class="btn btn-main-rounded">Start Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-table featured text-center">
                        <div class="title">
                            <h5>Basic</h5>
                        </div>
                        <div class="price">
                            <p>$19<span>/month</span></p>
                        </div>
                        <ul class="feature-list">                    
                            <li>One time payment</li>
                            <li>Build & Publish</li>
                            <li>Life time support</li>
                        </ul>
                        <div class="action-button">
                            <a href="" class="btn btn-main-rounded">Start Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 m-md-auto">
                    <div class="pricing-table text-center">
                        <div class="title">
                            <h5>Advance</h5>
                        </div>
                        <div class="price">
                            <p>$99<span>/month</span></p>
                        </div>
                        <ul class="feature-list">
                            <li>One time payment</li>
                            <li>Build & Publish</li>
                            <li>Life time support</li>
                        </ul>
                        <div class="action-button">
                            <a href="" class="btn btn-main-rounded">Start Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--********* Contact *********-->
    <section class="section cta-subscribe" id="contact">
        <div class="container">
            <div class="row bg-elipse-red">
                <div class="col-lg-4">
                    <div class="image"><img src="{{url('assets/website/images/phones/iphone-banner1.png')}}" alt="iphone-app"></div>
                </div>
                <div class="col-lg-8 align-self-center">
                    <div class="content ml-0">
                        <div class="title">
                            <h2>Contact Us</h2>
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
                                <input type="text" name="subject" class="form-control main" placeholder="Enter your subject">
                            </div>

                            <div class="input-group mb-3">
                                <textarea name="message" class="form-control main" rows="5" placeholder="Message..."></textarea>
                            </div>

                            <div class="mb-3">
                                <button type="button" class="btn btn-main-rounded float-right">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection