<?php
$_get_args = (array) @$_GET;

if (isset($_REQUEST['dir'])) {
	unset($_get_args['dir']);
} elseif (isset($_REQUEST['order_by'])) {
	$_get_args['dir'] = 'DESC';
}
?>
<table class="object-grid question-grid" cellspacing="0">
	<thead>
		<tr>

			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Question::ID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Question::ID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Id
				</a>
			</th>

			<?php if (!$quiz && !App::isAdmin()) : ?>
				<th class="ui-widget-header ">
					<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Question::QUIZ_ID))) ?>">
						<?php if ( @$_REQUEST['order_by'] == Question::QUIZ_ID): ?>
							<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
						<?php endif ?>
						Quiz
					</a>
				</th>
			<?php endif; ?>

			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Question::TEXT))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Question::TEXT): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Text
				</a>
			</th>

			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Question::TYPE))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Question::TYPE): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Type
				</a>
			</th>

			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Question::SESSION_ID))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Question::SESSION_ID): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Created By
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Question::CREATED))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Question::CREATED): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Created On
				</a>
			</th>
			<th class="ui-widget-header ">
				<a href="?<?php echo http_build_query(array_merge($_get_args, array('order_by' => Question::ARCHIVED))) ?>">
					<?php if ( @$_REQUEST['order_by'] == Question::ARCHIVED): ?>
						<span class="ui-icon ui-icon-carat-1-<?php echo isset($_REQUEST['dir']) ? 's' : 'n' ?>"></span>
					<?php endif ?>
					Status
				</a>
			</th>
			<th class="ui-widget-header grid-action-column ui-corner-tr">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($questions as $key => $question): ?>
		<tr class="<?php echo ($key & 1) ? 'even' : 'odd' ?> ui-widget-content">

			<td><?= $question->getId(); ?></td>

			<?php if (!$quiz && !App::isAdmin()) : ?>
				<td><?php echo h($question->getQuizRelatedByQuizId()) ?>&nbsp;</td>
			<?php endif; ?>

			<td><?php echo h($question->getText()) ?>&nbsp;</td>
			<td><?php echo h($question->getTypeName()) ?>&nbsp;</td>
			<td><?php echo $question->getCreatedByUser() ? h($question->getCreatedByUser()) : '-'; ?>&nbsp;</td>
			<td><?php echo h($question->getCreated(VIEW_TIMESTAMP_FORMAT)) ?>&nbsp;</td>
			<td><?php echo h($question->getStatus()) ?>&nbsp;</td>
			<td>
				<a
					class="button"
					data-icon="search"
					title="Show Question"
					href="<?php echo site_url('questions/show/' . $question->getId()) ?>">
					Show
				</a>

				<?php if (App::can(Perm::ACTION_EDIT, $question)) : ?>
					<a class="button"
						data-icon="pencil"
						title="Edit Question"
						href="<?php echo site_url('questions/edit/' . $question->getId()) ?>">
						Edit
					</a>
				<?php endif; ?>

				<?php
				View::load('partials/delete-button', array(
					'record' => $question,
					'record_type' => 'Question',
					'delete_path' => 'questions'
				));
				?>

			</td>
		</tr>
<?php endforeach ?>
	</tbody>
</table>