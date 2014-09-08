<?php
$_get_args = (array) @$_GET;

if (isset($_REQUEST['dir'])) {
	unset($_get_args['dir']);
} elseif (isset($_REQUEST['order_by'])) {
	$_get_args['dir'] = 'DESC';
}
?>

<table class="object-grid classroom-grid" cellspacing="0">
	<thead>
		<tr>
			<th class="ui-widget-header ui-corner-tl">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Classroom::ID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Classroom::ID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Id
				</a>
			</th>

			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Classroom::NAME))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Classroom::NAME): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Name
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => 'teacher'))) ?>">
					<?php if ( @$_REQUEST['order_by'] == 'teacher'): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Teacher
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Classroom::ARCHIVED))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Classroom::ARCHIVED): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Status
				</a>
			</th>

			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Classroom::SESSION_ID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Classroom::SESSION_ID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Created By
				</a>
			</th>

			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Classroom::CREATED))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Classroom::CREATED): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Created On
				</a>
			</th>
			<th class="ui-widget-header grid-action-column ui-corner-tr">&nbsp;</th>
		</tr>
	</thead>
	<tbody>

<?php foreach ($classrooms as $key => $classroom): ?>
		<tr class="<?php echo ($key & 1) ? 'even' : 'odd' ?> ui-widget-content">
			<td><?php echo h($classroom->getId()) ?>&nbsp;</td>
			<td><?php echo h($classroom->getName()) ?>&nbsp;</td>
			<td><?php echo $classroom->getTeacher() ? h($classroom->getTeacher()) : '-'; ?>&nbsp;</td>
			<td><?php echo h($classroom->getStatus()) ?>&nbsp;</td>
			<td><?php echo h($classroom->getCreatedByUser()) ?>&nbsp;</td>
			<td><?php echo h($classroom->getCreated(VIEW_TIMESTAMP_FORMAT)) ?>&nbsp;</td>
			<td>
				<?php if (App::can(Perm::ACTION_EDIT, $classroom)) : ?>
					<a
						class="button"
						data-icon="search"
						title="Show Classroom"
						href="<?php echo site_url('classrooms/show/' . $classroom->getId()) ?>">
						Show
					</a>
				<?php endif; ?>

				<?php if (App::can(Perm::ACTION_EDIT, $classroom)) : ?>
					<a
						class="button"
						data-icon="pencil"
						title="Edit Classroom"
						href="<?php echo site_url('classrooms/edit/' . $classroom->getId()) ?>">
						Edit
					</a>
				<?php endif; ?>

				<?php
				View::load('partials/delete-button', array(
					'record' => $classroom,
					'record_type' => 'Classroom',
					'delete_path' => 'classrooms'
				));
				?>
			</td>
		</tr>
<?php endforeach ?>
	</tbody>
</table>