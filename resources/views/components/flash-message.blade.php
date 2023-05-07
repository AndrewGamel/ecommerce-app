@if (session()->has('message'))
<div class="alert alert-success">
    {{ Session()->get('success') }}
</div>
@endif

@if (session()->has('message'))
<div class="alert alert-danger">
    {{ Session::get('success') }}
</div>
@endif