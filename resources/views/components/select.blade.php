@props([
    'id' => '', 'label', 'name', 'selected' => '', 'options'
    ])



<select name="{{$name}}" id="{{$id}}"
 {{$attributes->class([
    'form-control','form-select','is-invalid'=>$errors->has($name)])}}>
<option>Select Your Category</option>
    @foreach ($options as $value => $text)
    <option value="{{$value}}" @if ($value == old($name,$selected)) selected
    @endif>{{ $text->name}}</option>
    @endforeach
</select>
@error($name)
<p class="invalid-feedback">{{$message}}</p>
@enderror