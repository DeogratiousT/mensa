@if (session('status'))
    <div class="alert alert-primary">
        <div class="d-flex flex-column">
            <span>{{ session('status') }}</span>
        </div>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        <div class="d-flex flex-column">
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        <div class="d-flex flex-column">
            <span>{{ session('error') }}</span>
        </div>
    </div>
@endif