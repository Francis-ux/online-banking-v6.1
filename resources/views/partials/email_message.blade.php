@if (session()->has('email_success'))
    <div class="alert alert-success text-center">{{ session()->get('email_success') }}</div>
@elseif(session()->has('email_error'))
    <div class="alert alert-danger text-center">{{ session()->get('email_error') }}</div>
@endif
