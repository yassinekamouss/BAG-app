@if (session()->has('success'))

    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Notification !</strong><span class="p-2">{{session('success')}}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    
@endif
