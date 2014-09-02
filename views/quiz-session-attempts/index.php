<h1>
	Results
	<?php echo $quiz ? ' For ' . $quiz : ''; ?>
</h1>

<?php View::load('pager', compact('pager')) ?>
<div class="ui-widget-content ui-corner-all">
	<?php View::load('quiz-session-attempts/grid', $params) ?>
</div>

<?php View::load('pager', compact('pager')) ?>