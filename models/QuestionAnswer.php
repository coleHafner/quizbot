<?php

class QuestionAnswer extends baseQuestionAnswer {
	function __toString() {
		return $this->getText();
	}
}