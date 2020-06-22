@extends('general.layouts.auth')
@section('content-section')
<div class="btn-section">
    @if(session('success'))
    @alert([
    'type' => 'success',
    'title' => 'Hurrey!',
    'message' => session('success')
    ])
    @endalert
    @endif
<form action="{{route ('resetPassword')}}" method="post">
    <div class="form-group">
        <label>New Password</label>
        <input type="password" name="password" class="input-text">
    </div>
    <div class="form-group mb-35">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" class="input-text">
    </div>
    <div class="form-group row">
        <div class="col-md-6 col-6">
            <button type="submit" class="btn-md btn-theme">Reset</button>
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