<h1>
	<a href="<?php echo site_url('users/edit') ?>"
	   class="button"
	   data-icon="plusthick"
	   title="New User">
		New User
	</a>
	Users
</h1>

<?php View::load('pager', compact('pager')) ?>
<div class="ui-widget-content ui-corner-all">
	<?php View::load('users/grid', $params) ?>
</div>

<?php View::load('pager', compact('pager')) ?>