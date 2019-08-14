@extends('general.layouts.auth')
@section('content-section')

<div class="btn-section">
<a href="{{route('loginPage')}}" class="link-btn">Login</a>
    <a href="#" class="link-btn active">Register</a>
</div>
<div class="login-inner-form">
    <div class="details">
        
    <form action="{{route('create')}}" method="Post">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" class="input-text">
            </div>
            <div class="form-group">
                <label>last Name</label>
                <input type="text" name="last_name" class="input-text">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="input-text">
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="input-text">
            </div>
            <div class="form-group mb-35">
                <label>Password</label>
                <input type="password" name="password" class="input-text">
            </div>
            
            <div class="form-group mb-0">
                <button type="submit" class="btn-md btn-theme">Register</button>
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