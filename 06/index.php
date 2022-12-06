<?php

$string = file_get_contents('input.txt');

$string_length = strlen($string);

$sequence_length = 14;

function getStartPacket(string $String, int $StringLength, int $SequenceLength): int
{
	for ($i = 0; $i <= $StringLength; $i++) {
		$new_string = substr($String, $i, $SequenceLength);

		// preg_match idea / a little help from https://www.reddit.com/r/adventofcode/comments/zdw0u6/comment/iz49klm/
		if (!preg_match('/([a-z]).*?\1/', $new_string)) {
			return $i + $SequenceLength;
		}
	}

	return 0;
}

var_dump('A - ' . getStartPacket($string, $string_length, 4));

var_dump('B - ' . getStartPacket($string, $string_length, 14));