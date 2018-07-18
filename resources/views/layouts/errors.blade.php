@if(count($errors))
    <div class="form-group">

        <div class="alert alert-danger">
            <ul>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </ul>
        </div>

    </div>
@endif