<?php

$string = file_get_contents('input.txt');

function getFloor(string $String, int $Part)
{
	$i = $f = 0;
	foreach (mb_str_split($String) as $character) {
		$f++;

		($character === '(') ? $i++ : $i--;

		if (($Part === 2) && ($i === -1)) {
			return $f;
		}
	}

	return $i;
}
var_dump('A - ' . getFloor($string, 1));

var_dump('B - ' . getFloor($string, 2));