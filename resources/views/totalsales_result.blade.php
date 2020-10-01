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
				<label><span class="color_t1n color_b1n">■集計期間</span><input type="date" @if(session('start_date')) value="{{ session('start_date') }}" @endif name="start_date" id="start_date"></label>
				<label><span class="color_t1n color_b1n">〜</span><input type="date" @if(session('end_date')) value="{{ session('end_date') }}" @endif name="end_date" id="end_date"></label>
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
          <input type="checkbox" id= {{ "switch_staff" . $loop->index }} class="staff_switch"><!-- ←id Countup -->
					<dl class="tbody">
						<dt class= "branch color_t2 color_b2">営業所</dt>
            <dd class="branch color_t2 color_b2">{{ $staff->tbranch->branch_name }}</dd>
            <dt class="staff color_t2 color_b2">担当者名</dt>
            <dd class="staff color_t2 color_b2"><label class="staffname" for= "switch_staff{{ $loop->index }}"><strong>{{ $staff->staff_name }}</strong><span class="staffinfo"><a href="tel:{{ $staff->mobile_phone_number }}" class="tel">{{ $staff->mobile_phone_number }}</a><a href="mailto:{{ $staff->mobile_email }}" class="mail">{{ $staff->mobile_email }}</a><a href="mailto:{{ $staff->pc_email }}" class="mail">{{ $staff->pc_email }}</a><a href="mailto:{{ $staff->tablet_email }}" class="mail">{{ $staff->tablet_email }}</a></span><span class="closer"></span></label></dd>
            <div class="controller color_t2 color_b2"><label for="switch_staff1"><!-- ←for Countup --></label></div>
            <dt class="report">報告書数</dt>
            <dd class="report"><a href="#" class="color_t1">{{ $t_report_sum[$staff->staff_code] }}</a></dd>
            <dt class="proposal">依頼書数</dt>
            <dd class="proposal"><a href="#" class="color_t1">{{ $t_proposal_sum[$staff->staff_code] }}</a></dd>
            <dt class="school">営業校数</dt>
            <dd class="school">{{ $t_report_detail_sum[$staff->staff_code] }}</dd>
            <dt class="new">新規数</dt>
            <dd class="new">{{ $t_report_detail_new_sum[$staff->staff_code] }}</dd>
            <dt class="continue">継続数</dt>
            <dd class="continue">{{ $t_report_detail_existing_sum[$staff->staff_code] }}</dd>
            <dt class="type">入校</dt>
						<dd class="type">{{ $t_report_detail_meeting_sum[$staff->staff_code] }}</dd>
						<dt class="type">事務</dt>
						<dd class="type">{{ $t_report_detail_office_sum[$staff->staff_code] }}</dd>
						<dt class="type">アポ</dt>
						<dd class="type">{{ $t_report_detail_appointment_sum[$staff->staff_code] }}</dd>
						<dt class="type">電話</dt>
						<dd class="type">{{ $t_report_detail_tel_sum[$staff->staff_code] }}</dd>
						<dt class="type">ﾒｰﾙ</dt>
						<dd class="type">{{ $t_report_detail_mail_sum[$staff->staff_code] }}</dd>

						@for ($i = 0; $i < 12; $i++) 
							<dt class="week">週{{ $i + 1}}校数</dt>
							<dd class="week">
							@if (isset($t_report_detail_week_sum[$staff->staff_code][$i + 1]))
								{{ $t_report_detail_week_sum[$staff->staff_code][$i + 1] }} 
							@endif
							</dd>
						@endfor
          </dl>
          @endforeach
				</article>
			</section>
		</div>
	</main>
<script type="text/javascript">

	let reset = document.getElementById('reset');
	let start_date = document.getElementById('start_date');
	let end_date = document.getElementById('end_date');


	reset.addEventListener('click', function() {
		start_date.value = "";
		end_date.value = "";
	});
</script>
</body>
@endsection

