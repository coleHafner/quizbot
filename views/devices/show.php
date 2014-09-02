<h1>View Device</h1>
<div class="action-buttons ui-helper-clearfix">
	<a href="<?php echo site_url('devices/edit/' . $device->getId()) ?>"
		class="button" data-icon="pencil" title="Edit Device">
		Edit	</a>
	<a href="<?php echo site_url('devices/delete/' . $device->getId()) ?>"
		class="button" data-icon="trash" title="Delete Device"
		onclick="return confirm('Are you sure?');">
		Delete	</a>
	<a href="<?php echo site_url('quiz-session-attempts?device_id=' . $device->getId()) ?>"
		class="button" data-icon="carat-1-e" title="Quiz Session Attempts Device">
		Quiz Session Attempts	</a>
</div>
<div class="ui-widget-content ui-corner-all ui-helper-clearfix">
	<div class="field-wrapper">
		<span class="field-label">Session</span>
		<?php echo h($device->getSessionRelatedBySessionId()) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Classroom</span>
		<?php echo h($device->getClassroomRelatedByClassroomId()) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Uuid</span>
		<?php echo h($device->getUuid()) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Nickname</span>
		<?php echo h($device->getNickname()) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Archived</span>
		<?php echo h($device->getArchived(VIEW_TIMESTAMP_FORMAT)) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Created</span>
		<?php echo h($device->getCreated(VIEW_TIMESTAMP_FORMAT)) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Updated</span>
		<?php echo h($device->getUpdated(VIEW_TIMESTAMP_FORMAT)) ?>
	</div>
</div>