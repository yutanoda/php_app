@extends('common.layout')
@section('content')
<body class="report hy">
	<header>
		<div>
			<section id="siteID">
				<h1>第一学習社HS</h1>
				<h2>営業支援システム</h2>
			</section>
			<section id="userID">
				<article class="user">
					<h1 class="color_t1">第一 花子</h1>
					<h2>つくば営業所</h2>
				</article>
				<article class="logout color_b1n">
					<a href="./" id="logout" class="color_t1n"><!--button type="submit" class="logoutbutton"-->ログアウト<!--/button--></a>
				</article>
			</section>
		</div>
		<nav>
			<ul>
				<li><a href="info.html" class="color_t1n color_b1n"><span>回覧</span></a></li>
				<li><strong class="color_t1 color_b1"><span>全社報告書</span></strong></li>
				<li><a href="individual_search.html" class="color_t1n color_b1n"><span>個別報告書</span></a></li>
				<li><a href="correspondence_search.html" class="color_t1n color_b1n"><span>要望・提案書</span></a></li>
				<li><a href="#" class="color_t1n color_b1n"><span>営業集計</span></a></li>
			</ul>
		</nav>
    </header>
	<main>
		<div id="submission">
			<h1 class="color_t1">営業報告書</h1>
			<section>
				<article>
					<dl>
						<dt>報告No.</dt>
						<dd>00025</dd>
					</dl>
					<dl>
						<dt>提出者：</dt>
						<dd>第一 太郎</dd>
					</dl>
					<dl>
						<dt>提出日：</dt>
						<dd>2020/3/10（火）</dd>
					</dl>
				</article>
			</section>
			<a href="inclusion_result.html" class="color_t1n color_b1n op">戻る</a>
		</div>
		<div id="report">
			<section>
				<form>
					<table class="achievement">
						<caption class="color_t2 color_b2">
							<dl>
								<dt>1.</dt>
							</dl>
							<dl>
								<dt>営業日</dt>
								<dd>2020/3/10（火）</dd>
							</dl>
							<dl>
								<dt>種別</dt>
								<dd>訪問/面談営業</dd>
							</dl>
							<dl>
								<dt>営業校</dt>
								<dd>大谷高校（京都市東山区）</dd>
							</dl>
							<dl>
								<dt>人数</dt>
								<dd>320</dd>
							</dl>
							<dl>
								<dt>ランク</dt>
								<dd>A3</dd>
							</dl>
							<dl>
								<dt>実績</dt>
								<dd>656,000</dd>
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
							<tr>
								<td class="date">2020/10/02</td>
								<td class="product">小論文トレーニング</td>
								<td class="quantity">320</td>
								<td class="grade">1年</td>
								<td class="total">512,000</td>
							</tr>
							<tr>
								<td class="date">2019/11/08</td>
								<td class="product">小論文模試3回</td>
								<td class="quantity">80</td>
								<td class="grade">3年</td>
								<td class="total">144,000</td>
							</tr>
						</tbody>
					</table>
					<h1><span class="buttons"><button type="button" class="color_t1n color_b1n update">更新</button></span><label><span>面談者：</span><input type="text" value="国語科田中先生、鈴木先生、吉田先生"></label></h1>
					<input type="checkbox" id="journal1_switch" class="journal_switch" checked="checked">
					<article class="journal">
						<section class="employee">
							<div>
								<h1>新規採択活動</h1>
								<textarea>橘（C280）　1年…小論は学研。今年は1回掻き切りだったので来年はリピートを予定、点数表記が良いので第一も候補と。他校実施例を聞かれ2回の黎明・郡山、会津、志望理由指導を採用した安積の例を紹介する。特化データ型にも興味有。・・</textarea>
							</div>
							<div>
								<h1>継続採択活動その他</h1>
								<textarea>学法福島(F240）国語主伊本先生…次年度予算の確認。特進科の実施スケジュールは今年に同じでトレを継続していく。来年諸納金の計上と価格変更について再度確認を頂く。工業科に作トレ・志望理由を勧めているが、</textarea>
							</div>	
						</section>
						<section class="manager">
							<h1>コメント</h1>
							<textarea>★講師への伝達必要では講師への伝達必要では講師への伝達必要では講師への伝達必要では講師への伝達必要では講師への伝達必要では講師への伝達必要では講師への伝達必要では講師への伝達必要では講師への伝達必要では講師への伝達必要では</textarea>
							<label><span class="color_t1n color_b1n">▼分類</span>
								<select>
									<option>-未選択-</option>
									<option>業務関連</option>
									<option>商品・市場に関する情報</option>
									<option>探究への取り組み状況に関する情報</option>
									<option>要検討・対応事項</option>
								</select>
							</label>
							<!--label><span>▼分類2</span>
								<select>
									<option>-未選択-</option>
									<option>業務関連</option>
									<option>商品・市場に関する情報</option>
									<option>探究への取り組み状況に関する情報</option>
									<option>要検討・対応事項</option>
								</select>
							</label>
							<label><span>▼分類3</span>
								<select>
									<option>-未選択-</option>
									<option>業務関連</option>
									<option>商品・市場に関する情報</option>
									<option>探究への取り組み状況に関する情報</option>
									<option>要検討・対応事項</option>
								</select>
							</label-->
						</section>
					</article>
				</form>
				<form>
					<table class="achievement">
						<caption class="color_t2 color_b2">
							<dl>
								<dt>2.</dt>
							</dl>
							<dl>
								<dt>営業日</dt>
								<dd>2020/3/10（火）</dd>
							</dl>
							<dl>
								<dt>種別</dt>
								<dd>電話営業</dd>
							</dl>
							<dl>
								<dt>営業校</dt>
								<dd>京都成章高校（京都市西京区）</dd>
							</dl>
							<dl>
								<dt>人数</dt>
								<dd>120</dd>
							</dl>
							<dl>
								<dt>ランク</dt>
								<dd>B1</dd>
							</dl>
							<dl>
								<dt>実績</dt>
								<dd>0</dd>
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
							<tr>
								<td class="date">&nbsp;</td>
								<td class="product"></td>
								<td class="quantity"></td>
								<td class="grade"></td>
								<td class="total"></td>
							</tr>
						</tbody>
					</table>
					<h1><span class="buttons"><button type="button" class="color_t1n color_b1n update">更新</button></span><label><span>面談者：</span><input type="text" value="三井先生"></label></h1>
					<input type="checkbox" id="journal2_switch" class="journal_switch" checked="checked">
					<article class="journal">
						<section class="employee">
							<div>
								<h1>新規採択活動</h1>
								<textarea>田島(F80)　2年…作文をやらせたい。時事鋼材ももたせたいが、他の教材との予算を見てからかなと。少人数校で教員も少ないので、学年ごとの計画ではなく進路からの縦割り指導じゃないと響いていかない。</textarea>
							</div>
							<div>
								<h1>継続採択活動その他</h1>
								<textarea>学研採用校に対しての提案を強化していくことが必要だろうと考えています。所長に相談しつつも営業所全体で市場把握を年明け早々に動けるようにと考えています（廣田）</textarea>
							</div>	
						</section>
						<section class="manager">
							<h1>コメント</h1>
							<textarea>→「採用校に協力してもらい、使用後の生徒の変化を追っていく。例えば、ルーブリックの集計結果をもらい、弱いところを探り、そこを強化するためのGを投入できるように準備する。実際の採用校のデータから、『これ探』を使えば結果が出るという証明をして、提供する</textarea>
							<label><span class="color_t1n color_b1n">▼分類</span>
								<select>
									<option>-未選択-</option>
									<option>業務関連</option>
									<option>商品・市場に関する情報</option>
									<option>探究への取り組み状況に関する情報</option>
									<option>要検討・対応事項</option>
								</select>
							</label>
							<!--label><span>▼分類2</span>
								<select>
									<option>-未選択-</option>
									<option>業務関連</option>
									<option>商品・市場に関する情報</option>
									<option>探究への取り組み状況に関する情報</option>
									<option>要検討・対応事項</option>
								</select>
							</label>
							<label><span>▼分類3</span>
								<select>
									<option>-未選択-</option>
									<option>業務関連</option>
									<option>商品・市場に関する情報</option>
									<option>探究への取り組み状況に関する情報</option>
									<option>要検討・対応事項</option>
								</select>
							</label-->
						</section>
					</article>
				</form>
			</section>
		</div>
		<div id="summary">
			<section>
				<form>
					<h1><span class="buttons"><button type="button" class="color_t1n color_b1n update">更新</button></span></h1>
					<input type="checkbox" id="journalsummary_switch" class="journal_switch" checked="checked">
					<article class="journal">
						<section class="employee">
							<div>
								<h1>営業活動の気づき</h1>
								<textarea>先週の勉強会ではお世話になりました。探究指導の聞き込みをより深く、次年度に向けての計画についても細かく調査していきます。</textarea>
							</div>
							<div>
								<h1>来週の活動POINT</h1>
								<textarea>小論文…3学期実施に向けての提案、次年度継続・新規の開拓。探究取り組み詳細・担当先生・使用教材の有無の聞き込み</textarea>
							</div>	
						</section>
						<section class="manager">
							<h1>コメント</h1>
							<textarea>学研採用校に対しての提案を強化していくことが必要だろうと考えています。所長に相談しつつも営業所全体で市場把握を年明け早々に動けるようにと考えています（廣田）</textarea>
							<label><span class="color_t1n color_b1n">▼分類</span>
								<select>
									<option>-未選択-</option>
									<option>業務関連</option>
									<option>商品・市場に関する情報</option>
									<option>探究への取り組み状況に関する情報</option>
									<option>要検討・対応事項</option>
								</select>
							</label>
							<!--label><span>▼分類2</span>
								<select>
									<option>-未選択-</option>
									<option>業務関連</option>
									<option>商品・市場に関する情報</option>
									<option>探究への取り組み状況に関する情報</option>
									<option>要検討・対応事項</option>
								</select>
							</label>
							<label><span>▼分類3</span>
								<select>
									<option>-未選択-</option>
									<option>業務関連</option>
									<option>商品・市場に関する情報</option>
									<option>探究への取り組み状況に関する情報</option>
									<option>要検討・対応事項</option>
								</select>
							</label-->	
						</section>
					</article>
				</form>
			</section>
		</div>
	</main>
</body>
@endsection
