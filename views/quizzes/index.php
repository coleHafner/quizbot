<h1>
	<a href="<?php echo site_url('quizzes/edit') ?>"
	   class="button"
	   data-icon="plusthick"
	   title="New Quiz">
		New Quiz
	</a>
	Quizzes
</h1>

<?php View::load('pager', compact('pager')) ?>
<div class="ui-widget-content ui-corner-all">
	<?php View::load('quizzes/grid', $params) ?>
</div>

<?php View::load('pager', compact('pager')) ?>