<h1>Confirm Quiz Details</h1>
<div class="action-buttons ui-helper-clearfix">
	<?php if (App::can(Perm::ACTION_EDIT, $quiz_session->getQuiz())) : ?>
		<a class="button" data-icon="pencil" href="<?= site_url('quizzes/show/' . $quiz_session->getQuizId()); ?>">
			Edit Quiz
		</a>
	<?php endif; ?>

	<?php if (App::can(Perm::ACTION_EDIT, $quiz_session)) : ?>
		<a class="button" data-icon="pencil" href="<?= site_url('quiz-sessions/edit/' . $quiz_session->getId()); ?>">
			Edit Clickers
		</a>
	<?php endif; ?>

	<?php if (App::hasPerm(Perm::QUIZSESSION_CREATE) && App::can(Perm::ACTION_EDIT, $quiz_session)) : ?>
		<a class="button" data-icon="circle-triangle-e" href="<?= site_url('quiz-sessions/question/' . $quiz_session->getId()); ?>/next">
			<?= $do_resume ? 'Resume' : 'Start Quiz'; ?>
		</a>
	<?php endif; ?>
</div>

<div class="ui-widget-content ui-corner-all ui-helper-clearfix">

	<input type="hidden" name="id" value="<?= $quiz_session->getId(); ?>" />

	<div class="form-field-wrapper">
		<label class="form-field-label" for="quiz_id">Quiz</label>
		<span id="quiz_id"><?= $quiz_session; ?> (<?= $quiz_session->getQuiz()->getNumQuestions() . ' Questions'; ?>)</span>
	</div>

	<div class="form-field-wrapper">
		<label class="form-field-label" for="devices">Clickers</label>

		<div class="form-label-offset" id="devices">
			<?php foreach ($quiz_session->getSessionDevices() as $qsd) : ?>
				<div class="ui-helper-clearfix margin-bottom">
					<div class="pull-left margin-right">
						<div class="color-square" style="background-color: <?= $qsd->getDevice()->getColor(); ?>">&nbsp;</div>
					</div>

					<div class="pull-left">
						<?= $qsd->getUser(); ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

</div>
