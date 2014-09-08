<h1>
	<?php if (App::can(Perm::ACTION_EDIT, $quiz_session)) : ?>

		<?php if ($manager->getNextQuestion()) : ?>
			<a href="<?= site_url('quiz-sessions/question/' . $quiz_session->getId() . '/next'); ?>"
				class="button" data-icon="circle-triangle-e">
				Next Question
			</a>
		<?php endif; ?>

		<?php if ($manager->getPrevQuestion()) : ?>
			<a href="<?= site_url('quiz-sessions/question/' . $quiz_session->getId() . '/prev'); ?>"
				class="button" data-icon="circle-triangle-w">
				Previous Question
			</a>
		<?php endif; ?>

	<?php endif; ?>
</h1>