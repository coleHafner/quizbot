<h1><?php echo $classroom->isNew() ? "New" : "Edit" ?> Classroom</h1>
<form method="post" action="<?php echo site_url('classrooms/save') ?>">
	<div class="ui-widget-content ui-corner-all ui-helper-clearfix">
		<input type="hidden" name="id" value="<?php echo h($classroom->getId()) ?>" />

		<div class="form-field-wrapper">
			<label class="form-field-label" for="classroom_name">Name</label>
			<input id="classroom_name" type="text" name="name" value="<?php echo h($classroom->getName()) ?>" />
		</div>

		<div class="form-field-wrapper">
			<label class="form-field-label" for="classroom_name">Teacher</label>

			<?php if (App::hasPerm(Perm::CLASSROOM_EDIT_TEACHER)) : ?>

				<select name="teacher_id">
					<option value="">Select Teacher</option>

					<?php foreach ($teachers as $teacher) : ?>
						<option value="<?= $teacher->getId(); ?>"
							<?php echo $teacher->hasClassroom($classroom) ? 'selected' : ''; ?>>
							<?= $teacher ?>
						</option>
					<?php endforeach; ?>
				</select>

			<?php else : ?>
				<?php $teacher = $classroom->isNew() ? App::getUser() : $classroom->getTeacher(); ?>
				<?= $teacher; ?>
				<input type="hidden" name="teacher_id" value="<?= $teacher->getId(); ?>" />
			<?php endif; ?>

		</div>
	</div>
	<div class="form-action-buttons ui-helper-clearfix">
		<span class="button" data-icon="disk">
			<input type="submit" value="<?php echo $classroom->isNew() ? "Save" : "Save Changes" ?>" />
		</span>
		<?php if (isset($_SERVER['HTTP_REFERER'])): ?>
		<a class="button" data-icon="cancel" href="<?php echo $_SERVER['HTTP_REFERER'] ?>">
			Cancel
		</a>
		<?php endif ?>
	</div>
</form>