<?php

$ssh_data = explode(PHP_EOL, file_get_contents('input.txt'));

$tree = [];$actual_dir='';

foreach ($ssh_data as $line) {
	if (str_contains($line, '$ cd')) {

		[$command, $dir] = explode('$ cd ', $line);
var_dump($actual_dir);

		if (!empty($tree[$actual_dir])) {
			$tree[$actual_dir][] = trim($dir);
		} else {
			$tree[trim($dir)]=['.'];
		}

		$actual_dir = trim($dir);
		$previous_command = $command;
	}

}

var_dump($tree);