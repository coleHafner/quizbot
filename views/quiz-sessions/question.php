<h1>
	<?php if (App::can(Perm::ACTION_EDIT, $quiz_session)) : ?>

		<a href="<?= site_url('quiz-sessions/question/' . $quiz_session->getId() . '/next'); ?>"
			class="button" data-icon="<?= !$manager->getNextQuestion() ? 'circle-check' : 'circle-triangle-e'; ?>">
			<?= !$manager->getNextQuestion() ? 'Finish Quiz' : 'Next Question'; ?>
		</a>

		<?php if ($manager->getPrevQuestion()) : ?>
			<a href="<?= site_url('quiz-sessions/question/' . $quiz_session->getId() . '/prev'); ?>"
				class="button" data-icon="circle-triangle-w">
				Previous Question
			</a>
		<?php endif; ?>

	<?php endif; ?>
</h1>

<h3><?= $question; ?></h3>

<ul class="multiple-choice">
	<?php foreach ($question->getAnswers() as $qa) : ?>
		<li><?= $qa; ?></li>
	<?php endforeach; ?>
</ul>
