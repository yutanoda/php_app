@extends('common.layout')
@section('content')
<!-- 全社報告書 -->
<body class="search hy">
	<input type="checkbox" id="keyword_switch">
	@include('common_header')
	<main>
		<div>
			<section id="search">
				<form name="search" action="{{url('/inclusion_result')}}" method="GET">
					<label><span class="color_t1n color_b1n">■年月</span><input type="month" name="keyword_date"></label>
					<label><span class="color_t1n color_b1n">▼タイトル</span>
						<select name="keyword_title">
							<option value="">-未選択-</option>
							@foreach($title_commons as $title_common)
							<option value="{{ $title_common->common_number }}">
								{{ $title_common->value1}}
							</option>
							@endforeach
						</select>
					</label>
					<label><span class="color_t1n color_b1n">▼営業所</span>
						<select name="keyword_branch">
							<option value="">-未選択-</option>
							@foreach($branch_commons as $branch_common)
							<option value="{{ $branch_common->branch_code}}">{{ $branch_common->branch_name}}</option>
							@endforeach
						</select>
					</label>
					<label><span class="color_t1n color_b1n">▼提出者</span>
						<select name="keyword_submitter">
							<option value="">-未選択-</option>
							@foreach($submitter_commons as $submitter_common)
							<option value="{{ $submitter_common->staff_code}}">{{ $submitter_common->staff_name}}</option>
							@endforeach
						</select>
					</label>
					<label><span class="color_t1n color_b1n">▼都道府県</span>
						<select name="keyword_prefecture" id="prefecture_id">
							<option value="">-未選択-</option>
							@foreach($prefecture_commons as $prefecture_common)
							<option value="{{ $prefecture_common->prefecture_code}}">{{ $prefecture_common->prefecture_name}}</option>
							@endforeach
						</select>
					</label>
					<label><span class="color_t1n color_b1n">▼学校名</span>
						<select name="keyword_school" id="keyword_school">
							<option value="">-未選択-</option>
							@foreach($school_commons as $school_common)
							<option class="{{ $school_common->prefecture_code}}" value="{{ $school_common->school_code}}">{{ $school_common->school_name}}</option>
							@endforeach
						</select>
					</label>
					<label><span class="color_t1n color_b1n">▼ランク</span>
						<select name="keyword_rank">
							<option value="">-未選択-</option>
							@foreach($rank_commons as $rank_common)
							<option value="{{ $rank_common->common_number }}">{{ $rank_common->value1}}</option>
							@endforeach
						</select>
					</label>
					<label><span class="color_t1n color_b1n">▼分類</span>
						<select name="keyword_category">
							<option value="">-未選択-</option>
							@foreach($category_commons as $category_common)
							<option value="{{ $category_common->common_number }}">{{ $category_common->value1}}</option>
							@endforeach
						</select>
					</label>
					<label class="keyword" for="keyword_switch"><span class="color_t1n color_b1n">■キーワード</span><input type="text" id="keywords" readonly="readonly" value=""></label>
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
			<section id="result">
				<input type="checkbox" id="tablerow1_switch" class="tablerow_switch"><input type="checkbox" id="tablerow2_switch" class="tablerow_switch"><input type="checkbox" id="tablerow3_switch" class="tablerow_switch"><input type="checkbox" id="tablerow4_switch" class="tablerow_switch"><input type="checkbox" id="tablerow5_switch" class="tablerow_switch"><input type="checkbox" id="tablerow6_switch" class="tablerow_switch"><input type="checkbox" id="tablerow7_switch" class="tablerow_switch"><input type="checkbox" id="tablerow8_switch" class="tablerow_switch"><input type="checkbox" id="tablerow9_switch" class="tablerow_switch"><input type="checkbox" id="tablerow10_switch" class="tablerow_switch">
				<table>
					<thead class="color_t2 color_b2">
						<tr>
							<th class="no">No.</th>
							<th class="date">提出日</th>
							<th class="user">提出者</th>
							<th class="branch">営業所</th>
							<th class="content">内容</th>
							<th class="comment">コメント</th>
							<th class="controller"></th>
						</tr>
					</thead>
					<tbody>
						@if($message)
						<tr><td>{{$message}}</td></tr>
						@else
						@foreach ($reports as $report)

							<tr>
								<td class="no" data-th="No.">{{ $report->report_number }}<a href="{{ url('detail_report', $report->report_number) }}" class="color_t1n color_b1n">詳細</a></td>
								<td class="date" data-th="提出日：">{{ $report->submitted_datetime->format('Y/m/d') }}</td>
								
								<td class="user" data-th="提出者：">{{$report->tstaff->staff_name}}</td>
								<td class="branch" data-th="営業所：">{{$report->tbranch->branch_name}}</td>
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
										<p>
											@foreach($report_title as $key => $title)
												@if ( $key == $report->report_number )
												{{ $title['comment'] }}
												@endif
											@endforeach
										</p>
									</article>
								</td>
							</tr>
						@endforeach
						@endif
					</tbody>
				</table>
			</section>
		</div>
		
		<!-- <nav id="pagination">
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
		</nav> -->


	</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript">
		$('#prefecture_id').change(function(){
			$.ajax("{{url('/api/individual_result')}}",
			{
				type: 'get',
				data: { prefecture_id: $(this).val() },
				dataType: 'text'
			})
			.done(function(data) {
				$('#keyword_school > option').each(function(){
					$(this).empty();
				});
				var option = '';
				$.each($.parseJSON(data), function(idx, obj) {
					option += '<option value="' + obj.school_code + '">' + obj.school_name + '</option>';
				});
				//新しいoptionを追加
				$('#keyword_school').html(option);
			})
			.fail(function() {
			window.alert('正しい結果を得られませんでした。');
			});
		});
	</script>
</body>
@endsection
