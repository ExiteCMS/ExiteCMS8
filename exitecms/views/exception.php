<?php
/*
 * Generic ExiteCMS application exception view
 */
$message = explode('|', $exception->getMessage());

if (empty($message[1]))
{
	$message[1] = 'Exception generated on line '.$exception->getLine().' of '.str_replace(APPPATH, 'APPPATH/', $exception->getFile());
	if ($code = $exception->getCode())
	{
		$message[1] .= '<br />The exception code is '. $code;
	}
}

if (empty($message[0]))
{
	$message[0] = 'ExiteCMS does not know how to handle this situation.';
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ExiteCMS - An error has occured</title>
	<style type="text/css">
		body { background-color: #F2F2F2; margin: 45px 0 0 0; font-family: ‘Palatino Linotype’, ‘Book Antiqua’, Palatino, serif; font-size: 18px }
		#wrapper { width: 740px; margin: 0 auto; padding-top: 200px; }
		h1 { color: #b6001e; font: normal normal normal 62px/1em Impact, Charcoal, sans-serif; margin: 0 0 15px 0; }
		pre { padding: 15px; background-color: #FFF; border: 1px solid #CCC; font-size: 16px; white-space:pre-line;}
		#footer p { font-size: 14px; text-align: right; }
		a { color: #000; }
	</style>
</head>
<body>
	<div id="wrapper">
		<h1>An error has occured</h1>

		<div id="content">
			<h2><?php echo $message[0]; ?></h2>

			<?php
				if (ini_get('display_errors'))
				{
					echo '<pre><code>', $message[1], '</code></pre>';
				}
			?>

			<p></p>
		</div>
		<div id="footer">
			<p>
				<a href="http://www.exitecms.org">ExiteCMS</a> is released under the Open Software License v. 3.0.<br />
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
