@extends('common.layout')

@section('title')
個別報告書
@endsection

@section('content')
<!-- 個別報告書 -->
<body class="search hy">
	<input type="checkbox" id="keyword_switch">
		@include('common_header')
	<main>
		<div>
			<section id="search">
				<form>
					<label><span class="color_t1n color_b1n">■年月</span><input type="month" name="keyword_date" @if(session('keyword_date')) value="{{ session('keyword_date') }}" @endif></label>
					<label><span class="color_t1n color_b1n">▼タイトル</span>
						<select name="keyword_title">
							<option value="">-未選択-</option>
							@foreach($title_commons as $title_common)
							<option value="{{ $title_common->common_number }}"
								@if( session('keyword_title') && $title_common->common_number == session('keyword_title') )
								selected
								@endif >
								{{ $title_common->value1}}
							</option>
							@endforeach
						</select>
					</label>
					<label><span class="color_t1n color_b1n">▼学校名</span>
						<select name="keyword_school">
							<option value="">-未選択-</option>
							@foreach ( $search_school as $school )
							<option value="{{ $school->school_code }}"
								@if( session('keyword_school') && $school->school_code == session('keyword_school') )
								selected
								@endif
								>{{ $school->school_name }}</option>
							@endforeach
						</select>
					</label>
					<label class="keyword" for="keyword_switch"><span class="color_t1n color_b1n">■キーワード</span><input type="text" id="keywords" readonly="readonly" @if(session('keywords')) value="{{ session('keywords') }}" @endif name="keyword"></label>
					<div class="buttons">
						<button type="reset" class="color_t1n color_b1n"><span>リセット</span></button>
						<button type="submit" class="search color_t1n color_b1n"><span>検索</span></button>
					</div>
					
					<div id="keyword"><article>
						<h1 class="color_t1n color_b1n">キーワード選択</h1>
						<dl>
						@foreach ($value1_arrays as $key => $value1_array)
						<dt class="color_t2 color_b2">{{ $key }}</dt>
									<dd>
										<ul>
											@foreach ( $value1_array as $k => $v )
											<li><label><input type="checkbox" name="keywords[]" value="{{ $v['value2'] }}" data-text="{{ $v['value2'] }}"><strong>{{ $v['value2'] }}</strong></label></li>
											@endforeach
										</ul>
									</dd>
						@endforeach
								<script language="javascript" type="text/javascript">
									const func1 = () => {
										const arr1 = [];
										const elements = document.getElementsByName("keywords[]");
										for (let i=0; i<elements.length; i++){
											if(elements[i].checked){ //(color1[i].checked === true)と同じ
													arr1.push(elements[i].value);
												}
										}
											document.getElementById( "keywords" ).value = arr1;
									}
								</script>
						</dl>
						<label class="close_keywords" for="keyword_switch" onclick="func1()"></label></article>
					</div>
				</form>
			</section>
			<section id="new">
				<form action="{{ url('create_report') }}">
					<button class="new color_t1n color_b1n" onclick="return confirm('営業報告書を作成しますか？')"><span>報告作成</span></button>
				</form>
			</section>
			<section id="result">
				<!-- <input type="checkbox" id="tablerow1_switch" class="tablerow_switch"><input type="checkbox" id="tablerow2_switch" class="tablerow_switch"><input type="checkbox" id="tablerow3_switch" class="tablerow_switch"><input type="checkbox" id="tablerow4_switch" class="tablerow_switch"><input type="checkbox" id="tablerow5_switch" class="tablerow_switch"><input type="checkbox" id="tablerow6_switch" class="tablerow_switch"><input type="checkbox" id="tablerow7_switch" class="tablerow_switch"><input type="checkbox" id="tablerow8_switch" class="tablerow_switch"><input type="checkbox" id="tablerow9_switch" class="tablerow_switch"><input type="checkbox" id="tablerow10_switch" class="tablerow_switch"> -->
				<article class="table">
@if($message == null)
					<ul class="thead color_t2 color_b2">
						<li class="no">No.</li>
						<li class="date">提出日</li>
						<li class="school">学校名</li>
						<li class="content">内容</li>
						<li class="comment">コメント</li>
						<li class="controller"></li>
					</ul>
						@foreach ($reports as $report)
						<input type="checkbox" id="tablerow{{$loop->iteration}}_switch" class="tablerow_switch">
						<ul class="tbody" style="height: 83px;">
							<li class="no" data-th="No.">{{ $report->report_number }}
								<a href="{{ url('detail_report', $report->report_number) }}" class="color_t1n color_b1n">詳細</a>
							</li>
							@if ( $report->status_flag==0 )
							<li class="date unsubmit" data-th="提出日：">未提出</li>
							@else
							<li class="date" data-th="提出日：">{{ $report->submitted_datetime }}</li>
							@endif
							<li class="school">
								<ul>
									@foreach($school_name as $key => $school)
										@if ( $key == $report->report_number )
											@foreach( $school as $school_data )
												<li>{{ $school_data->school_name }}</li>
											@endforeach
										@endif
									@endforeach
								</ul>
							</td>
							<li class="content">
								<article>
									@foreach($report_title as $key => $title)
										@if ( $key == $report->report_number )
											@if($title['1report_title'] != null)
												<h1 class="title">{{ $title['1report_title'] }}</h1>
												<p>{{ $title['1report'] }}</p>
											@else
												<h1 class="title">{{ $title['2report_title'] }}</h1>
												<p>{{ $title['2report'] }}</p>
											@endif
										@endif
									@endforeach
								</article>
							</li>
							<li class="comment">
								<article>
									@foreach($report_title as $key => $title)
										@if ( $key == $report->report_number )
										{{ $title['comment'] }}
										@endif
									@endforeach
								</article>
							</li>
							<li class="controller"><label for="tablerow{{$loop->iteration}}_switch"></label></li>
						</li>
					</ul>
						@endforeach
@else
	{{$message}}
@endif
			</section>
		</div>
		<nav id="pagination">
			<ul class="page-numbers">
				{{ $reports->links('vendor.pagination.semantic-ui') }}
			</ul>
			<section class="page-fraction">
				<p>7/25</p>
			</section>
		</nav>
	</main>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript">
		// 第一学習社HSの削除
			$('#result > article > ul > li.content > article > h1').each(function(){
				var hs = $(this).text();
				if ( hs.indexOf('第一学習社HS') != -1) {
					var replace_str = hs.replace('第一学習社HS', '');
					 $(this).text(replace_str);
				}
			});
	</script>
</body>
@endsection
