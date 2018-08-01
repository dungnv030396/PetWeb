<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link href="css/css-detailSupplier.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<div class="container profile">
    <div class="row">
        <h2 style="color: #f90; margin-top: 50px;margin-bottom: 50px"> Thông Tin Chi Tiết Nhà Cung Cấp</h2>
        <div class="span12">
            <div class="well well-small clearfix">
                <div class="row-fluid">
                    @if(str_contains($user->avatar,'https://graph.facebook.com') OR str_contains($user->avatar,'.googleusercontent.com'))
                        <div class="span2">
                            <img src="{{$user->avatar}}" class="img-polaroid"/>
                        </div>
                    @else
                        <div class="span2">
                            <img src="{{'storage/avatar/'.$user->avatar}}" class="img-polaroid"/>
                        </div>
                    @endif
                    <div class="span4">
                        <h2>{{ $user->name }}</h2>
                        <ul class="unstyled">
                            <li><i class="icon-phone"></i> {{ $user->phoneNumber }}</li>
                            <li><i class="icon-envelope"></i> {{ $user->email }}</li>
                            <li><i class="icon-globe"></i> {{ $user->address }}</li>
                        </ul>
                    </div>
                    <div class="span6">
                        <ul class="inline stats">
                            <li>
                                <span>275</span>
                                Friends
                            </li>
                            <li>
                                <span>354</span>
                                Followers
                            </li>
                            <li>
                                <span>186</span>
                                Photos
                            </li>
                        </ul>
                        <div><!--/span6-->
                        </div><!--/row-->
                    </div>
                    <!--Body content-->
                </div>
            </div>
        </div>
    </div>
</div>
