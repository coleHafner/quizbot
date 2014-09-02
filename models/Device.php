<?php

class Device extends baseDevice {
	public function __toString() {
		return $this->getUuid();
	}
}