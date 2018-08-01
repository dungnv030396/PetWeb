<link rel="stylesheet" title="style" href="source/assets/dest/css/comment.css">
<script src="source\assets\dest\js\DateFormat\dateformat.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

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
                                    <a class="btn btn-info btn-circle text-uppercase" href="#" id="reply"><span
                                                class="glyphicon glyphicon-share-alt"></span> Reply</a>
                                    <a class="btn btn-warning btn-circle text-uppercase" data-toggle="collapse"
                                       href="#replyOne"><span class="glyphicon glyphicon-comment"></span> 2 comments</a>
                                </div>
                            </div>
                            <div class="collapse" id="replyOne">
                                <ul class="media-list">
                                    <li class="media media-replied">
                                        <a class="pull-left" href="#">
                                            <img class="media-object img-circle"
                                                 src="https://s3.amazonaws.com/uifaces/faces/twitter/ManikRathee/128.jpg"
                                                 alt="profile">
                                        </a>
                                        <div class="media-body">
                                            <div class="well well-lg">
                                                <h4 class="media-heading text-uppercase reviews"><span
                                                            class="glyphicon glyphicon-share-alt"></span> The Hipster
                                                </h4>
                                                <ul class="media-date text-uppercase reviews list-inline">
                                                    <li class="dd">22</li>
                                                    <li class="mm">09</li>
                                                    <li class="aaaa">2014</li>
                                                </ul>
                                                <p class="media-comment">
                                                    Nice job Maria.
                                                </p>
                                                <a class="btn btn-info btn-circle text-uppercase" href="#"
                                                   id="reply"><span class="glyphicon glyphicon-share-alt"></span> Reply</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media media-replied" id="replied">
                                        <a class="pull-left" href="#">
                                            <img class="media-object img-circle"
                                                 src="https://pbs.twimg.com/profile_images/442656111636668417/Q_9oP8iZ.jpeg"
                                                 alt="profile">
                                        </a>
                                        <div class="media-body">
                                            <div class="well well-lg">
                                                <h4 class="media-heading text-uppercase reviews"><span
                                                            class="glyphicon glyphicon-share-alt"></span> Mary</h4></h4>
                                                <ul class="media-date text-uppercase reviews list-inline">
                                                    <li class="dd">22</li>
                                                    <li class="mm">09</li>
                                                    <li class="aaaa">2014</li>
                                                </ul>
                                                <p class="media-comment">
                                                    Thank you Guys!
                                                </p>
                                                <a class="btn btn-info btn-circle text-uppercase" href="#"
                                                   id="reply"><span class="glyphicon glyphicon-share-alt"></span> Reply</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
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
