@extends('common.layout')
@section('content')
<body class="info hy">
		@include('common_header')
	<main>
		<div>
			<section>
				<form action="{{ route('update_content') }}" method="post">
					@csrf
					<h1 class="headline color_b2"><strong class="color_t2"><span>最終更新日：</span><span>{{ $content_update }}</span></strong>
						@if($authority_flag != 1)
						<button type="submit" class="update color_t1n color_b1n">更新</button>
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
