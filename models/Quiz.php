<?php

class Quiz extends baseQuiz {

	/**
	 * @return	string
	 */
	public function getStatus() {
		return $this->getArchived() ? 'Deleted' : 'Active';
	}

	/**
	 * @return	string
	 */
	public function __toString() {
		return $this->getName();
	}

	/**
	 * @return	User
	 */
	public function getCreatedByUser() {
		return $this->getSession() ? $this->getSession()->getUser() : null;
	}
}