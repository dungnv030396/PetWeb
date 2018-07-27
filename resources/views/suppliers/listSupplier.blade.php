@extends('layouts.master')
@section('content')
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <div class="container">
        <h2 style="color: #f90"> Danh Sách Nhà Cung Cấp</h2>
        <br>
        <div><h4>Tìm thấy <a style="color: #f90">{{ $listSupplier['number'] }}</a> Nhà Cung Cấp</h4>
            <form method="POST" action="searchSupplier">
                {{ csrf_field() }}
                <span class="search-supplier"><input class="form-control form-control-lg form-control-borderless"
                                                     name="name" type="search" placeholder="Tìm Kiếm Tên Nhà Cung Cấp"></span>
                <button class="button-search-supplier btn btn-success " type="submit">Tìm Kiếm</button>
            </form>
        </div>
        <br>
        @foreach($listSupplier['user'] as $item)
            <div class="row">
                <div class="list-group">
                    <div class="list-group-item clearfix">
                        <div class="profile-teaser-left">
                            @if(str_contains($item->avatar,'https://graph.facebook.com') OR str_contains($item->avatar,'https://lh3.googleusercontent.com'))
                                <div class="profile-img"><img src="{{ $item->avatar }}" class="profile-img"/></div>
                            @else
                                <div class="profile-img"><img src="{{ 'storage/avatar/'.$item->avatar }}"/></div>
                            @endif
                        </div>
                        <div class="profile-teaser-main">
                            <a href="detailSupplier/{{ $item->id }}"><h2 class="profile-name">{{ $item->name }}</h2></a>
                            {{--{{route('detailSupplier/')}}{{ $item->id }}--}}
                            <div class="profile-info">
                                <div class="info"><span class="">Email:</span> {{ $item->email }}</div>
                                <div class="info"><span class="">SDT: </span>{{ $item->phoneNumber }}</div>
                            </div>
                            <br>
                            <div class="profile-info">
                                <div class="info"><span class="">Địa Chỉ:</span> {{ $item->address }}</div>
                            </div>
                        </div>
                    </div><!-- item -->
                </div>
            </div>
        @endforeach
        <div class="row">{{$listSupplier['user']->links()}}</div>
    </div>
@endsection