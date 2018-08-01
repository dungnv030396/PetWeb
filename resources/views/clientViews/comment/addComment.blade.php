<link rel="stylesheet" title="style" href="source/assets/dest/css/comment.css">
<!------ Include the above in your HEAD tag ---------->

<div class="row">
    <div class="col-sm-auto" id="logout">
        <div class="comment-tabs">
            <div class="tab-pane" id="add-comment">
                <form action="{{route('addSingleComment')}}" method="post" class="form-horizontal" id="commentForm" role="form">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{$product['product']->id}}" name="productId">
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Bình luận của bạn</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="addComment" id="addComment" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="uploadMedia" class="col-sm-2 control-label">Nhúng media</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-addon">Link</div>
                                <input type="text" class="form-control" name="uploadMedia" id="uploadMedia">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button class="btn btn-success btn-circle text-uppercase" type="submit"
                                    id="submitComment"><span class="glyphicon glyphicon-send"></span> Gửi Bình Luận
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
