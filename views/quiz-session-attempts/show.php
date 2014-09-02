<h1>View Quiz Session Attempt</h1>
<div class="action-buttons ui-helper-clearfix">
	<a href="<?php echo site_url('quiz-session-attempts/edit/' . $quiz_session_attempt->getId()) ?>"
		class="button" data-icon="pencil" title="Edit Quiz_session_attempt">
		Edit	</a>
	<a href="<?php echo site_url('quiz-session-attempts/delete/' . $quiz_session_attempt->getId()) ?>"
		class="button" data-icon="trash" title="Delete Quiz_session_attempt"
		onclick="return confirm('Are you sure?');">
		Delete	</a>
</div>
<div class="ui-widget-content ui-corner-all ui-helper-clearfix">
	<div class="field-wrapper">
		<span class="field-label">Quiz Session Question</span>
		<?php echo h($quiz_session_attempt->getQuizSessionQuestionRelatedByQuizSessionQuestionId()) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Device</span>
		<?php echo h($quiz_session_attempt->getDeviceRelatedByDeviceId()) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Answer</span>
		<?php echo h($quiz_session_attempt->getAnswer()) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Created</span>
		<?php echo h($quiz_session_attempt->getCreated(VIEW_TIMESTAMP_FORMAT)) ?>
	</div>
</div>