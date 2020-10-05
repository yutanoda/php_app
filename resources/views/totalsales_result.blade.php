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
				<label><span class="color_t1n color_b1n">■集計期間</span><input type="date" name="start_date" id="start_date"></label>
				<label><span class="color_t1n color_b1n">〜</span><input type="date" name="end_date" id="end_date"></label>
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
						<dd class="report"><a href="#" class="color_t1">{{ $staff->treports_count }}</a></dd>
						<dt class="proposal">依頼書数</dt>
						<dd class="proposal"><a href="#" class="color_t1">{{ $staff->tproposals_count }}</a></dd>
						<dt class="school">営業校数</dt>
            <dd class="school">{{ $staff->treportdetails_count }}</dd>
          </dl>
          @endforeach
				</article>
			</section>
		</div>
	</main>
<script type="text/javascript">

</script>
</body>
@endsection

