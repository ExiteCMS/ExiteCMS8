<?php $theme->asset()->css(array('global.css', 'default.css'), array(), 'header'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<!-- Always force latest IE rendering engine & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<?php if (isset($title)) echo "<title>$title</title>"; ?>

	<!-- Mobile Viewport Fix -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<!-- Grab Google CDNs jQuery, fall back if necessary -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript">!window.jQuery && document.write('<script src="/themes/default/js/jquery-1.6.2.min.js"><\/script>');</script>

<!-- Form onsubmit function to populate the form with the current crsf token -->
<?php echo \Security::js_set_token();?>

	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<?php echo $theme->asset()->render('header'); ?>
</head>

<body>
	<div id="container">
		<div id="inner">
			<div id="header-nav">
				<?php  echo $theme->has_widgets('header-nav') ? $theme->widgets('header-nav') : "<ul><li>&nbsp;</li></ul>"; ?>
			</div>
			<div id="header"></div>
			<div id="main-nav">
				<?php  echo $theme->has_widgets('main-nav') ? $theme->widgets('main-nav') : "<ul><li>&nbsp;</li></ul>"; ?>
			</div>
			<div id="body">
				<div id="wrapper">
					<?php if ( $theme->has_widgets('messages') ) { ?>
						<?php if ( $output = $theme->widgets('messages') ) { ?>
						<div id="messages">
							<?php echo $output; ?>
						</div>
						<?php } ?>
					<?php } ?>
					<?php echo $theme->widgets('body'); ?>
					<div id="content">
						<?php echo $theme->widgets('content'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="footer">
		<div class="footer-content">
			<?php echo $theme->widgets('footer'); ?>
			<div class="footer-width">
				<div class="footer-bottom">
					<?php
						// get some profiling info
						$bm = \Profiler::app_total();
						echo sprintf("Executed in %ss using %sMb of memory", round($bm[0], 4), round($bm[1] / pow(1024, 2), 3));
					?>
					<div style="float:left;">
						&copy; 2011<?php if (date("Y") > 2011) echo '-',date("Y"); ?> <a href="http://www.exitecms.org">ExiteCMS</a>
						<?php echo sprintf('v%s.%s build %s',$version, $revision, $build); ?>
					</div>
					<div style="float:right;">
						ExiteCMS is powered by <a href="http://fuelphp.com">FuelPHP</a> v<?php echo Fuel::VERSION; ?>
					</div>
				 </div>
			</div>
	</div>

	<?php echo $theme->asset()->render('footer'); ?>

	<script>
		$(function(){
			$(".tooltip").tipTip({defaultPosition: "right", maxWidth: "300px", edgeOffset: 5});;
		});
	</script>
</body>

</html>
