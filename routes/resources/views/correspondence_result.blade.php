@extends('common.layout')
@section('title')
要望・提案書
@endsection
@section('content')
<body class="search">
	<input type="checkbox" id="keyword_switch">
		@include('common_header')
	<main>
		<div>
			<section id="search">
				<form>
					<label><span>■年月</span><input type="month"></label>
					<label><span>▼種別</span>
						<select>
							<option>-未選択-</option>
							<option>ガイダンス</option>
							<option>商品関連</option>
							<option>教育部関連</option>
							<option>物流関連</option>
							<option>業務関連</option>
							<option>その他</option>
						</select>
					</label>
					<label><span>▼分類</span>
						<select>
							<option>-未選択-</option>
							<option>業務関連</option>
							<option>商品・市場に関する情報</option>
							<option>探究への取り組み状況に関する情報</option>
							<option>要検討・対応事項</option>
						</select>
					</label>
					<label><span>▼学校名</span>
						<select>
							<option>-未選択-</option>
							<option>就実高等学校</option>
							<option>明誠学院高等学校</option>
							<option>おかやま山陽高校</option>
							<option>関西高校</option>
							<option>岡山理科大学附属高校</option>
							<option>岡山学芸館高校</option>
							<option>岡山南高校</option>
							<option>岡山朝日高校</option>
							<option>岡山一宮高校</option>
							<option>岡山城東高校</option>
							<option>倉敷翠松高校</option>
							<option>倉敷高校</option>
							<option>岡山工業高校</option>
							<option>岡山東商業高校</option>
							<option>倉敷青陵高校</option>
							<option>倉敷商業高校</option>
							<option>倉敷工業高校</option>
							<option>倉敷中央高校</option>
						</select>
					</label>
					<label class="keyword" for="keyword_switch"><span>■キーワード</span><input type="text" id="keywords" readonly="readonly" value="ガイダンス, 事前アンケート, 一般入試, 打ち合わせ, 文章トレーニングノート"></label>
					<div class="buttons">
						<button type="reset"><span>リセット</span></button>
						<a href="inclusion_result.html" class="search"><!--button type="submit" class="search"--><span>検索</span><!--/button--></a>
					</div>
					<div id="keyword"><article>
						<h1>キーワード選択</h1>
						<dl>
							<dt>ガイダンス関連</dt>
							<dd>
								<ul>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="ガイダンス"><strong>ガイダンス</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="講演会"><strong>講演会</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="大堀"><strong>大堀</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="講評ガイダンス"><strong>講評ガイダンス</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="事前ガイダンス"><strong>事前ガイダンス</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="講師"><strong>講師</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="講師指名"><strong>講師指名</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="申請書"><strong>申請書</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="事前アンケート"><strong>事前アンケート</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="事後アンケート"><strong>事後アンケート</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="レジュメ"><strong>レジュメ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="パワポ"><strong>パワポ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="入試"><strong>入試</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="受験"><strong>受験</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="点数"><strong>点数</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="過去問"><strong>過去問</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="ＡＯ"><strong>ＡＯ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="推薦"><strong>推薦</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="指定校推薦"><strong>指定校推薦</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="一般入試"><strong>一般入試</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="共通テスト"><strong>共通テスト</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="振り返り"><strong>振り返り</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="教育部"><strong>教育部</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="看護"><strong>看護</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="待ち合わせ"><strong>待ち合わせ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="謝礼"><strong>謝礼</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="不評"><strong>不評</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="時間オーバー"><strong>時間オーバー</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="ミス"><strong>ミス</strong></label></li>
								</ul>
							</dd>
							<dt>学年or部署or時期</dt>
							<dd>
								<ul>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="1年"><strong>1年</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="2年"><strong>2年</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="3年"><strong>3年</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="新1年"><strong>新1年</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="新2年"><strong>新2年</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="新3年"><strong>新3年</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="中1"><strong>中1</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="中2"><strong>中2</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="中3"><strong>中3</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="1学期"><strong>1学期</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="2学期"><strong>2学期</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="3学期"><strong>3学期</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="進路"><strong>進路</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="学年主任"><strong>学年主任</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="学年団"><strong>学年団</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="総合学習"><strong>総合学習</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="ＳＳＨ"><strong>ＳＳＨ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="探究"><strong>探究</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="次年度"><strong>次年度</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="新年度"><strong>新年度</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="昨年度"><strong>昨年度</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="ホームルーム"><strong>ホームルーム</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="自学"><strong>自学</strong></label></li>
								</ul>
							</dd>
							<dt>自他社　商品名</dt>
							<dd>
								<ul>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="トレ"><strong>トレ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="特化トレ"><strong>特化トレ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="プレトレ"><strong>プレトレ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="作表トレ"><strong>作表トレ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="模試"><strong>模試</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="志望理由書"><strong>志望理由書</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="探究パック"><strong>探究パック</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="要約添削"><strong>要約添削</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="現代を知るPlus"><strong>現代を知るPlus</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="チェック&ワーク"><strong>チェック&ワーク</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="言語力ドリル"><strong>言語力ドリル</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="論理力ワーク"><strong>論理力ワーク</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="未来設計ワーク"><strong>未来設計ワーク</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="これ探"><strong>これ探</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="まるわかり"><strong>まるわかり</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="文章トレーニングノート"><strong>文章トレーニングノート</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="要約20"><strong>要約20</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="キーワードファイル"><strong>キーワードファイル</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="ステップアップ"><strong>ステップアップ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="学研"><strong>学研</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="桐原"><strong>桐原</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="ベネッセ"><strong>ベネッセ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="マイナビ"><strong>マイナビ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="論コミ"><strong>論コミ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="さんぽう"><strong>さんぽう</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="リクルート"><strong>リクルート</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="キッズコーポ"><strong>キッズコーポ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="啓林館"><strong>啓林館</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="探究メソッド"><strong>探究メソッド</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="学研ステップ"><strong>学研ステップ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="学研セレクト"><strong>学研セレクト</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="パノラマ"><strong>パノラマ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="リライト"><strong>リライト</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="学研入試資料"><strong>学研入試資料</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="桐原サクセス"><strong>桐原サクセス</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="探究ナビ"><strong>探究ナビ</strong></label></li>
								</ul>
							</dd>
							<dt>商談ワード</dt>
							<dd>
								<ul>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="事前学習ノート"><strong>事前学習ノート</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="リピート完成ノート"><strong>リピート完成ノート</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="チャレンジノート"><strong>チャレンジノート</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="課題"><strong>課題</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="答案"><strong>答案</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="リピート"><strong>リピート</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="返却"><strong>返却</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="回収"><strong>回収</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="探究"><strong>探究</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="指導の手引書"><strong>指導の手引書</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="問題冊子"><strong>問題冊子</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="解答用紙"><strong>解答用紙</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="添削済答案"><strong>添削済答案</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="初回答案"><strong>初回答案</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="２回目答案"><strong>２回目答案</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="リピート済答案"><strong>リピート済答案</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="成績表"><strong>成績表</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="添削"><strong>添削</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="振り返り"><strong>振り返り</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="成績表（生徒用）"><strong>成績表（生徒用）</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="成績表（先生用）"><strong>成績表（先生用）</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="実施日"><strong>実施日</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="返却希望日"><strong>返却希望日</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="追加答案"><strong>追加答案</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="繁忙期"><strong>繁忙期</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="予算"><strong>予算</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="偏差値"><strong>偏差値</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="値段"><strong>値段</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="定価アップ"><strong>定価アップ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="入試資料"><strong>入試資料</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="提案書"><strong>提案書</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="値引き"><strong>値引き</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="ミス"><strong>ミス</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="返却遅れ"><strong>返却遅れ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="答案汚損"><strong>答案汚損</strong></label></li>
								</ul>
							</dd>
							<dt>入試関連</dt>
							<dd>
								<ul>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="入試"><strong>入試</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="受験"><strong>受験</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="点数"><strong>点数</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="過去問"><strong>過去問</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="ＡＯ"><strong>ＡＯ</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="推薦"><strong>推薦</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="指定校推薦"><strong>指定校推薦</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="一般入試"><strong>一般入試</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="共通テスト"><strong>共通テスト</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="四年制大学"><strong>四年制大学</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="専門学校"><strong>専門学校</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="短期大学"><strong>短期大学</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="企業"><strong>企業</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="面接"><strong>面接</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="大学"><strong>大学</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="看護"><strong>看護</strong></label></li>
									<li><label><input type="checkbox" name="keywords[]" value="" data-text="偏差値"><strong>偏差値</strong></label></li>
								</ul>
							</dd>
						</dl><label class="close_keywords" for="keyword_switch"></label></article>
					</div>
					<button class="new"><span>新規依頼作成</span></button>
				</form>
			</section>
			<section id="result">
				<input type="checkbox" id="tablerow1_switch" class="tablerow_switch"><input type="checkbox" id="tablerow2_switch" class="tablerow_switch"><input type="checkbox" id="tablerow3_switch" class="tablerow_switch"><input type="checkbox" id="tablerow4_switch" class="tablerow_switch"><input type="checkbox" id="tablerow5_switch" class="tablerow_switch"><input type="checkbox" id="tablerow6_switch" class="tablerow_switch"><input type="checkbox" id="tablerow7_switch" class="tablerow_switch"><input type="checkbox" id="tablerow8_switch" class="tablerow_switch"><input type="checkbox" id="tablerow9_switch" class="tablerow_switch"><input type="checkbox" id="tablerow10_switch" class="tablerow_switch">
				<table>
					<thead>
						<tr>
							<th class="no">No.</th>
							<th class="date">提出日</th>
							<th class="content">内容</th>
							<th class="reply">返答</th>
							<th class="controller"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="no" data-th="No.">00025<a href="correspondence_report.html">詳細</a></td>
							<td class="date" data-th="提出日：">2020/3/10</td>
							<td  class="content">
								<article>
									<h1 class="title">ガイダンス</h1>
									<p>阿南高校ガイダンス講師の遅れについての報告1/21長野県阿南高校でのガイダンスがあり、14:25〜の実施で</p>
								</article>
							</td>
							<td class="reply">
								<article>
									講師への伝達必要では
								</article>
							</td>
							<td class="controller"><label for="tablerow1_switch"></label></td>
						</tr>
						<tr>
							<td class="no" data-th="No.">00025<a href="correspondence_report.html">詳細</a></td>
							<td class="date" data-th="提出日：">未提出</td>
							<td  class="content">
								<article>
									<h1 class="title">ガイダンス</h1>
									<p>阿南高校ガイダンス講師の遅れについての報告1/21長野県阿南高校でのガイダンスがあり、14:25〜の実施で</p>
									<p>橘支給、東京教育部嶋田さんに連絡し、講師にはタクシーで学校へ向かう事、私は先生に事情を連絡し、待ってもらえるのか、無理ならガイダンスができない旨お伝えするよう</p>
								</article>
							</td>
							<td class="reply">
								<article>
									講師への伝達必要では
								</article>
							</td>
							<td class="controller"><label for="tablerow2_switch"></label></td>
						</tr>
						<tr>
							<td class="no" data-th="No."d>00025<a href="correspondence_report.html">詳細</a></td>
							<td class="date" data-th="提出日：">2020/3/10</td>
							<td  class="content">
								<article>
									<h1 class="title">ガイダンス</h1>
									<p>橘支給、東京教育部嶋田さんに連絡し、講師にはタクシーで学校へ向かう事、私は先生に事情を連絡し、待ってもらえるのか、無理ならガイダンスができない旨お伝えするよう</p>							
									<p>阿南高校ガイダンス講師の遅れについての報告1/21長野県阿南高校でのガイダンスがあり、14:25〜の実施で</p>
									<p>橘支給、東京教育部嶋田さんに連絡し、講師にはタクシーで学校へ向かう事、私は先生に事情を連絡し、待ってもらえるのか、無理ならガイダンスができない旨お伝えするよう</p>							
								</article>
							</td>
							<td class="reply">
								<article>
									講師への伝達必要では
								</article>
							</td>
							<td class="controller"><label for="tablerow3_switch"></label></td>
						</tr>
						<tr>
							<td class="no" data-th="No.">00025<a href="correspondence_report.html">詳細</a></td>
							<td class="date" data-th="提出日：">2020/3/10</td>
							<td  class="content">
								<article>
									<h1 class="title">ガイダンス</h1>
									<p>橘支給、東京教育部嶋田さんに連絡し、講師にはタクシーで学校へ向かう事、私は先生に事情を連絡し、待ってもらえるのか、無理ならガイダンスができない旨お伝えするよう</p>
								</article>
							</td>
							<td class="reply">
								<article>
									講師への伝達必要では
								</article>
							</td>
							<td class="controller"><label for="tablerow4_switch"></label></td>
						</tr>
						<tr>
							<td class="no" data-th="No.">00025<a href="correspondence_report.html">詳細</a></td>
							<td class="date" data-th="提出日：">2020/3/10</td>
							<td  class="content">
								<article>
									<h1 class="title">ガイダンス</h1>
									<p>橘支給、東京教育部嶋田さんに連絡し、講師にはタクシーで学校へ向かう事、私は先生に事情を連絡し、待ってもらえるのか、無理ならガイダンスができない旨お伝えするよう</p>
								</article>
							</td>
							<td class="reply">
								<article>
									講師への伝達必要では
								</article>
							</td>
							<td class="controller"><label for="tablerow5_switch"></label></td>
						</tr>
					</tbody>
				</table>
			</section>
		</div>
		<nav id="pagination">
			<ul class="page-numbers">
				<li class="page-number"><a href="#">|&lt;</a></li>
				<li class="page-number"><a href="#">&lt;</a></li>
				<li>…</li>
				<li class="page-number"><a href="#">5</a></li>
				<li class="page-number"><a href="#">6</a></li>
				<li class="page-number current"><strong>7</strong></li>
				<li class="page-number"><a href="#">8</a></li>
				<li class="page-number"><a href="#">9</a></li>
				<li>…</li>
				<li class="page-number"><a href="#">&gt;</a></li>
				<li class="page-number"><a href="#">&gt;|</a></li>
			</ul>
			<section class="page-fraction">
				<p>7/25</p>
			</section>
		</nav>
	</main>
</body>
@endsection
