<h1>View Question</h1>
<div class="action-buttons ui-helper-clearfix">
	<a href="<?php echo site_url('questions/edit/' . $question->getId()) ?>"
		class="button" data-icon="pencil" title="Edit Question">
		Edit	</a>
	<a href="<?php echo site_url('questions/delete/' . $question->getId()) ?>"
		class="button" data-icon="trash" title="Delete Question"
		onclick="return confirm('Are you sure?');">
		Delete	</a>
	<a href="<?php echo site_url('question-answers?question_id=' . $question->getId()) ?>"
		class="button" data-icon="carat-1-e" title="Question Answers Question">
		Question Answers	</a>
</div>
<div class="ui-widget-content ui-corner-all ui-helper-clearfix">
	<div class="field-wrapper">
		<span class="field-label">Session</span>
		<?php echo h($question->getSessionRelatedBySessionId()) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Quiz</span>
		<?php echo h($question->getQuizRelatedByQuizId()) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Type</span>
		<?php echo h($question->getType()) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Text</span>
		<?php echo h($question->getText()) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Archived</span>
		<?php echo h($question->getArchived(VIEW_TIMESTAMP_FORMAT)) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Created</span>
		<?php echo h($question->getCreated(VIEW_TIMESTAMP_FORMAT)) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Updated</span>
		<?php echo h($question->getUpdated(VIEW_TIMESTAMP_FORMAT)) ?>
	</div>
</div>