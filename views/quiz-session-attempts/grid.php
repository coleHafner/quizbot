<?php
$_get_args = (array) @$_GET;

if (isset($_REQUEST['dir'])) {
	unset($_get_args['dir']);
} elseif (isset($_REQUEST['order_by'])) {
	$_get_args['dir'] = 'DESC';
}
?>
<table class="object-grid quiz_session_attempt-grid" cellspacing="0">
	<thead>
		<tr>
			<th class="ui-widget-header ui-corner-tl">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => QuizSessionAttempt::ID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == QuizSessionAttempt::ID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Id
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => QuizSessionAttempt::QUIZ_SESSION_QUESTION_ID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == QuizSessionAttempt::QUIZ_SESSION_QUESTION_ID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Question
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => QuizSessionAttempt::DEVICE_ID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == QuizSessionAttempt::DEVICE_ID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Device #
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => QuizSessionAttempt::ANSWER_TEXT))) ?>">
					<?php if ( @$_REQUEST['order_by'] == QuizSessionAttempt::ANSWER_TEXT): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Answer
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => QuizSessionAttempt::CREATED))) ?>">
					<?php if ( @$_REQUEST['order_by'] == QuizSessionAttempt::CREATED): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Created
				</a>
			</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($quiz_session_attempts as $key => $quiz_session_attempt): ?>
		<tr class="<?php echo ($key & 1) ? 'even' : 'odd' ?> ui-widget-content">
			<td><?php echo h($quiz_session_attempt->getId()) ?>&nbsp;</td>
			<td><?php echo h($quiz_session_attempt->getQuestionText()) ?>&nbsp;</td>
			<td><?php echo h($quiz_session_attempt->getDevice()) ?>&nbsp;</td>
			<td><?php echo h($quiz_session_attempt->getAnswerText()) ?>&nbsp;</td>
			<td><?php echo h($quiz_session_attempt->getCreated(VIEW_TIMESTAMP_FORMAT)) ?>&nbsp;</td>
		</tr>
<?php endforeach ?>
	</tbody>
</table>