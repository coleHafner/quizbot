<h1><?php echo $quiz->isNew() ? "New" : "Edit" ?> Quiz</h1>
<form method="post" action="<?php echo site_url('quizzes/save') ?>">
	<div class="ui-widget-content ui-corner-all ui-helper-clearfix">
		<input type="hidden" name="id" value="<?php echo h($quiz->getId()) ?>" />

		<div class="form-field-wrapper">
			<label class="form-field-label" for="quiz_name">Name</label>
			<input id="quiz_name" type="text" name="name" value="<?php echo h($quiz->getName()) ?>" />
		</div>

		<div class="form-field-wrapper">
			<label class="form-field-label" for="quiz_name">Classroom</label>

			<?php if (App::hasPerm(Perm::CLASSROOMS_MANAGE)) : ?>
				<select name="classroom_id">
					<option id="">Select Classroom</option>

					<?php foreach(App::getUser()->getClassrooms() as $classroom) : ?>
						<option value="<?= $classroom->getId(); ?>"
							<?= App::getClassroomId() == $classroom->getId() ? 'selected' : ''; ?> >
							<?= $classroom ?>
						</option>
					<?php endforeach; ?>
				</select>
			<?php else : ?>
				<input name="classroom_id" type="hidden" value="<?= App::getClassroomId(); ?>" />
			<?php endif; ?>
		</div>
	</div>
	<div class="form-action-buttons ui-helper-clearfix">
		<span class="button" data-icon="disk">
			<input type="submit" value="<?php echo $quiz->isNew() ? "Save" : "Save Changes" ?>" />
		</span>
		<?php if (isset($_SERVER['HTTP_REFERER'])): ?>
		<a class="button" data-icon="cancel" href="<?php echo $_SERVER['HTTP_REFERER'] ?>">
			Cancel
		</a>
		<?php endif ?>
	</div>
</form>