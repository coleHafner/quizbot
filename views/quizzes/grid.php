<?php
$_get_args = (array) @$_GET;

if (isset($_REQUEST['dir'])) {
	unset($_get_args['dir']);
} elseif (isset($_REQUEST['order_by'])) {
	$_get_args['dir'] = 'DESC';
}
?>
<table class="object-grid quiz-grid" cellspacing="0">
	<thead>
		<tr>
			<th class="ui-widget-header ui-corner-tl">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Quiz::ID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Quiz::ID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Id
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Quiz::NAME))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Quiz::NAME): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Name
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Quiz::SESSION_ID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Quiz::SESSION_ID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Created By
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Quiz::CREATED))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Quiz::CREATED): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Created On
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Quiz::ARCHIVED))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Quiz::ARCHIVED): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Status
				</a>
			</th>
			<th class="ui-widget-header grid-action-column ui-corner-tr">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($quizzes as $key => $quiz): ?>
		<tr class="<?php echo ($key & 1) ? 'even' : 'odd' ?> ui-widget-content">
			<td><?php echo h($quiz->getId()) ?>&nbsp;</td>
			<td><?php echo h($quiz->getName()) ?>&nbsp;</td>
			<td><?php echo $quiz->getCreatedByUser() ? h($quiz->getCreatedByUser()) : '-'; ?></td>
			<td><?php echo h($quiz->getCreated(VIEW_TIMESTAMP_FORMAT)) ?>&nbsp;</td>
			<td><?php echo h($quiz->getStatus()) ?>&nbsp;</td>
			<td>
				<a
					class="button"
					data-icon="search"
					title="Show Quiz"
					href="<?php echo site_url('quizzes/show/' . $quiz->getId()) ?>">
					Show
				</a>

				<?php if (App::can(Perm::ACTION_EDIT, $quiz)) : ?>
					<a
						class="button"
						data-icon="pencil"
						title="Edit Quiz"
						href="<?php echo site_url('quizzes/edit/' . $quiz->getId()) ?>">
						Edit
					</a>
				<?php endif; ?>

				<?php
				View::load('partials/delete-button', array(
					'record' => $quiz,
					'record_type' => 'Quiz',
					'delete_path' => 'quizzes'
				));
				?>

				<?php if (App::can(Perm::ACTION_EDIT, $quiz)) : ?>
					<a
						class="button"
						data-icon="carat-1-e"
						href="<?php echo site_url('questions?quiz_id=' . $quiz->getId()) ?>">
						Questions
					</a>
				<?php endif; ?>

				<?php if (App::hasPerm(Perm::RESULTS_MANAGE)) : ?>
					<a
						class="button"
						data-icon="carat-1-e"
						href="<?php echo site_url('quiz-session-attempts?quiz_id=' . $quiz->getId()) ?>">
						Results
					</a>
				<?php endif; ?>
			</td>
		</tr>
<?php endforeach ?>
	</tbody>
</table>