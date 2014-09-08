<?php

class Device extends baseDevice {

	const DEFAULT_COLOR = '#5484ed';

	public function __toString() {
		return $this->getUuid();
	}

	/**
	 * Returns default color if new.
	 * @return	string
	 */
	public function getColor() {
		return $this->isNew() ? self::DEFAULT_COLOR : parent::getColor();
	}
}