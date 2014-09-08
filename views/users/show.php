<h1>View <?= $user_type; ?></h1>
<div class="action-buttons ui-helper-clearfix">

	<?php if (App::can(Perm::ACTION_EDIT, $user)) : ?>
		<a href="<?php echo site_url($view_dir . '/edit/' . $user->getId()) ?>"
			class="button" data-icon="pencil" title="Edit <?= $user_type; ?>">
			Edit </a>
	<?php endif; ?>

	<?php
	View::load('partials/delete-button', array(
		'record' => $user,
		'record_type' => $user_type,
		'delete_path' => $view_dir
	));
	?>
</div>
<div class="ui-widget-content ui-corner-all ui-helper-clearfix">
	<div class="field-wrapper">
		<span class="field-label">Email</span>
		<?php echo h($user->getEmail()) ?>
	</div>

	<div class="field-wrapper">
		<span class="field-label">First Name</span>
		<?php echo h($user->getFirstName()) ?>
	</div>

	<div class="field-wrapper">
		<span class="field-label">Last Name</span>
		<?php echo h($user->getLastName	()) ?>
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