<?php
$_get_args = (array) @$_GET;

if (isset($_REQUEST['dir'])) {
	unset($_get_args['dir']);
} elseif (isset($_REQUEST['order_by'])) {
	$_get_args['dir'] = 'DESC';
}
?>
<table class="object-grid user-grid" cellspacing="0">
	<thead>
		<tr>
			<th class="ui-widget-header ui-corner-tl">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => User::ID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == User::ID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Id
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => User::EMAIL))) ?>">
					<?php if ( @$_REQUEST['order_by'] == User::EMAIL): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Email
				</a>
			</th>

			<th class="ui-widget-header ui-corner-tl">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => User::FIRST_NAME))) ?>">
					<?php if ( @$_REQUEST['order_by'] == User::FIRST_NAME): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					First Name
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => User::LAST_NAME))) ?>">
					<?php if ( @$_REQUEST['order_by'] == User::LAST_NAME): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Last Name
				</a>
			</th>

			<?php if (App::isAdmin()) : ?>
				<th class="ui-widget-header ">
					<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => User::TYPE))) ?>">
						<?php if ( @$_REQUEST['order_by'] == User::TYPE): ?>
							<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
						<?php endif ?>
						Type
					</a>
				</th>
			<?php endif; ?>


			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => User::SESSION_ID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == User::SESSION_ID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Created By
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => User::CREATED))) ?>">
					<?php if ( @$_REQUEST['order_by'] == User::CREATED): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Created On
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => User::LAST_LOGIN))) ?>">
					<?php if ( @$_REQUEST['order_by'] == User::LAST_LOGIN): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Last Login
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => User::ARCHIVED))) ?>">
					<?php if ( @$_REQUEST['order_by'] == User::ARCHIVED): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Status
				</a>
			</th>
			<th class="ui-widget-header grid-action-column ui-corner-tr">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($users as $key => $user): ?>
		<tr class="<?php echo ($key & 1) ? 'even' : 'odd' ?> ui-widget-content">
			<td><?php echo h($user->getId()) ?>&nbsp;</td>
			<td><?php echo h($user->getEmail()) ?>&nbsp;</td>
			<td><?php echo h($user->getFirstName()) ?>&nbsp;</td>
			<td><?php echo h($user->getLastName()) ?>&nbsp;</td>

			<?php if (App::isAdmin()) : ?>
				<td><?php echo h($user->getTypeName()) ?>&nbsp;</td>
			<?php endif; ?>

			<td><?php echo $user->getCreatedByUser() ? h($user->getCreatedByUser()) : '-'; ?>&nbsp;</td>
			<td><?php echo h($user->getCreated(VIEW_TIMESTAMP_FORMAT)) ?>&nbsp;</td>
			<td><?php echo $user->getLastLogin() ? h($user->getLastLogin(VIEW_TIMESTAMP_FORMAT)) : '-' ?>&nbsp;</td>
			<td><?php echo $user->getStatus(); ?>&nbsp;</td>

			<td>

				<?php if (App::can(Perm::ACTION_EDIT, $user)) : ?>
					<a
						class="button"
						data-icon="search"
						title="Show User"
						href="<?php echo site_url($view_dir . '/show/' . $user->getId()) ?>">
						Show
					</a>
				<?php endif; ?>

				<?php if (App::can(Perm::ACTION_EDIT, $user)) : ?>
					<a
						class="button"
						data-icon="pencil"
						title="Edit User"
						href="<?php echo site_url($view_dir . '/edit/' . $user->getId()) ?>">
						Edit
					</a>
				<?php endif; ?>

				<?php
				View::load('partials/delete-button', array(
					'record' => $user,
					'record_type' => $user_type,
					'delete_path' => $view_dir
				));
				?>

			</td>
		</tr>
<?php endforeach ?>
	</tbody>
</table>