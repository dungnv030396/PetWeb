@extends('layouts.master')
@section('content')
    <link href="css/css-detailSupplier.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    {{--@if(!empty($response))--}}
        {{--@include('sweet::alert')--}}
    {{--@endif--}}
    @if(!empty(\Illuminate\Support\Facades\Session::get('message')))
        @include('sweet::alert')
    @endif
    @if(!empty(\Illuminate\Support\Facades\Session::get('message2')))
        @include('sweet::alert')
    @endif
    <div class="container" style="margin-top: 30px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h2 class="modal-title" id="myModalLabel" style="color: #f90">Thông Tin Chi Tiết Nhà Cung Cấp</h2>
            </div>
            <div class="modal-body">
                <center>
                    @if(str_contains($user->avatar,'https://graph.facebook.com') OR str_contains($user->avatar,'.googleusercontent.com'))
                        <div class="span2">
                            <img src="{{$user->avatar}}" name="aboutme" width="140" height="140" border="0"
                                 class="img-circle"/>
                        </div>
                    @else
                        <div class="span2">
                            <img src="{{'storage/avatar/'.$user->avatar}}" name="aboutme" width="140" height="140"
                                 border="0" class="img-circle"/>
                        </div>
                    @endif
                    <h1 class="media-heading">{{$user->name}}</h1>

                </center>

                {{--report--}}
                {{--@if(\Illuminate\Support\Facades\Auth::check())--}}
                <div style="margin-right: 50vw">
                    @include('layouts.reportSupplier')
                </div>
                {{--@endif--}}
                <div class="well well-small clearfix">

                    <div class="row">
                        <div class="col-sm-6" style="margin-left: 50px">
                            <ul class="unstyled">
                                <h4>
                                    <li><i class="icon-phone"></i> {{ $user->phoneNumber }}</li>
                                </h4>
                                <h4>
                                    <li><i class="icon-envelope"></i> {{ $user->email }}</li>
                                </h4>
                                <h4>
                                    <li><i class="icon-globe"></i> {{ $user->address }}</li>
                                </h4>
                            </ul>
                        </div>

                        <div class="col-sm-4">
                            <ul class="unstyled">
                                <h4>
                                    <li class="main-color">Số Lần Bị Báo Cáo: {{$reportTime}}</li>
                                </h4>
                                <h4><a>
                                        <li>Số Đơn Hàng Đã Bán: {{ $number }}</li>
                                    </a></h4>
                            </ul>
                        </div>
                    </div>

                </div>
                {{--<hr>--}}
                {{--<center>--}}
                {{--<p class="text-left"><strong>Bio: </strong><br>--}}
                {{--Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sem dui, tempor sit amet commodo a, vulputate vel tellus.</p>--}}
                {{--<br>--}}
                {{--</center>--}}
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    @include('layouts.main_products');

@endsection