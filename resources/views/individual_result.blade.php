@extends('common.layout')
@section('content')
<!-- 個別報告書 -->
<body class="search hy2">
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
					<button class="new color_t1n color_b1n"  onclick="return confirm('営業報告書を作成しますか？')"><span>報告作成</span></button>
				</form>
			</section>
			<section id="result">
				<input type="checkbox" id="tablerow1_switch" class="tablerow_switch"><input type="checkbox" id="tablerow2_switch" class="tablerow_switch"><input type="checkbox" id="tablerow3_switch" class="tablerow_switch"><input type="checkbox" id="tablerow4_switch" class="tablerow_switch"><input type="checkbox" id="tablerow5_switch" class="tablerow_switch"><input type="checkbox" id="tablerow6_switch" class="tablerow_switch"><input type="checkbox" id="tablerow7_switch" class="tablerow_switch"><input type="checkbox" id="tablerow8_switch" class="tablerow_switch"><input type="checkbox" id="tablerow9_switch" class="tablerow_switch"><input type="checkbox" id="tablerow10_switch" class="tablerow_switch">
				<table>
@if($message == null)
					<thead class="color_t2 color_b2">
						<tr>
							<th class="no">No.</th>
							<th class="date">提出日</th>
							<th class="school">学校名</th>
							<th class="content">内容</th>
							<th class="comment">コメント</th>
							<th class="controller"></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($reports as $report)
						<tr>
							<td class="no" data-th="No.">{{ $report->report_number }}
								<a href="{{ url('detail_report', $report->report_number) }}" class="color_t1n color_b1n">詳細</a>
							</td>
							@if ( $report->status_flag==0 )
							<td class="date unsubmit" data-th="提出日：">未提出</td>
							@else
							<td class="date" data-th="提出日：">{{ $report->submitted_datetime }}</td>
							@endif
							<td class="school">
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
							<td class="content">
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
							</td>
							<td class="comment">
								<article>
									@foreach($report_title as $key => $title)
										@if ( $key == $report->report_number )
										{{ $title['comment'] }}
										@endif
									@endforeach
								</article>
							</td>
							<td class="controller"><label for="tablerow1_switch"></label></td>
						</tr>
						@endforeach
					</tbody>
				</table>
@else
	{{$message}}
@endif
			</section>
		</div>
		<nav id="pagination">
			<ul class="page-numbers">
				<li class="page-number color_b1n"><a href="#" class="color_t1n">|&lt;</a></li>
				<li class="page-number color_b1n"><a href="#" class="color_t1n">&lt;</a></li>
				<li>…</li>
				<li class="page-number color_b1n"><a href="#" class="color_t1n">5</a></li>
				<li class="page-number color_b1n"><a href="#" class="color_t1n">6</a></li>
				<li class="page-number current color_t1  color_b1"><strong class="color_t1">7</strong></li>
				<li class="page-number color_b1n"><a href="#" class="color_t1n">8</a></li>
				<li class="page-number color_b1n"><a href="#" class="color_t1n">9</a></li>
				<li>…</li>
				<li class="page-number color_b1n"><a href="#" class="color_t1n">&gt;</a></li>
				<li class="page-number color_b1n"><a href="#" class="color_t1n">&gt;|</a></li>
			</ul>
			<section class="page-fraction">
				<p>7/25</p>
			</section>
		</nav>
	</main>
</body>
@endsection
