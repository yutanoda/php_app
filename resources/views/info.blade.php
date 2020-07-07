@extends('common.layout')
@section('content')
<body class="info">
	<header>
		<div>
			<section id="siteID">
				<h1>第一学習社HS</h1>
				<h2>営業支援システム</h2>
			</section>
			<section id="userID">
				<article class="user">
					<h1>{{ $staff_name }}</h1>
					<h2>{{ $branch_name }}</h2>
				</article>
				<article class="logout">
					<a href="{{ route('logout') }}" id="logout"  onclick="return confirm('ログアウトしますか？　更新未完了の内容は破棄されます')">ログアウト</a>
				</article>
			</section>
		</div>
		<nav>
			<ul>
				<li><strong><span>回覧</span></strong></li>
				<li><a href="inclusion_result.html"><span>全社報告書</span></a></li>
				<li><a href="individual_result.html"><span>個別報告書</span></a></li>
				<li><a href="correspondence_result.html"><span>要望・提案書</span></a></li>
				@if($authority_flag != 1)
				<li><a href="sales_total.html"><span>営業集計</span></a></li>
				@endif
			</ul>
		</nav>
    </header>
	<main>
		<div>
			<section>
				<form action="{{ route('update_content') }}" method="post">
					@csrf
					<h1><strong><span>最終更新日：</span><span>{{ $content_update }}</span></strong>
						@if($authority_flag != 1)
						<button type="submit" class="update">更新</button>
						@endif
					</h1>
					<article>
						@if($authority_flag != 1)
						<input type="text" class="headline" value="{!! $title !!}" name="title">
						<textarea class="textbody" name="content">{{ $content }}</textarea>
						@else
						<input type="text" class="headline" value="{!! $title !!}" readonly="readonly">
						<textarea class="textbody" readonly="readonly">{{ $content }}</textarea>
						@endif
					</article>
				</form>
			</section>
		</div>
	</main>

</body>
@endsection
