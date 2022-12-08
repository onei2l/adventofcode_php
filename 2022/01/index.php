<?php

$content = file_get_contents('input.txt');

$blocks = explode("\n\n", $content);

$calories = [];
foreach ($blocks as $block){
	$numbers = explode("\n", $block);

	$calories[] = array_sum($numbers);
}

echo max($calories);

// B
rsort($calories, SORT_NUMERIC);

echo ($calories[0] + $calories[1] + $calories[2]);