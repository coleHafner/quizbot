<h1>
	<?php if (App::hasPerm(Perm::QUIZSESSION_CREATE)) : ?>
		<a href="<?php echo site_url('quizzes/edit') ?>"
		   class="button"
		   data-icon="plusthick"
		   title="New Quiz">
			Start Quiz
		</a>
	<?php endif; ?>
	
	Quiz Results
</h1>

<?php View::load('pager', compact('pager')) ?>
<div class="ui-widget-content ui-corner-all">
	<?php View::load('quiz-sessions/grid', $params) ?>
</div>

<?php View::load('pager', compact('pager')) ?>