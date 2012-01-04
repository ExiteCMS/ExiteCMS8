<fieldset>
	<?php if (!empty($news)):?>
		<legend><?php echo \Lang::get('headers.news'); ?></legend>
		<div>
			<ul style='margin-left:0px;margin-bottom:0px;'>
			<?php foreach($news as $key => $item):?>
				<?php if (!is_object($item)) {\Debug::dump($item);continue; }?>
				<li style="list-style-type:none;">
					<div style="float:left;width:45px;text-align:center;border:1px solid;background-color:#fff;color:#b6001e;margin:0;"><?php echo $item->get_date('Y');?></div>
					<div style="float:left;width:35px;text-align:center;border:1px solid #b6001e;background-color:#b6001e;color:#fff;margin:0;"><?php echo $item->get_date('M');?></div>
					<div style="float:left;width:35px;text-align:center;border:1px solid;background-color:#fff;color:#b6001e;margin:0;"><?php echo $item->get_date('d');?></div>
					<div style="float:left;margin-left: 5px;">
						<a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a>
					</div>
					<div class='clear'></div>
				</li>
			<?php endforeach; ?>
			</ul>
		</div>
	<?php else: ?>
		<div class="info">
			<p style="padding-top:30px;color:#b6001e;">There is currently no live RSS feed available from the ExiteCMS website.</p>
		</div>
	<?php endif; ?>
</fieldset>

<?php if (!empty($exitecms)):?>
	<fieldset>
		<legend><?php echo \Lang::get('headers.exitecms'); ?></legend>
		<div class="info" style="background: url('<?php echo $theme->asset()->get_file('admin_exitecms.png', 'img'); ?>') no-repeat center left;">
			<?php echo $exitecms; ?>
		</div>
	</fieldset>
<?php endif; ?>

<?php if (!empty($users)):?>
	<fieldset>
		<legend><?php echo \Lang::get('headers.users'); ?></legend>
		<div class="info" style="background: url('<?php echo $theme->asset()->get_file('admin_users.png', 'img'); ?>') no-repeat center left;">
			<?php $key = 0; foreach($users as $name => $user): ?>
				<div style="width:50%;float:left;overflow:hidden;">
					<?php echo \Lang::get('info.users.'.$key++); ?>
					<span class="highlight"><?php echo $user; ?></span>.
				</div>
			<?php endforeach; ?>
		</div>
	</fieldset>
<?php endif; ?>

<?php if (!empty($platform)):?>
	<fieldset>
		<legend><?php echo \Lang::get('headers.platform'); ?></legend>
		<div class="info" style="background: url('<?php echo $theme->asset()->get_file('admin_platform.png', 'img')?>') no-repeat center left;">
			<?php $key = 0; foreach($platform as $name => $platforminfo): ?>
				<?php if ($key):?>
					<div style="width:50%;float:left;overflow:hidden;">
						<?php echo \Lang::get('info.platform.'.$key++); ?>
						<span class="highlight"><?php echo $platforminfo; ?></span>.
					</div>
				<?php else: ?>
					<div style="width:50%;float:left;overflow:hidden;">
						<?php echo \Lang::get('info.platform.'.$key++); ?>
						<span class="highlight"><?php echo $platforminfo; ?></span>.
					</div>
					<br /><br />
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</fieldset>
<?php endif; ?>
