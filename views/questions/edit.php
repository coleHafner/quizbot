
<?php $quiz_param = $quiz instanceof Quiz ? '?quiz_id=' . $quiz->getId() : ''; ?>

<script type="text/javascript">
	$(function() {

		var answersContainer = $('#answers'),
			multiChoiceContainer = answersContainer.find('.multiple-choice-container'),
			multiChoice = multiChoiceContainer.find('ul.multiple-choice'),
			bool = answersContainer.find('ul.true-false');

		function removeAnswer(elem, event) {
			event.preventDefault();
			event.stopPropagation();

			elem.parent().remove();
			var index = 1;

			//reindex correct answer markers
			multiChoice.find('li').each(function() {
				var radio = $(this).find('input[type=radio]');
				radio.val(index);
				index++;
			});

			//make sure an answer is selected
			if (!multiChoice.find('input[type=radio]:checked').length) {
				multiChoice.find('input[type=radio]:first').prop('checked', true);
			}
		}

		$('#question_type').change(function(event) {

			var selectedType = $(this).val();

			if (selectedType == '<?= Question::TYPE_BOOLEAN ?>') {
				multiChoiceContainer.hide();
				bool.show();

			}else if (selectedType == '<?= Question::TYPE_MULTIPLE_CHOICE ?>') {
				multiChoiceContainer.show();
				bool.hide();
			}
		});

		$('.remove-answer').click(function(event) {
			removeAnswer($(this), event);
		});

		$('#add-answer').click(function(event) {
			event.preventDefault();
			event.stopPropagation();

			var nextIndex = multiChoice.find('li').length + 1;

			var radio = $('<input>')
				.attr('type', 'radio')
				.attr('name', 'correct_answer')
				.css('margin-right', '7px')
				.attr('value', nextIndex);

			var input = $('<input>')
				.css('margin-right', '3px')
				.attr('type', 'text')
				.attr('name', 'answers[n' + nextIndex + ']')
				.attr('value', '');

			var remove = $('<a>')
				.attr('href', '#')
				.addClass('button')
				.attr('title', 'Remove Answer');

			remove.button({
				icons: {primary: 'ui-icon-trash'},
				text: false
			});

			remove.css('height', '18px');

			//register click handler
			remove.on('click', function(event) {
				removeAnswer($(this), event);
			});

			var item = $('<li>')
				.append(radio)
				.append(input)
				.append(remove);

			multiChoice.append(item);
		});
	});
</script>

<h1>

	<a href="<?php echo site_url('questions/' . $quiz_param) ?>"
		data-icon="carat-1-e"
		class="button"
		title="View All Questions">
		View All Questions
	</a>

	<?php echo $question->isNew() ? "New" : "Edit" ?> Question
	<?php echo $quiz instanceof Quiz ? ' for ' . $quiz : ''; ?>
</h1>

<form method="post" action="<?php echo site_url('questions/save') ?>">
	<div class="ui-widget-content ui-corner-all ui-helper-clearfix">

		<input type="hidden" name="id" value="<?php echo h($question->getId()) ?>" />

		<?php if (App::isAdmin()) : ?>
			<div class="form-field-wrapper">
				<label class="form-field-label" for="question_quiz_id">Quiz</label>
				<select id="question_quiz_id" name="quiz_id">
					<?php foreach (Quiz::doSelect() as $quiz): ?>
						<option <?php if ($question->getQuizId() === $quiz->getId()) echo 'selected="selected"' ?> value="<?php echo $quiz->getId() ?>"><?php echo $quiz?></option>
					<?php endforeach ?>
				</select>
			</div>
		<?php else : ?>
			<input type="hidden" name="quiz_id" value="<?= $quiz_id; ?>" />
		<?php endif; ?>

		<div class="form-field-wrapper">
			<label class="form-field-label" for="question_type">Type</label>
			<select id="question_type" name="type">
				<?php foreach (Question::getTypes() as $id => $name): ?>
					<option <?php echo $question->getType() === $id ? 'selected' : ''; ?>
						value="<?php echo $id; ?>">
						<?php echo $name?>
					</option>
				<?php endforeach ?>
			</select>
		</div>

		<div class="form-field-wrapper">
			<label class="form-field-label" for="question_text">Question</label>
			<textarea name="text"><?php echo h($question->getText()) ?></textarea>
		</div>

		<div class="form-field-wrapper">
			<label class="form-field-label" for="answers">
				Answers
				<div style="font-weight:normal;">
					(Click button for correct)
				</div>
			</label>

			<div id="answers" class="form-label-offset">

				<div class="multiple-choice-container" style="display:<?php echo $question->isMultipleChoice() || $question->isNew() ? 'block' : 'none'; ?>">
					<ul class="multiple-choice">
						<?php
						if ($question->hasAnswers()) :
							$i = 1;

							foreach($question->getAnswers() as $answer) : ?>
								<li>
									<input type="radio" name="correct_answer" value="<?= $i; ?>"
										<?php echo $question->getCorrectAnswerId() == $answer->getId() ? ' checked' : ''; ?> />
									<input type="text"  name="answers[<?= $answer->getId(); ?>]" value="<?= h($answer->getText()); ?>" />

									<?php if ($i > 2) : ?>
										<a href="#"
										data-icon="trash"
										class="button remove-answer"
										style="height:18px;"
										title="Remove Answer">
										</a>
									<?php endif; ?>
								</li>
							<?php
								$i++;
							endforeach;

							else :
								for ($i = 1; $i <= 4; $i++) : ?>
									<li>
										<input type="radio" name="correct_answer" value="<?= $i; ?>" <?= $i == 1 ? 'checked' : ''; ?> />
										<input type="text"  name="answers[n<?= $i; ?>]" value="<?= !empty($answers['n' . $i]) ? $answers['n' . $i] : ''; ?>" />

										<?php if ($i > 2) : ?>
											<a href="#"
											data-icon="trash"
											class="button remove-answer"
											style="height:18px;"
											title="Remove Answer">
											</a>
										<?php endif; ?>
									</li>
							<?php
								endfor;
							endif;
						?>
					</ul>

					<a href="#"
						id="add-answer"
						data-icon="plusthick"
						class="button"
						title="Add Answer">
						Add Answer
					</a>

				</div>

				<ul class="true-false" style="display:<?php echo $question->isTrueFalse() ? 'block' : 'none'; ?>" >
					<li>
						<label>
							<input type="radio"
								name="correct_answer_bool" value="<?= Question::ANSWER_BOOL_TRUE; ?>"
								<?php echo $question->getCorrectAnswerBoolean() == Question::ANSWER_BOOL_TRUE || $question->isNew() ? 'checked' : ''; ?> />True
						</label>
					</li>
					<li>
						<label>
							<input type="radio"
								name="correct_answer_bool" value="<?= Question::ANSWER_BOOL_FALSE; ?>"
								<?php echo $question->getCorrectAnswerBoolean() == Question::ANSWER_BOOL_FALSE ? 'checked' : ''; ?> />False
						</label>
					</li>
				</ul>

			</div>
		</div>
	</div>

	<div class="form-action-buttons ui-helper-clearfix">
		<span class="button" data-icon="disk">
			<input type="submit" value="Save and Add Next" />
		</span>
		<?php if (isset($_SERVER['HTTP_REFERER'])): ?>
		<a class="button" data-icon="cancel" href="<?php echo $_SERVER['HTTP_REFERER'] ?>">
			Cancel
		</a>
		<?php endif ?>
	</div>
</form>