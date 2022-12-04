<?php

$lines = explode("\n", file_get_contents('input.txt'));

$overlap_unique = $overlap_total= 0;
foreach ($lines as $line) {
	list($first_pair, $second_pair) = explode(',', $line);

	list($first_section_first_number, $first_section_second_number) = explode('-', $first_pair);
	list($second_section_first_number, $second_section_second_number) = explode('-', $second_pair);

	if (
		($first_section_first_number <= $second_section_first_number)
		&& ($second_section_second_number <= $first_section_second_number)
		|| ($second_section_first_number <= $first_section_first_number)
		&& ($first_section_second_number <= $second_section_second_number)
	) {
		$overlap_unique++;
	}

	// B

	if (array_intersect(
			range($first_section_first_number, $first_section_second_number),
			range($second_section_first_number, $second_section_second_number))
	) {
		$overlap_total++;
	}
}

var_dump($overlap_unique);

var_dump($overlap_total);