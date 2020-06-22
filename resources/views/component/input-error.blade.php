@if($errors->has($field))
<span class="text-14 text-warning">{{ $errors->first($field) }}</span>
@endif