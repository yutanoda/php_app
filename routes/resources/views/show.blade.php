@extends('common.layout')

@section('content')
<div class="mx-auto" style="margin-top: 100px; width: 800px;">
        <div class="form-group">
            <label>User_id　{{ $user_id }}</label>            
        </div>
        <div class="form-group">
            <label>Login_password　{{ $login_password }}</label>            
        </div>
    </div>
@endsection
