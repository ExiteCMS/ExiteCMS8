<?php
if ( ! empty($messages) ) {
	foreach( $messages as $message):
?>
	<table>
		<tr>
			<td style="width:1px;padding-top:7px;">
				<?php
				if ($message['type'] == 'C') {
					echo $theme->asset()->img('icons/msg_ok.png');
				} elseif ($message['type'] == 'E') {
					echo $theme->asset()->img('icons/msg_error.png');
				} elseif ($message['type'] == 'I') {
					echo $theme->asset()->img('icons/msg_info.png');
				} elseif ($message['type'] == 'N') {
					echo $theme->asset()->img('icons/msg_none.png');
				} elseif ($message['type'] == 'W') {
					echo $theme->asset()->img('icons/msg_warning.png');
				} else {
					echo $theme->asset()->img('icons/msg_none.png');
				}
				?>
			</td>
			<td>
				<span><?php echo $message['message']; ?></span>
			</td>
		</tr>
	</table>
	<?php endforeach; ?>
<?php } ?>
