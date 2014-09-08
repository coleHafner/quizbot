<h1>View Question</h1>
<div class="action-buttons ui-helper-clearfix">

	<?php if (App::can(Perm::ACTION_EDIT, $question)) : ?>
		<a href="<?php echo site_url('questions/edit/' . $question->getId()) ?>"
			class="button" data-icon="pencil" title="Edit Question">
			Edit	</a>
	<?php endif; ?>

	<?php
	View::load('partials/delete-button', array(
		'record' => $question,
		'record_type' => 'Question',
		'delete_path' => 'questions'
	));
	?>
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