@extends('layouts.master')
@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <h2 style="color: #f90"> Danh Sách Nhà Cung Cấp</h2>
    <br>
    <h4>Tìm thấy {{ $number }} Nhà Cung Cấp</h4>
    <br>
@foreach($user as $item)
    <div class="row">
        <div class="list-group">
            <div class="list-group-item clearfix">
                <div class="profile-teaser-left">
                    <div class="profile-img"><img src="{{ $item->avatar }}"/></div>
                </div>
                <div class="profile-teaser-main">
                    <h2 class="profile-name">Jane Doe</h2>
                    <div class="profile-info">
                        <div class="info"><span class="">Info:</span> Something here</div>
                        <div class="info"><span class="">Info:</span> Something here</div>
                        <div class="info"><span class="">Info:</span> Something here</div>
                        <div class="info"><span class="">Info:</span> Something here</div>
                    </div>
                </div>
            </div><!-- item -->
        </div>
    </div>
    @endforeach
    <div class="row">{{$user->links()}}</div>
</div>
    @endsection