<?php

$lines = explode("\n", file_get_contents('input.txt'));

$alphabet = array_merge(range('a', 'z'), range('A', 'Z'));

$result = 0;
foreach ($lines as $line) {
	$line_split_array = mb_str_split($line, strlen($line) / 2);

	foreach (mb_str_split($line_split_array[0]) as $character) {
		if(str_contains($line_split_array[1], $character)) {


			break;
		}
	}
}
var_dump($result);

// B

$result_b = 0;
$i = 1;
$a = [];
foreach ($lines as $line) {
	$a = array_merge($a, [$line]);

	if (!($i % 3)) {
		$unique = array_intersect(array_unique(mb_str_split($a[0])), array_unique(mb_str_split($a[1])), array_unique(mb_str_split($a[2])));

		$result_b += array_search(reset($unique), $alphabet) + 1;

		$a = [];
	}

	$i++;;
}
var_dump($result_b);
