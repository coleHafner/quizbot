
<?php $quiz_param = $quiz instanceof Quiz ? '?quiz_id=' . $quiz->getId() : ''; ?>

<h1>
	<a href="<?php echo site_url('questions/edit' . $quiz_param) ?>"
	   class="button"
	   data-icon="plusthick"
	   title="New Question">
		Add Question
	</a>
	Questions
	<?php echo $quiz instanceof Quiz ? ' for ' . $quiz : ''; ?>
</h1>

<?php View::load('pager', compact('pager')) ?>
<div class="ui-widget-content ui-corner-all">
	<?php View::load('questions/grid', $params) ?>
</div>

<?php View::load('pager', compact('pager')) ?>