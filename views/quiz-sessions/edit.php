<h1>Start Quiz</h1>

<form method="post" action="<?php echo site_url('quiz-sessions/save/' . $quiz_session->getId()) ?>">
	<div class="ui-widget-content ui-corner-all ui-helper-clearfix">

		<input type="hidden" name="id" value="<?= $quiz_session->getId(); ?>" />

		<div class="form-field-wrapper">
			<label class="form-field-label" for="quiz_id">Quiz</label>
			<select id="quiz_id" name="quiz_id">
				<option value="">Select Quiz</option>
				<?php foreach (App::getClassroom()->getQuizzes() as $quiz) : ?>
					<option value="<?= $quiz->getId(); ?>"
						<?= $quiz_session->getQuizId() == $quiz->getId() ? 'selected' : ''; ?>>
						<?= $quiz; ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-field-wrapper">
			<label class="form-field-label" for="devices">Clickers</label>

			<div class="form-label-offset" id="devices">

				<?php foreach (App::getClassroom()->getDevices() as $device) : ?>
					<div class="ui-helper-clearfix margin-bottom">
						<div class="pull-left margin-right">
							<div class="color-square" style="background-color: <?= $device->getColor(); ?>">&nbsp;</div>
							<input type="hidden" name="devices[]" value="<?= $device->getId(); ?>" />
						</div>

						<div class="pull-left">
							<select name="students[]">
								<option value="">Select Student</option>
								<?php foreach (App::getClassroom()->getStudents() as $student) : ?>
									<option value="<?= $student->getId(); ?>"
										<?= $quiz_session->hasSessionDeviceForStudent($device, $student) ? 'selected' : ''; ?>>
										<?= $student; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				<?php endforeach; ?>

				<a class="button" data-icon="plusthick" href="<?= site_url('devices/edit/') ?>">
					Add Clicker
				</a>
			</div>
		</div>

	</div>
	<div class="form-action-buttons ui-helper-clearfix">

		<span class="button" data-icon="<?= $quiz_session->isNew() ? 'disk' : 'circle-triangle-e'; ?>">
			<input type="submit" value="<?= $quiz_session->isNew() ? 'Start Quiz' : 'Resume'; ?>" />
		</span>

		<?php if (isset($_SERVER['HTTP_REFERER'])): ?>
			<a class="button" data-icon="cancel" href="<?php echo $_SERVER['HTTP_REFERER'] ?>">
				Cancel
			</a>
		<?php endif ?>
	</div>
</form>