<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<title> 
		@yield('title') / 第一営業支援
	</title>
	<script>
		window.onload = function () {
			function getScrolled() {
				return ( window.pageYOffset !== undefined ) ? window.pageYOffset: document.documentElement.scrollTop;
			}
			
			var topButton = document.getElementById( 'totop' );
			
			function scrollToTop() {
				var scrolled = getScrolled();
				window.scrollTo( 0, Math.floor( scrolled / 1.2 ) );
				if ( scrolled > 0 ) {
					window.setTimeout( scrollToTop, 30 );
				}
			};
			
			topButton.onclick = function() {
				scrollToTop();
			};
		};
	</script>
</head>
@yield('content')
</html>
