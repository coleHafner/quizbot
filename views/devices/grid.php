<?php
$_get_args = (array) @$_GET;

if (isset($_REQUEST['dir'])) {
	unset($_get_args['dir']);
} elseif (isset($_REQUEST['order_by'])) {
	$_get_args['dir'] = 'DESC';
}
?>
<table class="object-grid device-grid" cellspacing="0">
	<thead>
		<tr>
			<th class="ui-widget-header ui-corner-tl">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Device::ID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Device::ID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Id
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Device::SESSION_ID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Device::SESSION_ID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Session
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Device::CLASSROOM_ID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Device::CLASSROOM_ID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Classroom
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Device::UUID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Device::UUID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Uuid
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Device::NICKNAME))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Device::NICKNAME): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Nickname
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Device::ARCHIVED))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Device::ARCHIVED): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Archived
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Device::CREATED))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Device::CREATED): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Created
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Device::UPDATED))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Device::UPDATED): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Updated
				</a>
			</th>
			<th class="ui-widget-header grid-action-column ui-corner-tr">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($devices as $key => $device): ?>
		<tr class="<?php echo ($key & 1) ? 'even' : 'odd' ?> ui-widget-content">
			<td><?php echo h($device->getId()) ?>&nbsp;</td>
			<td><?php echo h($device->getSessionRelatedBySessionId()) ?>&nbsp;</td>
			<td><?php echo h($device->getClassroomRelatedByClassroomId()) ?>&nbsp;</td>
			<td><?php echo h($device->getUuid()) ?>&nbsp;</td>
			<td><?php echo h($device->getNickname()) ?>&nbsp;</td>
			<td><?php echo h($device->getArchived(VIEW_TIMESTAMP_FORMAT)) ?>&nbsp;</td>
			<td><?php echo h($device->getCreated(VIEW_TIMESTAMP_FORMAT)) ?>&nbsp;</td>
			<td><?php echo h($device->getUpdated(VIEW_TIMESTAMP_FORMAT)) ?>&nbsp;</td>
			<td>
				<a
					class="button"
					data-icon="search"
					title="Show Device"
					href="<?php echo site_url('devices/show/' . $device->getId()) ?>">
					Show
				</a>
				<a
					class="button"
					data-icon="pencil"
					title="Edit Device"
					href="<?php echo site_url('devices/edit/' . $device->getId()) ?>">
					Edit
				</a>
				<a
					class="button"
					data-icon="trash"
					title="Delete Device"
					href="#"
					onclick="if (confirm('Are you sure?')) { window.location.href = '<?php echo site_url('devices/delete/' . $device->getId()) ?>'; } return false">
					Delete
				</a>
				<a
					class="button"
					data-icon="carat-1-e"
					href="<?php echo site_url('quiz-session-attempts?device_id=' . $device->getId()) ?>">
					Quiz Session Attempts
				</a>
			</td>
		</tr>
<?php endforeach ?>
	</tbody>
</table>