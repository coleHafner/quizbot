<?php if (App::can(Perm::ACTION_DELETE, $record) && !$record->getArchived()) : ?>
	<a
		class="button"
		data-icon="trash"
		title="Delete <?= $record_type; ?>"
		href="#"
		onclick="if (confirm('Are you sure you want to delete this <?= $record_type; ?>?')) { window.location.href = '<?php echo site_url($delete_path . '/delete/' . $record->getId()) ?>'; } return false">
		Delete
	</a>
<?php elseif(App::hasPerm(Perm::REACTIVATE)) : ?>
	<a
		class="button"
		data-icon="refresh"
		title="Reactivate <?= $record_type; ?>"
		href="#"
		onclick="if (confirm('Are you sure you want to activate this <?= $record_type; ?>?')) { window.location.href = '<?php echo site_url($delete_path . '/activate/' . $record->getId()) ?>'; } return false">
		Activate
	</a>
<?php endif; ?>


