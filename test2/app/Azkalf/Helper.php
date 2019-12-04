<?php

namespace Azkalf;

class Helper 
{
	public function get_excel_files($directory)
	{
		return preg_grep('~\.(xlsx|xls)$~', scandir($directory));;
	}

	public function get_rules($headers)
	{
		$rules = []; // 0 = allow all condition, 1 = required, 2 = not contain any space, 3 = required and not contain any space
		foreach ($headers as $key => $header) {
			if (substr($header, -1) == '*' && substr($header, 0, 1) != '#') {
				$rules[$key] = 1;
			} else if (substr($header, -1) != '*' && substr($header, 0, 1) == '#') {
				$rules[$key] = 2;
			} else if (substr($header, -1) == '*' && substr($header, 0, 1) == '#') {
				$rules[$key] = 3;
			} else {
				$rules[$key] = 0;
			}
		}
		return $rules;
	}
}