<?php

$lines = explode("\n", file_get_contents('input.txt'));

//rock
$a = $x = 1;
//paper
$b = $y = 2;
//scissors
$c = $z = 3;

$draw = 3;
$win = 6;

$total = 0;
foreach ($lines as $line) {
	$opponent = strtolower($line[0]);
	$me = strtolower($line[2]);

	$status = 0;
	if (${$opponent} == ${$me}) {
		$status = $draw;
	} elseif (in_array($opponent . $me, ['ay', 'bz', 'cx'])) {
		$status = $win;
	}

	$total += $status + ${$me};
}
var_dump($total);

// B
$need_lost = 'x';
$need_draw = 'y';
$need_win = 'z';

$need_total = 0;
foreach ($lines as $line) {
	$opponent = strtolower($line[0]);
	$me = strtolower($line[2]);

	$status = 0;
	if ($me == $need_draw) {
		$status = $draw + ${$opponent};
	} elseif ($me == $need_win) {
		$me_for_win = match($opponent) {'a' => 'y', 'b' => 'z', 'c' => 'x',};

		$status = $win + ${$me_for_win};
	} elseif ($me === $need_lost) {
		$me_for_lost = match($opponent) {'a' => 'z', 'b' => 'x', 'c' => 'y',};

		$status = ${$me_for_lost};
	}

	$need_total += $status;
}
var_dump($need_total);