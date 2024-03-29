<h1>View Classroom</h1>
<div class="action-buttons ui-helper-clearfix">

	<?php if (App::can(Perm::ACTION_EDIT, $room)) : ?>
		<a href="<?php echo site_url('classrooms/edit/' . $room->getId()) ?>"
			class="button" data-icon="pencil" title="Edit Classroom">
			Edit	</a>
	<?php endif; ?>

	<?php
	View::load('partials/delete-button', array(
		'record' => $room,
		'record_type' => 'Classroom',
		'delete_path' => 'classrooms'
	));
	?>

</div>
<div class="ui-widget-content ui-corner-all ui-helper-clearfix">
	<div class="field-wrapper">
		<span class="field-label">Name</span>
		<?php echo h($room->getName()) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Teacher</span>
		<?php echo $room->getTeacher() ? h($room->getTeacher()) : '-'; ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Status</span>
		<?php echo h($room->getStatus()) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Created On</span>
		<?php echo h($room->getCreated(VIEW_TIMESTAMP_FORMAT)) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Created By</span>
		<?php echo h($room->getCreatedByUser()) ?>
	</div>
</div>