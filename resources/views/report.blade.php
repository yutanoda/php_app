@extends('common.layout')

@section('title')
@if ($control == 1)
	全社報告書
@else
	個別報告書
@endif
@endsection

@section('content')
<body class="report hy">
	@include('common_header')
	<main>
		<div id="submission">
			<h1 class="color_t1">営業報告書</h1>
			<section>
				<article>
					<dl>
						<dt>報告No.</dt>
						<dd>{{ $report_number }}</dd>
					</dl>
					<dl>
						<dt>提出者：</dt>
						@if($t_staff)
						<dd>{{ $t_staff->staff_name }}</dd>
						@else
						<dd>{{ $staff_name }}</dd>
						@endif
					</dl>
					<dl>
						<dt>提出日：</dt>
						@if ( $t_report->status_flag >= 1 )
							@if ($t_report->submitted_datetime == null)
							<dd class="unsubmit">未提出</dd>
							@else
							<dd>{{ $t_report->submitted_datetime }}</dd>
							@endif
						@else
							<dd class="unsubmit">未提出</dd>
						@endif
					</dl>
				</article>
				@if ( $control == 2 )
				<form action="{{ url('report_register') }}" method="post">
					@csrf
					<input type="hidden" name="request_id" value="{{ $report_number }}">
					@if( $t_report->status_flag < 1 )
					<button type="submit" class="color_t1n color_b1n op" onclick="post_t_report()" name="register" value="register"><span>提出</span></button>
					<button type="submit" class="color_t1n color_b1n op" onclick="return confirm('報告書を削除しますか？　明細も全て削除されます。')" name="register" value="delete"><span>削除</span></button>
					<button type="submit" class="color_t1n color_b1n op" onclick="return confirm('報告書を追加しますか？　追加後は報告内容を入力し、更新してください。')" name="register" value="add"><span>追加</span></button>
					@endif
				</form>
				@endif
			</section>
			@if ( $control == 1 )
				<a href="{{ url('inclusion_result') }}" class="color_t1n color_b1n op">戻る</a>
			@else 
				<a href="{{ url('individual_result') }}" class="color_t1n color_b1n op">戻る</a>
			@endif
		</div>
		<div id="report">
			<section>
				@foreach ($t_report_detail as $report_detail)
				<form action="{{ url('report_register') }}" method="post">
					@csrf
					<input type="hidden" name="request_id" value="{{ $report_number }}">
					<input type="hidden" name="detail_id" value="{{ $report_detail->detail_number }}" class="detail_id">
					<table class="achievement">
						<caption class="color_t2 color_b2">
							<dl>
								<dt>{{ $report_detail->detail_number }}.</dt>
							</dl>
							<dl>
								<dt>営業日</dt>
								<dd>
									<input type="date" name="action_date" value="{{ $report_detail->action_date }}" @if ( $t_report->status_flag >= 1 ) onfocus="this.blur()" @endif>
								</dd>
							</dl>
							<dl>
								<dt>種別</dt>
								<dd>
									<select name="action_type" @if ( $t_report->status_flag >= 1 ) style="pointer-events: none;" tabindex="-1" @endif>
										@foreach ( $action_type as $action )
										<option value="{{ $action->common_number }}" @if ( $report_detail->action_type == $action->common_number) selected @endif >{{ $action->value1 }}</option>
										@endforeach
									</select>
								</dd>
							</dl>
							<dl class="school">
								<dt>営業校</dt>
								<dd>
									<select name="school_code" @if ( $t_report->status_flag >= 1 ) style="pointer-events: none;" tabindex="-1" @endif>
										<option value="">-未選択-</option>
										@foreach ( $schools as $school )
										<option value="{{ $school->school_code }}" 
											@if($report_detail->school_code == $school->school_code)
											selected
											@endif
											>{{ $school->school_name }}</option>
										@endforeach
									</select>
									{{ $report_detail->prefecture_name }}{{ $report_detail->address }}
								</dd>
							</dl>
							<dl>
								<dt>人数</dt>
								<dd>{{ $report_detail->number_of_students }}</dd>
							</dl>
							<dl>
								<dt>ランク</dt>
								@foreach ($school_rank as $index => $rank)
									@if ( $report_detail->detail_number == $index )
											<dd>{{ $rank['value1'] }}</dd>
									@endif
								@endforeach
							</dl>
							<dl>
								<dt>実績</dt>
								<dd>
									@foreach ($sum as $sum_index => $total)
										@if ( $report_detail->detail_number == $sum_index )
											{{  number_format($total, 0) }}
										@endif
								@endforeach
								</dd>
							</dl>
						</caption>
						<thead>
							<tr>
								<th class="date">実績日付</th>
								<th class="product">商品</th>
								<th class="quantity">数量</th>
								<th class="grade">学年</th>
								<th class="total">金額</th>
							</tr>
						</thead>
						<tbody>
							@if ( $performance[$report_detail->detail_number] )
							@foreach ( $performance[$report_detail->detail_number] as $p )
							<tr>
								<td class="date">{{ $p->sale_date }}</td>
								<td class="product">{{ $p->item_name }}</td>
								<td class="quantity">{{ $p->sale_quantity }}</td>
								<td class="grade">{{ $p->grade }}</td>
								<td class="total">{{ number_format($p->sales_amount, 0) }}</td>
							</tr>
							@endforeach
							@endif
						</tbody>
					</table>
					<h1>
						@if ( $control == 2 && $t_report->status_flag < 1)
						<span class="buttons">
							<button type="submit" class="color_t1n color_b1n delete" name="register" value="detail_delete" onclick="return confirm('営業校を削除しますか？　この報告内容のみ削除されます。')">削除</button>	
							@if( $t_report->status_flag < 1 )
							<button type="submit" class="color_t1n color_b1n update" onclick="return confirm('この報告書を更新しますか？')" name="register" value="detail_update">更新</button>
							@endif
						</span>
						{{-- @elseif( $control == 1 && $authority_flag == '1') $t_staff->staff_type? --}}
						@elseif( $staff_type >= 3)
						<span class="buttons">
<!-- 							<button type="submit" class="color_t1n color_b1n delete" name="register" value="detail_delete" onclick="return confirm('営業校を削除しますか？　この報告内容のみ削除されます。')">削除</button>	 -->
							<button type="submit" class="color_t1n color_b1n update" onclick="return confirm('この報告書を更新しますか？')" name="register" value="detail_update">更新</button>
						</span>
						@endif
					<label><span>面談者：</span><input name="note" type="text" @if ($report_detail->note !== NULL) value="{{ $report_detail->note }}" @endif id="input" @if ($t_report->status_flag >= 1) readonly="" @endif></label></h1>
					<input type="hidden" name="control" value= {{ $control }}>
					<input type="checkbox" id="journal1_switch" class="journal_switch" checked="checked">
					<article class="journal">
						<section class="employee">
							<div>
								<h1>新規採択活動</h1>
								<textarea name="report1"  @if ($t_report->status_flag >= 1) readonly="" @endif>{{ $report_detail->report1 }}</textarea>
							</div>
							<div>
								<h1>継続採択活動その他</h1>
								<textarea name="report2"  @if ($t_report->status_flag >= 1) readonly="" @endif>{{ $report_detail->report2 }}</textarea>
							</div>	
						</section>
						<section class="manager">
							<h1>コメント</h1>
							{{-- @if ( $authority_flag >= 3 ) --}}
							@if ( $staff_type >= 3 )
							<textarea name="comment" >{{ $report_detail->comment }}</textarea>
							<label><span class="color_t1n color_b1n">▼分類</span>
								<select name="category">
									<option value="">-未選択-</option>
									@foreach ( $report_category as $category ) 
									<option value="{{$category->common_number}}" @if($report_detail->report_category == $category->common_number) selected @endif>{{ $category->value1 }}</option>
									@endforeach
								</select>
							</label>
							@else
							<textarea name="comment" readonly=""="">{{ $report_detail->comment }}</textarea>
							<label><span class="color_t1n color_b1n">▼分類</span>
								<select name="category" style="pointer-events: none;" tabindex="-1">
									@foreach ( $report_category as $category ) 
									@if($report_detail->report_category == $category->common_number)
									<option value="{{$category->common_number}}" selected>{{ $category->value1 }}</option>
									@endif
									@endforeach
								</select>
							</label>
							@endif
						</section>
					</article>
				</form>
				@endforeach
			</section>
		</div>
		<div id="summary">
			<section>
				<form action="{{ url('report_register') }}" method="post">
					@csrf
					<input type="hidden" name="request_id" value="{{ $report_number }}">
					<h1>
						@if( $t_report->status_flag < 1 ) 
						<span class="buttons">
							<button type="submit" class="color_t1n color_b1n update" name="register" value="update_footer">更新</button>
						</span>
						@elseif( $staff_type >= 3 )
						<span class="buttons">
							<button type="submit" class="color_t1n color_b1n update" name="register" value="update_footer">更新</button>
						</span>
						@endif
					</h1>
					<input type="checkbox" id="journalsummary_switch" class="journal_switch" checked="checked">
					<article class="journal">
						<section class="employee">
							<div>
								<h1>営業活動の気づき</h1>
								<textarea name="total_evaluation" @if ($t_report->status_flag >= 1) readonly="" @endif>{{ $t_report->total_evaluation }}</textarea>
							</div>
							<div>
								<h1>来週の活動POINT</h1>
								<textarea name="next_action" @if ($t_report->status_flag >= 1) readonly="" @endif>{{ $t_report->next_action }}</textarea>
							</div>	
						</section>
						<section class="manager">
							<h1>コメント</h1>
							@if ( $staff_type >= 3 )
							<textarea name="comment" >{{ $t_report->comment }}</textarea>
							<label><span class="color_t1n color_b1n">▼分類</span>
								<select name="report_category">
									<option value="">-未選択-</option>
									@foreach ( $footer_report_category as $category ) 
									<option value="{{$category->common_number}}" @if($t_report->report_category == $category->common_number) selected @endif>{{ $category->value1 }}</option>
									@endforeach
								</select>
							</label>
							@else
							<textarea name="comment" readonly="">{{ $t_report->comment }}</textarea>
							<label><span class="color_t1n color_b1n">▼分類</span>
								<select name="report_category" style="pointer-events: none;" tabindex="-1">
									<option value="">-未選択-</option>
									@foreach ( $footer_report_category as $category ) 
									<option value="{{$category->common_number}}" @if($t_report->report_category == $category->common_number) selected @endif>{{ $category->value1 }}</option>
									@endforeach
								</select>
							</label>
							@endif
						</section>
					</article>
				</form>
			</section>
		</div>
	</main>
	<footer>
		<div id="totop"></div>
	</footer>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="{{ asset('js/jquery.autoexpand.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.textarea-auto-height.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.autosize.input.js') }}"></script>
	<script type="text/javascript">
		$('#report > section > form > h1 > span > button.color_t1n.color_b1n.update').click(function ($this) {
			var date = $(this).parent('.buttons').parent('h1').prev('.achievement').find('input[type=date]').val();
			var action_type = $(this).parent('.buttons').parent('h1').prev('.achievement').find('dl:nth-child(3) > dd > select').val();
			var school_code = $(this).parent('.buttons').parent('h1').prev('.achievement').find('dl:nth-child(4) > dd > select').val();
			if (!date || !action_type || !school_code) {
				alert('営業日・種別・営業校が正しいか確認してください。');
				return false;
			}
		});


		// 明細情報が一切ないときには提出させない
		var post_t_report = function post_t_report(){
			console.log('clock');
			id = [];
			$(function(){
				$('.detail_id').each(function(){
					id.push($(this).val());
				});
				if (id.length !== 0) {
					return confirm('報告書を提出しますか？　提出後は変更できません。');
				} else {
					return confirm('報告内容が登録されていないため、提出できません。');
				}
			});
		}


		$('textarea').each(function(){
			$(this).autoExpand();
		});
		$(function() {
		    $('textarea').textareaAutoHeight();
		    $('input[name=note]').each(function(){
		    	$(this).css({'width': '27em'});
		    });
		    $('input[name=note]').autosizeInput();
		});

	</script>
</body>
@endsection