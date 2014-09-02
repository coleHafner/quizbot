<h1>View User</h1>
<div class="action-buttons ui-helper-clearfix">

	<?php if (App::can(Perm::ACTION_EDIT, $user)) : ?>
		<a href="<?php echo site_url('users/edit/' . $user->getId()) ?>"
			class="button" data-icon="pencil" title="Edit User">
			Edit	</a>
	<?php endif; ?>

	<?php if (App::can(Perm::ACTION_DELETE, $user)) : ?>
		<a href="<?php echo site_url('users/delete/' . $user->getId()) ?>"
			class="button" data-icon="trash" title="Delete User"
			onclick="return confirm('Are you sure?');">
			Delete	</a>
	<?php endif; ?>
</div>
<div class="ui-widget-content ui-corner-all ui-helper-clearfix">
	<div class="field-wrapper">
		<span class="field-label">Email</span>
		<?php echo h($user->getEmail()) ?>
	</div>

		<?php if (App::isAdmin()) : ?>
		<div class="field-wrapper">
			<span class="field-label">Type</span>
			<?php echo h($user->getTypeName()) ?>
		</div>
	<?php endif; ?>

	<div class="field-wrapper">
		<span class="field-label">Active</span>
		<?= $user->getStatus();  ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Created On</span>
		<?php echo h($user->getCreated(VIEW_TIMESTAMP_FORMAT)) ?>
	</div>

	<div class="field-wrapper">
		<span class="field-label">Created By</span>
		<?php echo $user->getCreatedByUser() ? h($user->getCreatedByUser()) : '-'; ?>
	</div>
</div>