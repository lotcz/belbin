<?php
	$results = $this->getData('results');
?>

<?php
	$this->renderLink('test', 'Restart test');
?>

<table>
	<tr>
		<th>Role</th>
		<th>Score</th>
	</tr>

	<?php

		foreach ($results as $result) {
			?>
				<tr>
					<td><?=$result->val('belbin_role_name') ?></td>
					<td><?=$result->val('score') ?></td>
				</tr>
			<?php
		}

	?>

	<tr>
		<td>Total score:</td>
		<td><strong><?=$this->getData('total_score'); ?></strong></td>
	</tr>
</table>
