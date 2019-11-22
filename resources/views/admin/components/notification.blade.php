@if (session('notification') )
<div class="alert alert-{{ session('type-notification') }} alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
     {{ session('notification') }}
</div>
@endif
