@extends('layouts.master')
@section('content')
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <div class="container">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title" id="myModalLabel" style="color: #f90">Thông Tin Chi Tiết Nhà Cung Cấp</h4>
                    </div>
                    <div class="modal-body">
                        <center>
                            @if(str_contains($user->avatar,'https://graph.facebook.com') OR str_contains($user->avatar,'.googleusercontent.com'))
                                <div class="span2">
                                    <img src="{{$user->avatar}}" name="aboutme" width="140" height="140" border="0" class="img-circle"/>
                                </div>
                            @else
                                <div class="span2">
                                    <img src="{{'storage/avatar/'.$user->avatar}}" name="aboutme" width="140" height="140" border="0" class="img-circle"/>
                                </div>
                            @endif
                            {{--<img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRbezqZpEuwGSvitKy3wrwnth5kysKdRqBW54cAszm_wiutku3R" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>--}}
                            <h1 class="media-heading">{{$user->name}}</h1>
                            <span><strong>Skills: </strong></span>
                            <span class="label label-warning">HTML5/CSS</span>
                            <span class="label label-info">Adobe CS 5.5</span>
                            <span class="label label-info">Microsoft Office</span>
                            <span class="label label-success">Windows XP, Vista, 7</span>
                        </center>
                        <hr>
                        <center>
                            <p class="text-left"><strong>Bio: </strong><br>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sem dui, tempor sit amet commodo a, vulputate vel tellus.</p>
                            <br>
                        </center>
                    </div>
                </div>
            </div>
@endsection