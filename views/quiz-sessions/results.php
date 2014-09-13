<h1>

	Results for <?= $manager->getQuiz(); ?>

	<?php if (App::hasPerm(Perm::RESULTS_MANAGE)) : ?>
		<a href="<?= site_url('quiz-sessions/'); ?>"
			class="button" data-icon="carat-1-e">
			View All Results
		</a>
	<?php endif; ?>

</h1>

<div class="ui-corner-all ui-widget-content results-canvas">
	<?php echo $results . ' correct '; ?>
</div>