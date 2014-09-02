<h1><?php echo $device->isNew() ? "New" : "Edit" ?> Device</h1>
<form method="post" action="<?php echo site_url('devices/save') ?>">
	<div class="ui-widget-content ui-corner-all ui-helper-clearfix">
		<input type="hidden" name="id" value="<?php echo h($device->getId()) ?>" />
		<div class="form-field-wrapper">
			<label class="form-field-label" for="device_session_id">Session</label>
			<select id="device_session_id" name="session_id">
			<?php foreach (Session::doSelect() as $session): ?>
				<option <?php if ($device->getSessionId() === $session->getId()) echo 'selected="selected"' ?> value="<?php echo $session->getId() ?>"><?php echo $session?></option>
			<?php endforeach ?>
			</select>
		</div>
		<div class="form-field-wrapper">
			<label class="form-field-label" for="device_classroom_id">Classroom</label>
			<select id="device_classroom_id" name="classroom_id">
			<?php foreach (Classroom::doSelect() as $classroom): ?>
				<option <?php if ($device->getClassroomId() === $classroom->getId()) echo 'selected="selected"' ?> value="<?php echo $classroom->getId() ?>"><?php echo $classroom?></option>
			<?php endforeach ?>
			</select>
		</div>
		<div class="form-field-wrapper">
			<label class="form-field-label" for="device_uuid">Uuid</label>
			<input id="device_uuid" type="text" name="uuid" value="<?php echo h($device->getUuid()) ?>" />
		</div>
		<div class="form-field-wrapper">
			<label class="form-field-label" for="device_nickname">Nickname</label>
			<input id="device_nickname" type="text" name="nickname" value="<?php echo h($device->getNickname()) ?>" />
		</div>
		<div class="form-field-wrapper">
			<label class="form-field-label" for="device_archived">Archived</label>
			<input id="device_archived" type="text" name="archived" value="<?php echo h($device->getArchived(VIEW_TIMESTAMP_FORMAT)) ?>" />
		</div>
	</div>
	<div class="form-action-buttons ui-helper-clearfix">
		<span class="button" data-icon="disk">
			<input type="submit" value="<?php echo $device->isNew() ? "Save" : "Save Changes" ?>" />
		</span>
		<?php if (isset($_SERVER['HTTP_REFERER'])): ?>
		<a class="button" data-icon="cancel" href="<?php echo $_SERVER['HTTP_REFERER'] ?>">
			Cancel
		</a>
		<?php endif ?>
	</div>
</form>