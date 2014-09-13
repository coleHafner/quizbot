<h1>Confirm Quiz Details</h1>
<div class="action-buttons ui-helper-clearfix">

	<?php if (App::can(Perm::ACTION_EDIT, $quiz_session)) : ?>
		<a class="button" data-icon="pencil" href="<?= site_url('quiz-sessions/edit/' . $quiz_session->getId()); ?>">
			Edit Details
		</a>
	<?php endif; ?>

	<?php if (App::hasPerm(Perm::QUIZSESSION_CREATE) && App::can(Perm::ACTION_EDIT, $quiz_session)) : ?>
		<a class="button" data-icon="circle-triangle-e" href="<?= site_url('quiz-sessions/start/' . $quiz_session->getId()); ?>/1">
			<?= $do_resume ? 'Resume' : 'Start Quiz'; ?>
		</a>
	<?php endif; ?>
</div>

<div class="ui-widget-content ui-corner-all ui-helper-clearfix">

	<input type="hidden" name="id" value="<?= $quiz_session->getId(); ?>" />

	<div class="form-field-wrapper">
		<label class="form-field-label" for="quiz_id">Quiz</label>
		<span id="quiz_id"><?= $quiz_session; ?> (<?= $quiz_session->getQuiz()->getNumQuestions() . ' Questions'; ?>)</span>

		<?php if (App::can(Perm::ACTION_EDIT, $quiz_session->getQuiz())) : ?>
			&nbsp;&nbsp;
			<a class="small-link" href="<?= site_url('questions/?quiz_id=' . $quiz_session->getQuizId()); ?>">
				edit
			</a>
		<?php endif; ?>
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
