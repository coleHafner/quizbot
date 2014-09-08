<h1>View Clicker</h1>
<div class="action-buttons ui-helper-clearfix">

	<?php if (App::can(Perm::ACTION_EDIT, $device)) : ?>
		<a href="<?php echo site_url('devices/edit/' . $device->getId()) ?>"
			class="button" data-icon="pencil" title="Edit Device">
			Edit	</a>
	<?php endif; ?>

	<?php
	View::load('partials/delete-button', array(
		'record' => $device,
		'record_type' => 'Device',
		'delete_path' => 'devices'
	));
	?>
</div>

<div class="ui-widget-content ui-corner-all ui-helper-clearfix">

	<?php if (App::hasPerm(Perm::DEVICE_EDIT_CLASSROOM)) : ?>
		<div class="field-wrapper">
			<span class="field-label">Classroom</span>
			<?php echo h($device->getClassroomRelatedByClassroomId()) ?>
		</div>
	<?php endif; ?>

	<?php if (App::hasPerm(Perm::DEVICE_EDIT_UUID)) : ?>
		<div class="field-wrapper">
			<span class="field-label">Uuid</span>
			<?php echo h($device->getUuid()) ?>
		</div>
	<?php endif; ?>

	<div class="field-wrapper">
		<span class="field-label">Color</span>

		<div class="form-label-offset color-square" style="background-color:<?= $device->getColor(); ?>;">&nbsp;</div>
	</div>

	<div class="field-wrapper">
		<span class="field-label">Nickname</span>
		<?php echo h($device->getNickname()) ?>
	</div>

	<div class="field-wrapper">
		<span class="field-label">Created By</span>
		<?php echo h($device->getCreatedByUser()) ?>
	</div>

	<div class="field-wrapper">
		<span class="field-label">Created On</span>
		<?php echo h($device->getCreated(VIEW_TIMESTAMP_FORMAT)) ?>
	</div>

	<div class="field-wrapper">
		<span class="field-label">Status</span>
		<?php echo h($device->getStatus()) ?>
	</div>

</div>