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
				<form>
					<label><span class="color_t1n color_b1n">■集計期間</span><input type="date" value="2020-09-01"></label>
					<label><span class="color_t1n color_b1n">〜</span><input type="date" value="2020-11-23"></label>
					<div class="buttons">
						<button type="reset" class="color_t1n color_b1n"><span>リセット</span></button>
						<a href="totalsales_result.html" class="search color_t1n color_b1n"><!--button type="submit" class="search color_t1n color_b1n"--><span>検索</span><!--/button--></a>
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
          </dl>
          @endforeach
					<!-- ↓↓Loop↓↓ -->
					<input type="checkbox" id="switch_staff1" class="staff_switch"><!-- ←id Countup -->
					<dl class="tbody">
						<dt class= "branch color_t2 color_b2">営業所</dt>
						<dd class="branch color_t2 color_b2">札幌</dd>
						<dt class="staff color_t2 color_b2">担当者名</dt>
						<dd class="staff color_t2 color_b2"><label class="staffname" for="switch_staff1"><!-- ←for Countup --><strong>赤沼千晶</strong><span class="staffinfo"><a href="tel:000-0000-0000" class="tel">000-0000-0000</a><a href="mailto:test@test.test" class="mail">test@test.test</a><a href="mailto:sample@sample.sample" class="mail">sample@sample.sample</a><a href="mailto:dummy@dummy.dummy" class="mail">dummy@dummy.dummy</a></span><span class="closer"></span></label></dd>
						<dt class="report">報告書数</dt>
						<dd class="report"><a href="#" class="color_t1">888</a></dd>
						<dt class="proposal">依頼書数</dt>
						<dd class="proposal"><a href="#" class="color_t1">888</a></dd>
						<dt class="school">営業校数</dt>
						<dd class="school">888</dd>
						<dt class="new">新規数</dt>
						<dd class="new">888</dd>
						<dt class="continue">継続数</dt>
						<dd class="continue">888</dd>
						<dt class="type">入校</dt>
						<dd class="type">888</dd>
						<dt class="type">事務</dt>
						<dd class="type">888</dd>
						<dt class="type">アポ</dt>
						<dd class="type">888</dd>
						<dt class="type">電話</dt>
						<dd class="type">888</dd>
						<dt class="type">ﾒｰﾙ</dt>
						<dd class="type">888</dd>
						<dt class="week">週1校数</dt>
						<dd class="week">20</dd>
						<dt class="week">週2校数</dt>
						<dd class="week">12</dd>
						<dt class="week">週3校数</dt>
						<dd class="week">19</dd>
						<dt class="week">週4校数</dt>
						<dd class="week">23</dd>
						<dt class="week">週5校数</dt>
						<dd class="week">15</dd>
						<dt class="week">週6校数</dt>
						<dd class="week">16</dd>
						<dt class="week">週7校数</dt>
						<dd class="week">13</dd>
						<dt class="week">週8校数</dt>
						<dd class="week">16</dd>
						<dt class="week">週9校数</dt>
						<dd class="week">17</dd>
						<dt class="week">週10校数</dt>
						<dd class="week">18</dd>
						<dt class="week">週11校数</dt>
						<dd class="week">23</dd>
						<dt class="week">週12校数</dt>
						<dd class="week">15</dd>
						<div class="controller color_t2 color_b2"><label for="switch_staff1"><!-- ←for Countup --></label></div>
					</dl>
					<!-- ↑↑Loop↑↑ -->
					<input type="checkbox" id="switch_staff2" class="staff_switch">
					<dl class="tbody">
						<dt class= "branch color_t2 color_b2">営業所</dt>
						<dd class="branch color_t2 color_b2">仙台</dd>
						<dt class="staff color_t2 color_b2">担当者名</dt>
						<dd class="staff color_t2 color_b2"><label class="staffname" for="switch_staff2"><strong>佐藤紀子</strong><span class="staffinfo"><a href="tel:000-0000-0000" class="tel">000-0000-0000</a><a href="mailto:test@test.test" class="mail">test@test.test</a><a href="mailto:sample@sample.sample" class="mail">sample@sample.sample</a><a href="mailto:dummy@dummy.dummy" class="mail">dummy@dummy.dummy</a></span><span class="closer"></span></label></dd>
						<dt class="report">報告書数</dt>
						<dd class="report"><a href="#" class="color_t1">4</a></dd>
						<dt class="proposal">依頼書数</dt>
						<dd class="proposal">0</dd>
						<dt class="school">営業校数</dt>
						<dd class="school">55</dd>
						<dt class="new">新規数</dt>
						<dd class="new">33</dd>
						<dt class="continue">継続数</dt>
						<dd class="continue">888</dd>
						<dt class="type">入校</dt>
						<dd class="type">888</dd>
						<dt class="type">事務</dt>
						<dd class="type">888</dd>
						<dt class="type">アポ</dt>
						<dd class="type">888</dd>
						<dt class="type">電話</dt>
						<dd class="type">888</dd>
						<dt class="type">ﾒｰﾙ</dt>
						<dd class="type">888</dd>
						<dt class="week">週1校数</dt>
						<dd class="week">13</dd>
						<dt class="week">週2校数</dt>
						<dd class="week">15</dd>
						<dt class="week">週3校数</dt>
						<dd class="week">10</dd>
						<dt class="week">週4校数</dt>
						<dd class="week">17</dd>
						<dt class="week">週5校数</dt>
						<dd class="week">12</dd>
						<dt class="week">週6校数</dt>
						<dd class="week">11</dd>
						<dt class="week">週7校数</dt>
						<dd class="week">15</dd>
						<dt class="week">週8校数</dt>
						<dd class="week">8</dd>
						<dt class="week">週9校数</dt>
						<dd class="week">12</dd>
						<dt class="week">週10校数</dt>
						<dd class="week">21</dd>
						<dt class="week">週11校数</dt>
						<dd class="week">13</dd>
						<dt class="week">週12校数</dt>
						<dd class="week">13</dd>
						<div class="controller color_t2 color_b2"><label for="switch_staff2"></label></div>
					</dl>
					<input type="checkbox" id="switch_staff3" class="staff_switch">
					<dl class="tbody">
						<dt class= "branch color_t2 color_b2">営業所</dt>
						<dd class="branch color_t2 color_b2">新潟</dd>
						<dt class="staff color_t2 color_b2">担当者名</dt>
						<dd class="staff color_t2 color_b2"><label class="staffname" for="switch_staff3"><strong>工藤みどり</strong><span class="staffinfo"><a href="tel:000-0000-0000" class="tel">000-0000-0000</a><a href="mailto:test@test.test" class="mail">test@test.test</a><a href="mailto:sample@sample.sample" class="mail">sample@sample.sample</a><a href="mailto:dummy@dummy.dummy" class="mail">dummy@dummy.dummy</a></span><span class="closer"></span></label></dd>
						<dt class="report">報告書数</dt>
						<dd class="report"><a href="#" class="color_t1">4</a></dd>
						<dt class="proposal">依頼書数</dt>
						<dd class="proposal"><a href="#" class="color_t1">1</a></dd>
						<dt class="school">営業校数</dt>
						<dd class="school">74</dd>
						<dt class="new">新規数</dt>
						<dd class="new">29</dd>
						<dt class="continue">継続数</dt>
						<dd class="continue">888</dd>
						<dt class="type">入校</dt>
						<dd class="type">888</dd>
						<dt class="type">事務</dt>
						<dd class="type">888</dd>
						<dt class="type">アポ</dt>
						<dd class="type">888</dd>
						<dt class="type">電話</dt>
						<dd class="type">888</dd>
						<dt class="type">ﾒｰﾙ</dt>
						<dd class="type">888</dd>
						<dt class="week">週1校数</dt>
						<dd class="week">20</dd>
						<dt class="week">週2校数</dt>
						<dd class="week">12</dd>
						<dt class="week">週3校数</dt>
						<dd class="week">19</dd>
						<dt class="week">週4校数</dt>
						<dd class="week">23</dd>
						<dt class="week">週5校数</dt>
						<dd class="week">15</dd>
						<dt class="week">週6校数</dt>
						<dd class="week">16</dd>
						<dt class="week">週7校数</dt>
						<dd class="week">13</dd>
						<dt class="week">週8校数</dt>
						<dd class="week">16</dd>
						<dt class="week">週9校数</dt>
						<dd class="week">17</dd>
						<dt class="week">週10校数</dt>
						<dd class="week">18</dd>
						<dt class="week">週11校数</dt>
						<dd class="week">23</dd>
						<dt class="week">週12校数</dt>
						<dd class="week">15</dd>
						<div class="controller color_t2 color_b2"><label for="switch_staff3"></label></div>
					</dl>
				</article>
			</section>
		</div>
	</main>
</body>
@endsection

