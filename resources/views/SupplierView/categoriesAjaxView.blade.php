<select name="category" class="form-control" >
@foreach($categories as $category)
    <option value="{{$category->id}}">{{$category->name}}</option>
@endforeach
</select>

