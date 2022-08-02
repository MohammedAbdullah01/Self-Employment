<div>
    <select name="country"  class="form-control" >
        @foreach ($countries as $code =>  $name)
            <option value="{{$code}}" {{$code == $selected ? 'selected' :''}}  >{{$name}}</option>
        @endforeach
    </select>
</div>
