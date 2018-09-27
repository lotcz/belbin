<div class="row">
	<?php
		$roles = $this->getData('roles');

		foreach ($roles as $role) {
			?>
				<div class="col-md-6 p-2">
					<div class="role-badge" style="background-color:<?=$role->val('belbin_role_color') ?>;"></div><h2><?=$role->val('belbin_role_name') ?></h2>
					<p><?=$role->val('belbin_role_description') ?></p>
				</div>
			<?php
		}
	?>
</div>
