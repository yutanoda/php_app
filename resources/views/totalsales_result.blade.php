@extends('common.layout')

@section('title')
営業集計
@endsection

@section('content')
<body class="sales hy">
  <input type="checkbox" id="keyword_switch">
	@include('common_header')
	<main>

		<div>
			<section id="search">
			<form action="{{url('sales_total')}}" method="GET" name="search">
				<label><span class="color_t1n color_b1n">■集計期間</span><input type="date" value= @if(session('start_date')) "{{ session('start_date') }}" @else {{ mb_substr($start_date, 0, 10) }} @endif name="start_date" id="start_date"></label>
        <label><span class="color_t1n color_b1n">〜</span><input type="date" value= @if(session('end_date')) "{{ session('end_date') }}" @else {{ mb_substr($end_date, 0, 10) }} @endif name="end_date" id="end_date"></label>
				<div class="buttons">
					<button type="submit" class="color_t1n color_b1n" id="reset"><span>リセット</span></button>
					<button type="submit" class="search color_t1n color_b1n"><span>検索</span></button>
				</div>
			</form>
			</section>
			<section id="result">
				<article class="table">
					<dl class="thead color_t2 color_b2">
						<dt class="branch color_t2 color_b2">営業所</dt>
						<dt class="staff color_t2 color_b2">担当者名</dt>
						<dt class="report">報告書数</dt>
						<dt class="proposal">要望書数</dt>
						<dt class="school">営業校数</dt>
						<dt class="new">新規数</dt>
						<dt class="continue">継続数</dt>
						<dt class="type">入校</dt>
						<dt class="type">事務</dt>
						<dt class="type">アポ</dt>
						<dt class="type">預け</dt>
						<dt class="type">電話</dt>
						<dt class="type">ﾒｰﾙ</dt>
						<dt class="week">週1校数</dt>
						<dt class="week">週2校数</dt>
						<dt class="week">週3校数</dt>
						<dt class="week">週4校数</dt>
						<dt class="week">週5校数</dt>
						<dt class="week">週6校数</dt>
						<dt class="week">週7校数</dt>
						<dt class="week">週8校数</dt>
						<dt class="week">週9校数</dt>
						<dt class="week">週10校数</dt>
						<dt class="week">週11校数</dt>
						<dt class="week">週12校数</dt>
          </dl>
          @foreach($staffs as $staff)
          <input type="checkbox" id= {{ "switch_staff" . ($loop->index + 1) }} class="staff_switch"><!-- ←id Countup -->
					<dl class="tbody">
						<dt class= "branch color_t2 color_b2">営業所</dt>
            <dd class="branch color_t2 color_b2">{{ $staff->tbranch->branch_name }}</dd>
            <dt class="staff color_t2 color_b2">担当者名</dt>
            <dd class="staff color_t2 color_b2"><label class="staffname" for= "switch_staff{{ $loop->index + 1 }}"><strong>{{ $staff->staff_name }}</strong><span class="staffinfo"><a href="tel:{{ $staff->mobile_phone_number }}" class="tel">{{ $staff->mobile_phone_number }}</a><a href="mailto:{{ $staff->mobile_email }}" class="mail">{{ $staff->mobile_email }}</a><a href="mailto:{{ $staff->pc_email }}" class="mail">{{ $staff->pc_email }}</a><a href="mailto:{{ $staff->tablet_email }}" class="mail">{{ $staff->tablet_email }}</a></span><span class="closer"></span></label></dd>
            <div class="controller color_t2 color_b2"><label for="switch_staff1"><!-- ←for Countup --></label></div>
            <dt class="report">報告書数</dt>
						<dd class="report">
							<a href="#" class="color_t1">
							@if (array_key_exists($staff->staff_code, $treport_sum))
								{{ $treport_sum[$staff->staff_code] }}  
							@endif
							</a>
						</dd>
						<dt class="proposal">要望書数</dt>
            <dd class="proposal">
							<a href="#" class="color_t1">
								@if (array_key_exists($staff->staff_code, $tproposal_sum))
								{{ $tproposal_sum[$staff->staff_code] }}  
								@endif
							</a>
						</dd>
						<dt class="school">営業校数</dt>
            <dd class="school">
							@if (array_key_exists($staff->staff_code, $treport_detail_sum))
								{{ $treport_detail_sum[$staff->staff_code] }}  
							@endif
						</dd>
						<dt class="new">新規数</dt>
            <dd class="new">
							@if (array_key_exists($staff->staff_code, $new_sum))
								{{ $new_sum[$staff->staff_code] }}  
							@endif
						</dd>
						<dt class="continue">継続数</dt>
            <dd class="continue">
							@if (array_key_exists($staff->staff_code, $existing_sum))
								{{ $existing_sum[$staff->staff_code] }}  
							@endif
						</dd>
						<dt class="type">入校</dt>
						<dd class="type">
							@if (array_key_exists($staff->staff_code, $meeting_sum))
								{{ $meeting_sum[$staff->staff_code] }}  
							@endif
						</dd>
						<dt class="type">事務</dt>
						<dd class="type">
							@if (array_key_exists($staff->staff_code, $office_sum))
								{{ $office_sum[$staff->staff_code] }}  
							@endif
						</dd>
						<dt class="type">アポ</dt>
						<dd class="type">
							@if (array_key_exists($staff->staff_code, $appointment_sum))
								{{ $appointment_sum[$staff->staff_code] }}  
							@endif
						</dd>
						<dt class="type">預け</dt>
						<dd class="type">
							@if (array_key_exists($staff->staff_code, $depo_sum))
								{{ $depo_sum[$staff->staff_code] }}  
							@endif
						</dd>
						<dt class="type">電話</dt>
						<dd class="type">
							@if (array_key_exists($staff->staff_code, $tel_sum))
								{{ $tel_sum[$staff->staff_code] }}  
							@endif
						</dd>
						<dt class="type">メール</dt>
						<dd class="type">
							@if (array_key_exists($staff->staff_code, $mail_sum))
								{{ $mail_sum[$staff->staff_code] }}  
							@endif
						</dd>
					@for ($i = 0; $i < 12; $i++) 
						<dt class="week">週{{ $i + 1}}校数</dt>
						<dd class="week">
						@if (isset($week_sum[$staff->staff_code][$i + 1]))
							{{ $week_sum[$staff->staff_code][$i + 1] }} 
						@endif
						</dd>
						<div class="controller color_t2 color_b2"><label for= {{ "switch_staff" . ($loop->index + 1) }} ></label></div>
					@endfor
          </dl>
					@endforeach
				</article>
			</section>
		</div>
	</main>
<script type="text/javascript">
	//リセットボタン
	let reset = document.getElementById('reset');
  let start_date = document.getElementById('start_date');
  let end_date = document.getElementById('end_date');

  reset.addEventListener('click', function() {
    start_date.value = "";
    end_date.value = "";
  });

	 //集計期間ボタン

	let maxSpan = {{ $add_day }};

	start_date.addEventListener('change', function() {
		let date1 = new Date(start_date.value);
		let date2 = new Date(end_date.value);
		let diff = ((date2 - date1) / (60 * 60 * 24 * 1000));
		if (start_date.value > end_date.value) {
			let checked = confirm('集計終了日が開始日より小さいです');
			return false;
		} else if (diff > maxSpan) {
			let checked = confirm("集計期間が長すぎます。" +　maxSpan + "日以内に設定して下さい。");
			return false;
		}
	});

	end_date.addEventListener('change', function() {
		let date1 = new Date(start_date.value);
		let date2 = new Date(end_date.value);
		let diff = ((date2 - date1) / (60 * 60 * 24 * 1000));
		if (start_date.value > end_date.value) {
			let checked = confirm('集計終了日が開始日より小さいです');
			return false;
		} else if (diff > maxSpan) {
			let checked = confirm("集計期間が長すぎます。" +　maxSpan + "日以内に設定して下さい。");
			return false;
		}
	});

</script>
</body>
@endsection

