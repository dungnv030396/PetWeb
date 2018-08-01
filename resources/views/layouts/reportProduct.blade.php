<!------ Include the above in your HEAD tag ---------->
<script>

    function HideTextBox(ddlId) {
        var ControlName = document.getElementById(ddlId.id);
        if (ControlName.value != 1)  //it depends on which value Selection do u want to hide or show your textbox
        {
            document.getElementById('MyTextBox').style.display = 'none';
        }
        else {
            document.getElementById('MyTextBox').style.display = '';
        }
    }
</script>

@if(count($errors))
    <script>
        $(function () {
            $("#dropdown").addClass("open");
        })
    </script>
@endif
@if(!empty(Session::get('reportSuccess')))
    <script>
        $(function () {
            $("#dropdown").addClass("open");
        })
    </script>
@endif
<div class="input-group" id="adv-search">
    <div class="input-group-btn">
        <div class="btn-group" role="group">
            <div id="dropdown" class="dropdown dropdown-lg">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false"><span class="glyphicon glyphicon-circle-arrow-down"></span> Báo Cáo
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{ Route('reportProduct',[$product['supplier']->id,$product['product']->id]) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="filter">Nội Dung Báo Cáo</label>
                            <select name="report" id="ddlIDType" runat="server" onchange="HideTextBox(this);"
                                    class="form-control">
                                <option value="Sản Phẩm này sử dụng hình ảnh nhạy cảm hoặc bạo lực">Sản Phẩm này sử dụng hình ảnh nhạy cảm hoặc bạo lực
                                </option>
                                <option value="Sản Phẩm này sử dụng hình ảnh không thực tế">Sản Phẩm này sử dụng hình ảnh không thực tế
                                </option>
                                <option value="Sản Phẩm này là hàng giả">Sản Phẩm này là hàng giả
                                </option>
                                <option value="1" selected>Nội dung khác</option>
                            </select>
                        </div>
                        <div id="MyTextBox" runat="server" class="form-group">
                            <label for="contain">Xin mời nhập nội dung khác</label>
                            <input class="form-control" type="text-area" name="other" required
                                   value="{{ old('other') }}"/>
                        </div>
                        {{--<button type="submit" class="btn btn-primary" value="Báo Cáo"></button>--}}
                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-send"></span>
                            Gửi Báo Cáo
                        </button>
                        @if (session('reportSuccess'))
                            <div class="alert alert-success">
                                <ul>
                                    {{ session('reportSuccess') }}
                                </ul>
                            </div>
                        @endif
                        {{--@if($errors->has('other'))--}}
                        {{--<div class="alert alert-danger">--}}
                        {{--<ul>--}}
                        {{--{{ $errors->first() }}--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                        {{--@endif--}}

                        @include('layouts.errors')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
