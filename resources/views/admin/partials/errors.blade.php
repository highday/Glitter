@if(!$errors->isEmpty())
<div class="container">
@foreach($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ $error }}
    </div>
@endforeach
</div>
@endif
