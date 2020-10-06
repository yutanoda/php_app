@extends('common.layout')

@section('title')
全体報告書
@endsection

@section('content')
<!-- 全社報告書 -->
<body class="search hy">
	<input type="checkbox" id="keyword_switch">
	@include('common_header')
	<main>
			{{  var_dump(explode(",", session('keywords')) ) }}

		<div>
			<section id="search">
				<form name="search" action="{{url('/inclusion_result')}}" method="GET">
					<label><span class="color_t1n color_b1n">■年月</span><input type="month" name="keyword_date" id="keyword_date" @if(session('keyword_date')) value="{{ session('keyword_date') }}" @endif></label>
					<label><span class="color_t1n color_b1n">▼タイトル</span>
						<select name="keyword_title" id="keyword_title">
							<option value="">-未選択-</option>
							@foreach($title_commons as $title_common)
							<option value="{{ $title_common->common_number }}"
								@if( session('keyword_title') && $title_common->common_number == session('keyword_title') )
								selected
								@endif
								>
								{{ $title_common->value1}}
							</option>
							@endforeach
						</select>
					</label>
					<label><span class="color_t1n color_b1n">▼営業所</span>
						<select name="keyword_branch" id="keyword_branch">
							<option value="">-未選択-</option>
							@foreach($branch_commons as $branch_common)
							<option value="{{ $branch_common->branch_code}}"
								@if( session('keyword_branch') && $branch_common->branch_code == session('keyword_branch') )
								selected
								@endif>{{ $branch_common->branch_name}}</option>
							@endforeach
						</select>
					</label>
					<label><span class="color_t1n color_b1n">▼提出者</span>
						<select name="keyword_submitter" id="keyword_submitter">
							<option value="">-未選択-</option>
							@foreach($submitter_commons as $submitter_common)
							<option value="{{ $submitter_common->staff_code}}"
								@if( session('keyword_submitter') && $submitter_common->staff_code == session('keyword_submitter') )
								selected
								@endif
								>{{ $submitter_common->staff_name}}</option>
							@endforeach
						</select>
					</label>
					<label><span class="color_t1n color_b1n">▼都道府県</span>
						<select name="keyword_prefecture" id="prefecture_id">
							<option value="">-未選択-</option>
							@foreach($prefecture_commons as $prefecture_common)
							<option value="{{ $prefecture_common->prefecture_code}}"
								@if( session('keyword_prefecture') && $prefecture_common->prefecture_code == session('keyword_prefecture') )
								selected
								@endif
								>{{ $prefecture_common->prefecture_name}}</option>
							@endforeach
						</select>
					</label>
					<label><span class="color_t1n color_b1n">▼学校名</span>
						<select name="keyword_school" id="keyword_school">
							<option value="">-未選択-</option>
							@foreach($school_commons as $school_common)
							<option class="{{ $school_common->prefecture_code}}" value="{{ $school_common->school_code}}"
								@if( session('keyword_school') && $school_common->school_code == session('keyword_school') )
								selected
								@endif
								>{{ $school_common->school_name}}</option>
							@endforeach
						</select>
					</label>
					<label><span class="color_t1n color_b1n">▼ランク</span>
						<select name="keyword_rank" id="keyword_rank">
							<option value="">-未選択-</option>
							<option value="A" @if( session('keyword_rank') && "A" == session('keyword_rank') ) selected @endif >A</option>
							<option value="B" @if( session('keyword_rank') && "B" == session('keyword_rank') ) selected @endif >B</option>
							<option value="C" @if( session('keyword_rank') && "C" == session('keyword_rank') ) selected @endif >C</option>
							<option value="D" @if( session('keyword_rank') && "D" == session('keyword_rank') ) selected @endif >D</option>
							<option value="E" @if( session('keyword_rank') && "E" == session('keyword_rank') ) selected @endif >E</option>
							<option value="F" @if( session('keyword_rank') && "F" == session('keyword_rank') ) selected @endif >F</option>
							<option value="J" @if( session('keyword_rank') && "J" == session('keyword_rank') ) selected @endif >J</option>
						</select>
					</label>
					<label><span class="color_t1n color_b1n">▼分類</span>
						<select name="keyword_category" id="keyword_category">
							<option value="">-未選択-</option>
							@foreach($category_commons as $category_common)
							<option value="{{ $category_common->common_number }}"
								@if( session('keyword_category') && $category_common->common_number == session('keyword_category') )
								selected
								@endif
								>{{ $category_common->value1}}</option>
							@endforeach
						</select>
					</label>
					<label class="keyword" for="keyword_switch"><span class="color_t1n color_b1n">■キーワード</span><input type="text" id="keywords" readonly="readonly"  @if(session('keywords')) value="{{ session('keywords') }}" @endif ></label>
					<div class="buttons">
						<button type="submit" class="color_t1n color_b1n" id="reset"><span>リセット</span></button>
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
									<li>
										<label>
										<input 
											type="checkbox" 
											name="keywords[]" 
											value="{{ $v['value2'] }}"
											data-text="{{ $v['value2'] }}"
											@if (session('keywords'))
												@if (in_array($v['value2'], explode(",", session('keywords')), true) )
													checked="checked" 
												@endif 
											@endif
										><strong>{{ $v['value2'] }}</strong>
										</label>
									</li>
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
				<!-- <input type="checkbox" id="tablerow1_switch" class="tablerow_switch"><input type="checkbox" id="tablerow2_switch" class="tablerow_switch"><input type="checkbox" id="tablerow3_switch" class="tablerow_switch"><input type="checkbox" id="tablerow4_switch" class="tablerow_switch"><input type="checkbox" id="tablerow5_switch" class="tablerow_switch"><input type="checkbox" id="tablerow6_switch" class="tablerow_switch"><input type="checkbox" id="tablerow7_switch" class="tablerow_switch"><input type="checkbox" id="tablerow8_switch" class="tablerow_switch"><input type="checkbox" id="tablerow9_switch" class="tablerow_switch"><input type="checkbox" id="tablerow10_switch" class="tablerow_switch"> -->
				<article class="table">
					<ul class="thead color_t2 color_b2">
						<li class="no">No.</li>
						<li class="date">提出日</li>
						<li class="user">提出者</li>
						<li class="branch">営業所</li>
						<li class="content">内容</li>
						<li class="comment">コメント</li>
						<li class="controller"></li>
					</ul>
						@if($message)
						<ul class="tbody">
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li>{{$message}}</li>
						<li></li>
						<li></li>
						</ul>
						@else
						@foreach ($reports as $report)
						<input type="checkbox" id="tablerow{{$loop->iteration}}_switch" class="tablerow_switch">
						<ul class="tbody" style="height: 83px;">
							<li class="no" data-th="No.">{{ sprintf('%05d', $report->report_number) }}<a href="{{ url('detail_report', $report->report_number) }}" class="color_t1n color_b1n">詳細</a></li>							
							<li class="date" data-th="提出日：">{{ $report->submitted_datetime->format('Y/m/d') }}</li>
								<li class="user" data-th="提出者：">{{$report->tstaff->staff_name}}</li>
								<li class="branch" data-th="営業所：">{{$report->tbranch->branch_name}}</li>
								<li class="content">
									<article>
										@foreach($report_title as $key => $title)
										@if ( $key == $report->report_number )
											@if($title['1report'] !== NULL)
												<h1 class="title">{{ $title['1report_title'] }}</h1>
												<p>{{ $title['1report'] }}</p>
											@elseif($title['2report'] !== NULL)
												<h1 class="title">{{ $title['2report_title'] }}</h1>
												<p>{{ $title['2report'] }}</p>
											@endif
										@endif
									@endforeach
									</article>
								</li>
								<li class="comment">
									<article>
										<p>
											@foreach($report_title as $key => $title)
												@if ( $key == $report->report_number )
												{{ $title['comment'] }}
												@endif
											@endforeach
										</p>
									</article>
								</li>
								<li class="controller"><label for="tablerow{{$loop->iteration}}_switch"></label></li>
							</ul>
						@endforeach
						@endif
					</tbody>
				</table>
			</section>
		</div>
		
		<nav id="pagination">
			<ul class="page-numbers">
				{{ $reports->links('vendor.pagination.semantic-ui') }}
			</ul>
			<section class="page-fraction">
				<p>@if (isset($_GET["page"]))　{{ htmlspecialchars($_GET["page"]) }} @else 1 @endif /{{ $max_page_num }}</p>
			</section>
		</nav>


	</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript">

		// 都道府県が未選択で学校検索をクリックした場合、都道府県を選択するようメッセージ表示
		/*$('#keyword_school').click(function(){
			var prefecture = $('#prefecture_id').val();
			if ( prefecture == '' ) {
				alert('都道府県から選択してください。');
			}
		});
		*/
		// 第一学習社HSの削除
			$('#result > article > ul > li.content > article > h1').each(function(){
				var hs = $(this).text();
				if ( hs.indexOf('第一学習社HS') != -1) {
					var replace_str = hs.replace('第一学習社HS', '');
					 $(this).text(replace_str);
				}
			});

		// 検索用Ajax
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
				var option = '<option value="">-未選択-</option>';
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


		let reset = document.getElementById('reset');

		let keyword_date = document.getElementById('keyword_date');
		let keyword_title = document.getElementById('keyword_title');
		let keyword_branch = document.getElementById('keyword_branch');
		let keyword_submitter = document.getElementById('keyword_submitter');
		let prefecture_id = document.getElementById('prefecture_id');
		let keyword_school = document.getElementById('keyword_school');
		let keyword_rank = document.getElementById('keyword_rank');
		let keyword_category = document.getElementById('keyword_category');
		let keywords = document.getElementById('keywords');

		reset.addEventListener('click', function() {
			keyword_date.value = "";
			keyword_title.value = "";
			keyword_branch.value = "";
			keyword_submitter.value = "";
			prefecture_id.value = "";
			keyword_school.value = "";
			keyword_rank.value = "";
			keyword_category.value = "";
			keywords = "";
		});
	</script>
</body>
@endsection
