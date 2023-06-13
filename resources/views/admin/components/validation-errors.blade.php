@if($errors->count() > 0)
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <i class='bx bxs-x-circle'></i>
        <div class="ms-sm-1">
            {{ __('layout.forms.error') }}
        </div>
    </div>
@endif
