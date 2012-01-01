<div>
	<?php foreach($phpinfo as $name => $infoblock): ?>

		<?php $first = true; $count = count($infoblock); foreach($infoblock as $title => $info): ?>

			<?php if ($first) { $first = false; ?>
				<table id="phpinfo" cellspacing="0" cellpadding="0" width="100%">
				<table style="width:100%;">
					<tr>
						<th scope="col" colspan="<?php echo $infoblock['_cols'];?>"><?php echo $name; ?></th>
					</tr>
			<?php } ?>

			<?php if (is_numeric($title)) { ?>
				<tr class="hover">
					<td colspan="<?php echo $infoblock['_cols']?>" class="odd" style="vertical-align:bottom"><?php echo $info; ?></td>
				</tr>
			<?php } elseif ($title == 'Directive') { ?>
				<tr class="hover">
					<td class="odd" style="white-space:nowrap"><?php echo $title; ?></td>
					<td class="odd" style="white-space:nowrap"><?php echo $info[0]; ?></td>
					<td class="odd" style="white-space:nowrap"><?php echo $info[1]; ?></td>
				</tr>
			<?php } elseif ($title != '_cols') { ?>
				<?php if ($infoblock['_cols'] == 3) { ?>
					<tr class="hover">
						<?php if (is_array($info)) { ?>
							<td class="odd" style="white-space:nowrap"><?php echo $title; ?></td>
							<td  <?php if ($info[0] != $info[1]) echo 'class="highlight"' ?>><?php echo $info[0]; ?></td>
							<td><?php echo $info[1]; ?></td>
						<?php } else { ?>
							<td class="odd" style="white-space:nowrap"><?php echo $title; ?></td>
							<td colspan="2"><?php echo $info; ?></td>
						<?php } ?>
					</tr>
				<?php } else { ?>
					<tr class="hover">
						<td class="odd" style="white-space:nowrap"><?php echo $title; ?></td>
						<?php if ($title == "Variable" && $info == "Value") { ?>
							<td class="odd" style="white-space:nowrap"><?php echo $info; ?></td>
						<?php } else { ?>
							<td><?php echo $info; ?></td>
						<?php } ?>
					</tr>
				<?php } ?>
			<?php } ?>

			<?php if (--$count == 0) { ?>
			</table>
			<br />
			<?php } ?>

		<?php endforeach; ?>

	<?php endforeach; ?>
</div>
