@extends('common.layout')
@section('title')
回覧
@endsection
@section('content')
<body class="info hy">
		@include('common_header')
	<main>
		<div>
			<section>
				<form action="{{ route('update_content') }}" method="post">
					@csrf
					<h1 class="headline color_b2"><strong class="color_t2"><span>最終更新日：</span>
						@if ($red == 0)
						<span class="new">
							@else
							<span>
						@endif
							{{ $content_update }}
						</span></strong>
						@if($authority_flag != 1)
						<button type="submit" class="update color_t1n color_b1n">更新</button>
						@endif
					</h1>
					<article>
						@if($authority_flag != 1)
						<textarea class="textbody" name="content">{{ $content->notice }}</textarea>
						@else
						<textarea class="textbody" readonly="readonly">{{ $content->notice }}</textarea>
						@endif
					</article>
				</form>
			</section>
		</div>
	</main>

</body>

@endsection
