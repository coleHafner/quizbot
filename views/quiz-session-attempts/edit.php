
<?php $quiz_param = $quiz instanceof Quiz ? '?quiz_id=' . $quiz->getId() : ''; ?>

<h1>
	<?php echo $quiz_session_attempt->isNew() ? "New" : "Edit" ?> Quiz Session Attempt
</h1>

<form method="post" action="<?php echo site_url('quiz-session-attempts/save') ?>">
	<div class="ui-widget-content ui-corner-all ui-helper-clearfix">
		<input type="hidden" name="id" value="<?php echo h($quiz_session_attempt->getId()) ?>" />
		<div class="form-field-wrapper">
			<label class="form-field-label" for="quiz_session_attempt_quiz_session_question_id">Quiz Session Question</label>
			<select id="quiz_session_attempt_quiz_session_question_id" name="quiz_session_question_id">
			<?php foreach (QuizSessionQuestion::doSelect() as $quiz_session_question): ?>
				<option <?php if ($quiz_session_attempt->getQuizSessionQuestionId() === $quiz_session_question->getId()) echo 'selected="selected"' ?> value="<?php echo $quiz_session_question->getId() ?>"><?php echo $quiz_session_question?></option>
			<?php endforeach ?>
			</select>
		</div>
		<div class="form-field-wrapper">
			<label class="form-field-label" for="quiz_session_attempt_device_id">Device</label>
			<select id="quiz_session_attempt_device_id" name="device_id">
			<?php foreach (Device::doSelect() as $device): ?>
				<option <?php if ($quiz_session_attempt->getDeviceId() === $device->getId()) echo 'selected="selected"' ?> value="<?php echo $device->getId() ?>"><?php echo $device?></option>
			<?php endforeach ?>
			</select>
		</div>
		<div class="form-field-wrapper">
			<label class="form-field-label" for="quiz_session_attempt_answer">Answer</label>
			<input id="quiz_session_attempt_answer" type="text" name="answer" value="<?php echo h($quiz_session_attempt->getAnswer()) ?>" />
		</div>
	</div>
	<div class="form-action-buttons ui-helper-clearfix">
		<span class="button" data-icon="disk">
			<input type="submit" value="<?php echo $quiz_session_attempt->isNew() ? "Save" : "Save Changes" ?>" />
		</span>
		<?php if (isset($_SERVER['HTTP_REFERER'])): ?>
		<a class="button" data-icon="cancel" href="<?php echo $_SERVER['HTTP_REFERER'] ?>">
			Cancel
		</a>
		<?php endif ?>
	</div>
</form>