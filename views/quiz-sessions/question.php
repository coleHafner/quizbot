<script type="text/javascript">

function autosizeAnswers() {
	var answers = $('.answer-canvas'),
		viewportHeight = $(window).height(),
		question = $('.question-canvas'),
		questionTopOffset = parseInt(question.offset().top),
		questionHeight = question.outerHeight(),
		numAnswers = answers.length,
		remainingHeight = viewportHeight - (questionTopOffset + questionHeight) - 40,
		answerHeight = remainingHeight,
		customHeights = [];

		if (numAnswers > 2 && numAnswers <= 4) {
			answerHeight = parseInt(answerHeight/2);

		}else if(numAnswers > 4 && numAnswers <= 6) {
			answerHeight = parseInt(answerHeight/3) - 10;
		}

		var halfAnswerHeight = parseInt(answerHeight/2);
		answers.height(0);

		for(var i = 0; i < numAnswers; i++) {

			var curAnswer = $('.answer-' + i)
			curAnswer.find('.inner').css('padding', 0);

			var outerHeight = curAnswer.outerHeight(),
				halfOuterHeight = parseInt(outerHeight/2),
				paddingTop = (halfAnswerHeight - halfOuterHeight);
			//console.log('outerHeight', outerHeight, 'halfOuterHeight', halfOuterHeight, 'paddingTop', paddingTop);
			curAnswer.find('.inner').css('paddingTop', paddingTop);
		}

	//console.log('remainingHeight', remainingHeight, 'viewportheight', viewportHeight, 'questionHeight', questionHeight, 'questionTopOffset', questionTopOffset, 'answerHeight: ', answerHeight);
	answers.height(answerHeight);
}

$(function() {
	autosizeAnswers();
});

$(window).resize(function() {
	autosizeAnswers();
});

</script>
<h1>

	<?= $manager->getQuiz(); ?> - Question <?= $question_num; ?>

	<?php if (App::can(Perm::ACTION_EDIT, $quiz_session)) : ?>

		<a href="<?= site_url('quiz-sessions/switch-question/' . $quiz_session->getId() . '/next'); ?>"
			class="button" data-icon="<?= !$next_question ? 'circle-check' : 'circle-triangle-e'; ?>">
			<?= !$next_question ? 'Finish Quiz' : 'Next Question'; ?>
		</a>

		<?php if ($prev_question) : ?>
			<a href="<?= site_url('quiz-sessions/switch-question/' . $quiz_session->getId() . '/prev'); ?>"
				class="button" data-icon="circle-triangle-w">
				Previous Question
			</a>
		<?php endif; ?>

	<?php endif; ?>
</h1>

<div class="ui-widget-content ui-corner-all ui-helper-clearfix question-canvas">
	<?= $question; ?>
</div>


<div class="ui-helper-clearfix">
	<?php foreach ($answers as $i => $qa) : ?>
		<div class="answer-canvas <?= $i%2 ? 'pull-right' : 'pull-left'; ?> <?= ' answer-' . $i; ?>">
			<div class="inner"><?= $qa; ?></div>
		</div>
	<?php endforeach; ?>
</div>
