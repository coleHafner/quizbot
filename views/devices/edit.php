<?php $color = $device->getColor() ? $device->getColor() : Device::DEFAULT_COLOR; ?>

<script type="text/javascript">
	$(function() {

		function selectColor() {
			$('span.color').css('border', '0');
			$('span.color[data-selected]').css('border', '2px solid #000');
		}

		var colorPicker = $('#colorpicker');
			colorPicker.simplecolorpicker();
			colorPicker.simplecolorpicker('selectColor', '<?= $color; ?>');
			colorPicker.change(function() {
				$('#color').val($(this).val());
				selectColor();
			});

		selectColor();
	});
</script>

<h1><?php echo $device->isNew() ? "New" : "Edit" ?> Clicker</h1>

<form method="post" action="<?php echo site_url('devices/save') ?>">
	<div class="ui-widget-content ui-corner-all ui-helper-clearfix">

		<input type="hidden" name="id" value="<?php echo h($device->getId()) ?>" />
		<input type="hidden" name="color" value="<?php echo h($device->getColor()) ?>" id="color" />

		<div class="form-field-wrapper">
			<label class="form-field-label" for="device_nickname">Nickname</label>
			<input id="device_nickname" type="text" name="nickname" value="<?php echo h($device->getNickname()) ?>" />
		</div>

		<?php if (App::hasPerm(Perm::DEVICE_EDIT_UUID)) : ?>
			<div class="form-field-wrapper">
				<label class="form-field-label" for="device_uuid">Uuid</label>
				<input id="device_uuid" type="text" name="uuid" value="<?php echo h($device->getUuid()) ?>" />
			</div>
		<?php endif; ?>

		<?php if (App::hasPerm(Perm::DEVICE_EDIT_CLASSROOM) && !App::getClassroom()) : ?>
			<div class="form-field-wrapper">
				<label class="form-field-label" for="device_classroom_id">Classroom</label>
				<select id="device_classroom_id" name="classroom_id" style="width:139px;">
				<?php foreach (App::getUser()->getClassrooms() as $classroom): ?>
					<option <?php if ($device->getClassroomId() === $classroom->getId()) echo 'selected="selected"' ?>
						value="<?php echo $classroom->getId() ?>">
						<?php echo $classroom?>
					</option>
				<?php endforeach ?>
				</select>
			</div>
		<?php endif; ?>

		<div class="form-field-wrapper">
			<label class="form-field-label" for="colorpicker">Color</label>

			<select id="colorpicker">
			  <option value="#7bd148">Green</option>
			  <option value="#5484ed">Bold blue</option>
			  <option value="#a4bdfc">Blue</option>
			  <option value="#46d6db">Turquoise</option>
			  <option value="#7ae7bf">Light green</option>
			  <option value="#51b749">Bold green</option>
			  <option value="#fbd75b">Yellow</option>
			  <option value="#ffb878">Orange</option>
			  <option value="#ff887c">Red</option>
			  <option value="#dc2127">Bold red</option>
			  <option value="#dbadff">Purple</option>
			  <option value="#e1e1e1">Gray</option>
			</select>
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