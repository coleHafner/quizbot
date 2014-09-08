<h1>View Quiz</h1>
<div class="action-buttons ui-helper-clearfix">

	<?php if (App::can(Perm::ACTION_EDIT, $quiz)) : ?>
		<a href="<?php echo site_url('quizzes/edit/' . $quiz->getId()) ?>"
			class="button" data-icon="pencil" title="Edit Quiz">
			Edit	</a>
	<?php endif; ?>

	<?php
	View::load('partials/delete-button', array(
		'record' => $quiz,
		'record_type' => 'Quiz',
		'delete_path' => 'quizzes'
	));
	?>

	<?php if (App::can(Perm::ACTION_EDIT, $quiz)) : ?>
		<a href="<?php echo site_url('questions?quiz_id=' . $quiz->getId()) ?>"
			class="button" data-icon="carat-1-e" title="Questions Quiz">
			Questions	</a>
	<?php endif; ?>

	<?php if (App::hasPerm(Perm::RESULTS_MANAGE)) : ?>
		<a href="<?php echo site_url('quiz-session-attempts?quiz_id=' . $quiz->getId()) ?>"
			class="button" data-icon="carat-1-e" title="Quiz Session Questions Quiz">
			Results	</a>
	<?php endif; ?>
</div>
<div class="ui-widget-content ui-corner-all ui-helper-clearfix">
	<div class="field-wrapper">
		<span class="field-label">Name</span>
		<?php echo h($quiz->getName()) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Created By</span>
		<?php echo $quiz->getCreatedByUser() ? h($quiz->getCreatedByUser()) : '-'; ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Created On</span>
		<?php echo h($quiz->getCreated(VIEW_TIMESTAMP_FORMAT)) ?>
	</div>
	<div class="field-wrapper">
		<span class="field-label">Status</span>
		<?php echo h($quiz->getStatus()) ?>
	</div>
</div>