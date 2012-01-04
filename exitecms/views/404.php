<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ExiteCMS</title>
	<style type="text/css">
		body { background-color: #F2F2F2; margin: 45px 0 0 0; font-family: ‘Palatino Linotype’, ‘Book Antiqua’, Palatino, serif; font-size: 18px }
		#wrapper { width: 740px; margin: 0 auto; }
		h1 { color: #333333; font: normal normal normal 62px/1em Impact, Charcoal, sans-serif; margin: 0 0 15px 0; }
		pre { padding: 15px; background-color: #FFF; border: 1px solid #CCC; font-size: 16px;}
		#footer p { font-size: 14px; text-align: right; }
		a { color: #000; }
	</style>
</head>
<body>
	<div id="wrapper">
		<h1>Page not found</h1>

		<div id="content">
			<p>ExiteCMS is not configured for this hostname.</p>

			<pre><code>Please make sure your ExiteCMS host configuration is correct</code></pre>

			<p></p>
		</div>
		<div id="footer">
			<p>
				<a href="http://www.exitecms.org">ExiteCMS</a> is released under the Open Software License v. 3.0<br />
				<?php
					$bm = Profiler::app_total();
					$exec_time = round($bm[0], 4);
					$mem_usage = round($bm[1] / pow(1024, 2), 3);
					echo 'Executed in ',$exec_time, 's using ', $mem_usage, 'mb of memory.';
				?>
			</p>
		</div>
	</div>
</body>
</html>
