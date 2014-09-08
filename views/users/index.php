<h1>
	<a href="<?php echo site_url( $view_dir . '/edit') ?>"
	   class="button"
	   data-icon="plusthick"
	   title="New <?= $user_type; ?>">
		New <?= $user_type; ?>
	</a>
	<?= $user_type . 's'; ?>
</h1>

<?php View::load('pager', compact('pager')) ?>
<div class="ui-widget-content ui-corner-all">
	<?php View::load('users/grid', $params) ?>
</div>

<?php View::load('pager', compact('pager')) ?>