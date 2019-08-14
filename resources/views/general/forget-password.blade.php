@extends('general.layouts.auth')
@section('content-section')


<div class="login-inner-form">
    <div class="details">
    <form action="{{route('forgetPassword')}}" method="post">
            <div class="form-group mb-30">
                <label>Email Address</label>
                <input type="email" name="email" class="input-text">
            </div>
            <div class="form-group">
                <button type="submit" class="btn-md btn-theme btn-block">Send Me Email</button>
            </div>
        <p>Already a member? <a href="{{route('login')}}">Login here</a></p>
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