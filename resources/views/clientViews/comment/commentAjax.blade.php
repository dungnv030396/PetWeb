<link rel="stylesheet" title="style" href="source/assets/dest/css/comment.css">
<script src="source\assets\dest\js\DateFormat\dateformat.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

@if(empty($response))
<div class="row">
    <div class="col-sm-auto" id="logout">
        <div class="comment-tabs">
            <div class="tab-content">
                <div class="tab-pane active" id="comments-logout">
                    <ul class="media-list">
                        @foreach($comments as $comment)
                        <li class="media">
                            <a class="pull-left" href="#">
                                @if(str_contains($comment->user->avatar,'https://graph.facebook.com') OR str_contains($comment->user->avatar,'.googleusercontent.com'))
                                    <img class="media-object img-circle"
                                         src="{{$comment->user->avatar}}}"
                                         alt="profile">
                                @else
                                    <img class="media-object img-circle"
                                         src="{{'storage/avatar/'.$comment->user->avatar}}"
                                         alt="profile">
                                @endif
                            </a>
                            <div class="media-body">
                                <div class="well well-lg">
                                    <h4 class="media-heading text-uppercase reviews">{{$comment->user->name}} </h4>
                                    <ul class="media-date text-uppercase reviews list-inline">
                                        <li class="dd" id="message-date{{$comment->id}}"><script> document.getElementById("message-date{{$comment->id}}").innerHTML = formatDate('{{$comment->created_at}}','dd/MM/yyyy hh:mm:ss a');</script></li>
                                    </ul>

                                    <p class="media-comment">
                                        {{$comment->description}}
                                    </p>
                                    @if(!is_null($comment->media_link))
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="{{$comment->media_link}}" allowfullscreen></iframe>
                                        </div>
                                    @endif
                                    <a class="btn btn-info btn-circle text-uppercase" data-toggle="collapse" href="#addReply{{$comment->id}}" id="reply"><span
                                                class="glyphicon glyphicon-share-alt"></span> Reply</a>
                                    <a class="btn btn-warning btn-circle text-uppercase" data-toggle="collapse"
                                       href="#replyOne"><span class="glyphicon glyphicon-comment"></span> {{$comment->subComments->count()}} comments</a>
                                </div>
                            </div>
                            <div class="collapse" id="replyOne">
                                <ul class="media-list">
                                    @foreach($comment->subComments as $subComment)
                                    <li class="media media-replied">
                                        <a class="pull-left" href="#">
                                            @if(str_contains($subComment->user->avatar,'https://graph.facebook.com') OR str_contains($subComment->user->avatar,'.googleusercontent.com'))
                                                <img class="media-object img-circle"
                                                     src="{{$subComment->user->avatar}}}"
                                                     alt="profile">
                                            @else
                                                <img class="media-object img-circle"
                                                     src="{{'storage/avatar/'.$subComment->user->avatar}}"
                                                     alt="profile">
                                            @endif
                                        </a>
                                        <div class="media-body">
                                            <div class="well well-lg">
                                                <h4 class="media-heading text-uppercase reviews"><span
                                                            class="glyphicon glyphicon-share-alt"></span>{{$subComment->user->name}}
                                                </h4>
                                                <ul class="media-date text-uppercase reviews list-inline">
                                                    <li class="dd" id="message-date{{$subComment->id}}"><script> document.getElementById("message-date{{$subComment->id}}").innerHTML = formatDate('{{$subComment->created_at}}','dd/MM/yyyy hh:mm:ss a');</script></li>
                                                </ul>
                                                <p class="media-comment">
                                                    {{$subComment->description}}
                                                </p>
                                                <a class="btn btn-info btn-circle text-uppercase" data-toggle="collapse" href="#addReply{{$comment  ->id}}"
                                                   id="reply"><span class="glyphicon glyphicon-share-alt"></span> Reply</a>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                <a>Hiển thị thêm bình luận</a>
                            </div>
                            <div class="collapse" id="addReply{{$comment->id}}">
                                @include('clientViews.comment.addReplyComment')
                            </div>
                        </li>
                         @endforeach
                    </ul>
                </div>
                <div class="row">{{$comments->appends(['p4' => $comments->currentPage()])->links()}}</div>
            </div>
        </div>
    </div>
</div>
    @endif
@if(!empty($response))
    @if($response['status']=='success')
        {{$comments = $response['comments']}}
    <div class="row">
        <div class="col-sm-auto" id="logout">
            <div class="comment-tabs">
                <div class="tab-content">
                    <div class="tab-pane active" id="comments-logout">
                        <ul class="media-list">
                            @foreach($comments as $comment)
                                <li class="media">
                                    <a class="pull-left" href="#">
                                        @if(str_contains($comment->user->avatar,'https://graph.facebook.com') OR str_contains($comment->user->avatar,'.googleusercontent.com'))
                                            <img class="media-object img-circle"
                                                 src="{{$comment->user->avatar}}}"
                                                 alt="profile">
                                        @else
                                            <img class="media-object img-circle"
                                                 src="{{'storage/avatar/'.$comment->user->avatar}}"
                                                 alt="profile">
                                        @endif
                                    </a>
                                    <div class="media-body">
                                        <div class="well well-lg">
                                            <h4 class="media-heading text-uppercase reviews">{{$comment->user->name}} </h4>
                                            <ul class="media-date text-uppercase reviews list-inline">
                                                <li class="dd" id="message-date{{$comment->id}}"><script> document.getElementById("message-date{{$comment->id}}").innerHTML = formatDate('{{$comment->created_at}}','dd/MM/yyyy hh:mm:ss a');</script></li>
                                            </ul>

                                            <p class="media-comment">
                                                {{$comment->description}}
                                            </p>
                                            @if(!is_null($comment->media_link))
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe class="embed-responsive-item" src="{{$comment->media_link}}" allowfullscreen></iframe>
                                                </div>
                                            @endif
                                            <a class="btn btn-info btn-circle text-uppercase" data-toggle="collapse" href="#addReply{{$comment->id}}" id="reply"><span
                                                        class="glyphicon glyphicon-share-alt"></span> Reply</a>
                                            <a class="btn btn-warning btn-circle text-uppercase" data-toggle="collapse"
                                               href="#replyOne"><span class="glyphicon glyphicon-comment"></span> {{$comment->subComments->count()}} comments</a>
                                        </div>
                                    </div>
                                    <div class="collapse" id="replyOne">
                                        <ul class="media-list">
                                            @foreach($comment->subComments as $subComment)
                                                <li class="media media-replied">
                                                    <a class="pull-left" href="#">
                                                        @if(str_contains($subComment->user->avatar,'https://graph.facebook.com') OR str_contains($subComment->user->avatar,'.googleusercontent.com'))
                                                            <img class="media-object img-circle"
                                                                 src="{{$subComment->user->avatar}}}"
                                                                 alt="profile">
                                                        @else
                                                            <img class="media-object img-circle"
                                                                 src="{{'storage/avatar/'.$subComment->user->avatar}}"
                                                                 alt="profile">
                                                        @endif
                                                    </a>
                                                    <div class="media-body">
                                                        <div class="well well-lg">
                                                            <h4 class="media-heading text-uppercase reviews"><span
                                                                        class="glyphicon glyphicon-share-alt"></span>{{$subComment->user->name}}
                                                            </h4>
                                                            <ul class="media-date text-uppercase reviews list-inline">
                                                                <li class="dd" id="message-date{{$subComment->id}}"><script> document.getElementById("message-date{{$subComment->id}}").innerHTML = formatDate('{{$subComment->created_at}}','dd/MM/yyyy hh:mm:ss a');</script></li>
                                                            </ul>
                                                            <p class="media-comment">
                                                                {{$subComment->description}}
                                                            </p>
                                                            <a class="btn btn-info btn-circle text-uppercase" data-toggle="collapse" href="#addReply{{$comment  ->id}}"
                                                               id="reply"><span class="glyphicon glyphicon-share-alt"></span> Reply</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <a>Hiển thị thêm bình luận</a>
                                    </div>
                                    <div class="collapse" id="addReply{{$comment->id}}">
                                        @include('clientViews.comment.addReplyComment')
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="row">{{$comments->appends(['p4' => $comments->currentPage()])->links()}}</div>
                </div>
            </div>
        </div>
    </div>
    @else
        @include('sweet::alert')
    @endif
@endif

