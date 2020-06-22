@extends('general.layouts.auth')
@section('content-section')

<div class="btn-section">
    <a href="#" class="link-btn active">Login</a>
<a href="{{route('register')}}" class="link-btn">Register</a>
</div>
@if(session('login-error'))
@alert([
'type' => 'warning',
'title' => 'Invald password or username!',
'message' => 'invalid credentials, please check yourself'
])
@endalert
@endif
@if(session('success'))
@alert([
'type' => 'success',
'title' => 'Hurrey!',
'message' => session('success')
])
@endalert
@endif
<div class="login-inner-form">
<div class="details">
    
<form action="{{route ('login')}}" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="input-text">
        </div>
        <div class="form-group mb-35">
            <label>Password</label>
            <input type="password" name="password" class="input-text">
        </div>
        <div class="form-group row">
            <div class="col-md-6 col-6">
                <button type="submit" class="btn-md btn-theme">Login</button>
            </div>
            <div class="col-md-6 col-6">
            <a href="{{route('forgetPasswordPage')}}" class="forgot">Forgot Password</a>
            </div>
        </div>
        @csrf
    </form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


@endsection