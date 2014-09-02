<h1>
	<a href="<?php echo site_url('classrooms/edit') ?>"
	   class="button"
	   data-icon="plusthick"
	   title="New Classroom">
		New Classroom
	</a>
	Classrooms
</h1>

<?php View::load('pager', compact('pager')) ?>
<div class="ui-widget-content ui-corner-all">
	<?php View::load('classrooms/grid', $params) ?>
</div>

<?php View::load('pager', compact('pager')) ?>