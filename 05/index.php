<?php

function getMessage(array $Matrix, array $Moves, int $Part = 1): string
{
	foreach ($Moves as $step_number => $step) {
		$move_crates_number = $step['move'];
		$from_row_number = $step['from'];
		$to_row_number = $step['to'];

		// choice x elements from top of row
		$elements = array_slice($Matrix[$from_row_number], -(int) $move_crates_number);

		if ($Part === 1) {
			krsort($elements, SORT_NUMERIC);
		}

		// delete elements from parent row
		array_splice($Matrix[$from_row_number], count($Matrix[$from_row_number]) - $move_crates_number, $move_crates_number);

		// add to new row
		$Matrix[$to_row_number] = array_merge($Matrix[$to_row_number], $elements);
	}

	$message = '';
	foreach ($Matrix as $row){
		$message .= end($row);
	}

	return $message;
}

function getMatrix(string $Matrix): array
{
	$matrix_lines = explode("\n", $Matrix);

	$result = [];
	foreach ($matrix_lines as $matrix_line) {
		$line_characters = mb_str_split($matrix_line,4);

		foreach ($line_characters as $row_number => $characters)  {
			// Rows don't start with 0 ... lol
			$row_number = $row_number + 1;

			// Find crate
			preg_match('/[a-zA-Z]+/', $characters,$letter);

			if (!empty($letter[0])) {
				// !!! READ ME !!!
				// Insert crate to specific row - 0 is bottom of row ... the highest number is top of row
				!empty($result[$row_number])
					? array_unshift($result[$row_number], $letter[0])
					: $result[$row_number][] = $letter[0];
			}
		}
	}

	// Make it from first row for easier work
	ksort($result, SORT_NUMERIC);

	return $result;
}

function getMoves(string $Moves): array
{
	$lines = explode("\n", $Moves);

	$result = [];
	foreach ($lines as $line_number => $line) {
		// Find all orders
		preg_match_all('/(.*?)\s[0-9]+/', $line, $orders);

		// Put orders to array for easier work
		foreach ($orders[0] as $order) {
			list($move, $step) = explode(' ', trim($order));
			// Which line to move which way about how many steps
			$result[$line_number][$move] = $step;
		}
	}

	return $result;
}

list($matrix, $moves) = explode("\n\n", file_get_contents('input.txt'));

$matrix_array = getMatrix($matrix);
$moves_array = getMoves($moves);

var_dump('A - ' . getMessage($matrix_array, $moves_array));
var_dump('B - ' . getMessage($matrix_array, $moves_array, 2));