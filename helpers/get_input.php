<?php

function get_input($msg) {
	fwrite(STDOUT, "$msg: ");
	return trim(fgets(STDIN));
}
