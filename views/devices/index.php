<h1>
	<a href="<?php echo site_url('devices/edit') ?>"
	   class="button"
	   data-icon="plusthick"
	   title="New Device">
		New Device
	</a>
	Clickers
</h1>

<?php View::load('pager', compact('pager')) ?>
<div class="ui-widget-content ui-corner-all">
	<?php View::load('devices/grid', $params) ?>
</div>

<?php View::load('pager', compact('pager')) ?>