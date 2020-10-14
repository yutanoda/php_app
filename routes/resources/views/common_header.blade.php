<header>
		<div>
			<section id="siteID">
				<h1>第一学習社HS</h1>
				<h2>営業支援システム</h2>
			</section>
			<section id="userID">
				<article class="user">
					<h1 class="color_t1">{{ $staff_name }}</h1>
					<h2>{{ $branch_name }}</h2>
				</article>
				<article class="logout color_b1n">
					<input type="hidden" name="location" value="" id="location">
					<a href="{{ route('logout') }}" id="logout" class="color_t1n" onclick="return confirm('ログアウトしますか？　更新未完了の内容は破棄されます')">ログアウト</a>
				</article>
			</section>
		</div>
<nav>
	<ul>
		@if(request()->path() == 'top')
		<li><strong class="color_t1 color_b1"><span>回覧</span></strong></li>
		@else
		<li><a href="{{ route('top') }}" class="color_t1n color_b1n"><span>回覧</span></a></li>		
		@endif

		@if(request()->path() == 'inclusion_result')
		<li><strong class="color_t1 color_b1"><span>全社報告書</span></strong></li>
		@else
		<li><a href="{{ route('inclusion_result') }}" class="color_t1n color_b1n"><span>全社報告書</span></a></li>		
		@endif

		@if(request()->path() == 'individual_result')
		<li><strong class="color_t1 color_b1"><span>個別報告書</span></strong></li>
		@else
		<li><a href="{{ route('individual_result') }}" class="color_t1n color_b1n"><span>個別報告書</span></a></li>	
		@endif

		<!-- @if(request()->path() == 'correspondence_result')
		<li><strong class="color_t1 color_b1"><span>要望・提案書</span></strong></li>
		@else
		<li><a href="{{ route('correspondence_result') }}" class="color_t1n color_b1n"><span>要望・提案書</span></a></li>
		@endif

		@if($authority_flag != 1)
			@if(request()->path() == 'sales_total')
			<li><strong class="color_t1 color_b1"><span>営業集計</span></strong></li>
			@else
			<li><a href="{{ route('sales_total') }}" class="color_t1n color_b1n"><span>営業集計</span></a></li>
			@endif
		@endif -->
	</ul>
</nav>
</header>
<script type="text/javascript">
	if (navigator.geolocation) {
			// 現在の位置情報取得を実施
			navigator.geolocation.getCurrentPosition(
			// 位置情報取得成功時
			function (pos) { 
							var location =　"緯度：" + pos.coords.latitude + ",";
							location += "経度：" + pos.coords.longitude;
							document.getElementById("location").value = location;
							console.log(location);
							let logout = document.getElementById('logout');
							logout_location = logout.href + "/" + location
							logout.href = logout_location 
			},
			// 位置情報取得失敗時
			function (pos) { 
							var location ="<li>位置情報が取得できませんでした。</li>";
							document.getElementById("location").value = location;
			});
	} else {
			window.alert("本ブラウザではGeolocationが使えません");
	}
	
</script>