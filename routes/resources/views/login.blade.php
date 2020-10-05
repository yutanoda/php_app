@extends('common.login_layout')
@section('content')
<main>
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
		<form method="post" name="login_form" id="login_form" autocomplete="off">
    @csrf {{-- CSRF保護 --}}
    @method('POST') {{-- 疑似フォームメソッド --}}
			<p><label>ユーザー名：<input type="text" name="user_id"></label></p>
			<p><label>パスワード：<input type="password" name="login_password" autocomplete="new-password"></label></p>
			<p><button id="login" type="submit" name="submit"><span>ログイン</span></button></p>
		</form>
	</main>
@endsection
