<?php

$trees_lines = explode("\n", file_get_contents('input.txt'));

$trees_lines_total = count($trees_lines);
$total = 0;
$scenic = [];

for ($line = 0; $line < $trees_lines_total; $line++) {
	$trees_in_line = mb_str_split($trees_lines[$line]);

	$total_trees_in_line = count($trees_in_line);

	for ($tree_position_in_line = 0; $tree_position_in_line < $total_trees_in_line; $tree_position_in_line++) {
		$scenic[] = scenic($trees_in_line[$tree_position_in_line],$tree_position_in_line, $line, $trees_in_line);

		if (inDirection($trees_in_line[$tree_position_in_line],$tree_position_in_line, $line, $trees_in_line)) {
			$total++;
		}
	}
}

var_dump('A - ' . $total);
var_dump('B - ' . max($scenic));

function scenic(int $ActualTree, int $ActualPosition, int $ActualLine, array $TreesInLine): int
{
	global $trees_lines, $trees_lines_total;

	$up = 0;
	for ($i = $ActualLine - 1; $i > -1; $i--) {
		$up++;

		if ($trees_lines[$i][$ActualPosition] >= $ActualTree) {
			break;
		}
	}

	$down = 0;
	for ($i = $ActualLine + 1; $i < $trees_lines_total; $i++) {
		$down++;

		if ($trees_lines[$i][$ActualPosition] >= $ActualTree) {
			break;
		}
	}

	$left = 0;
	for ($i = $ActualPosition - 1; $i > -1; $i--) {
		$left++;

		if ($TreesInLine[$i] >= $ActualTree) {
			break;
		}
	}

	$right = 0;
	for ($i = $ActualPosition + 1; $i < count($TreesInLine); $i++) {
		$right++;

		if ($TreesInLine[$i] >= $ActualTree) {
			break;
		}
	}

	return ($up * $down * $left * $right);
}

function inDirection(int $ActualTree, int $ActualPosition, int $ActualLine, array $TreesInLine): bool
{
	global $trees_lines, $trees_lines_total;

	$up = true;
	for ($i =0; $i < $ActualLine; $i++) {
		if ($trees_lines[$i][$ActualPosition] >= $ActualTree) {
			$up = false;

			break;
		}
	}

	$down = true;
	for ($i = $ActualLine + 1; $i<$trees_lines_total; $i++) {
		if ($trees_lines[$i][$ActualPosition] >= $ActualTree) {
			$down = false;

			break;
		}
	}

	$left = true;
	for ($i = 0; $i < $ActualPosition; $i++) {
		if ($TreesInLine[$i] >= $ActualTree) {
			$left= false;

			break;
		}
	}

	$right = true;
	for ($i = $ActualPosition + 1; $i < count($TreesInLine); $i++) {
		if ($TreesInLine[$i] >= $ActualTree) {
			$right = false;

			break;
		}
	}

	return $left || $right || $up || $down;
}
