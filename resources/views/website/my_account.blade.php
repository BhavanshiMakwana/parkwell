@extends('website.layouts.app')
@section('content')
    <section class="section cta-subscribe" style="height:77vh;">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-12 align-self-center mb-3" style="border-bottom: 1px solid #e9ecef;">
                    @include('website.error')
                    <div class="content ml-0">
                        <div class="title text-center mb-0">
                            <h2>My Account</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 border">
                    <ul class="feature-list">
                        <li class="@if($menu == 'My Account') text-danger @endif pb-2" style="border-bottom: 1px solid #e9ecef;">My Order</li>
                        <li class="pb-2" style="border-bottom: 1px solid #e9ecef;"><a href="{{'logout'}}">Logout</a></li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($orders) && $orders->count()>0)
                                @php $i = 1; @endphp
                                @foreach($orders as $list)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$list['Code']['code']}}</td>
                                        <td>{{$list['price']}} Rs</td>
                                    </tr>
                                    @php $i++; @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">Data Not Found</td>
                                </tr>
                            @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection