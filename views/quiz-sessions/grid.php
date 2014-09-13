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
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => QuizSession::ID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == QuizSession::ID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Id
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => 'QuizName'))) ?>">
					<?php if ( @$_REQUEST['order_by'] == 'QuizName'): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Quiz
				</a>
			</th>

			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => 'Correct'))) ?>">
					<?php if ( @$_REQUEST['order_by'] == 'Correct'): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Correct
				</a>
			</th>

			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => QuizSession::CLOSED))) ?>">
					<?php if ( @$_REQUEST['order_by'] == QuizSession::OPENED): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Duration (mins)
				</a>
			</th>


			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => QuizSession::OPENED))) ?>">
					<?php if ( @$_REQUEST['order_by'] == QuizSession::OPENED): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Opened
				</a>
			</th>

			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => QuizSession::SESSION_ID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == QuizSession::SESSION_ID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Created By
				</a>
			</th>

			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => 'Status'))) ?>">
					<?php if ( @$_REQUEST['order_by'] == 'Status'): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Status
				</a>
			</th>
			<th class="ui-widget-header grid-action-column ui-corner-tr">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($quiz_sessions as $key => $quiz_session): ?>
		<tr class="<?php echo ($key & 1) ? 'even' : 'odd' ?> ui-widget-content">
			<td><?php echo h($quiz_session->getId()) ?>&nbsp;</td>
			<td><?php echo h($quiz_session) ?>&nbsp;</td>
			<td><?= $quiz_session->getPercentageCorrect(); ?></td>
			<td><?= $quiz_session->getDuration() ? h($quiz_session->getDuration()) : '-'; ?>&nbsp;</td>
			<td><?php echo h($quiz_session->getOpened(VIEW_TIMESTAMP_FORMAT)) ?>&nbsp;</td>
			<td><?php echo $quiz_session->getCreatedByUser() ? h($quiz_session->getCreatedByUser()) : '-'; ?></td>
			<td><?php echo h($quiz_session->getStatus()) ?>&nbsp;</td>
			<td>
				<?php if (App::can(Perm::ACTION_EDIT, $quiz_session) && !$quiz_session->getClosed()) : ?>
					<a
						class="button"
						data-icon="circle-triangle-e"
						title="Resume"
						href="<?php echo site_url('quiz-sessions/show/' . $quiz_session->getId() . '/1') ?>">
						&nbsp;Resume
					</a>
				<?php endif; ?>

				<?php if (App::can(Perm::ACTION_EDIT, $quiz_session) && $quiz_session->getClosed()) : ?>
					<a
						class="button"
						data-icon="star"
						href="<?php echo site_url('quiz-sessions/results/' . $quiz_session->getId()) ?>">
						&nbsp;Results
					</a>
				<?php endif; ?>
			</td>
		</tr>
<?php endforeach ?>
	</tbody>
</table>