<?php

require 'vendor/autoload.php';
use Azkalf\Helper;
use PhpOffice\PhpSpreadsheet\IOFactory;

$excels = Helper::get_excel_files('sources'); // get any xlsx or xls files in a directory
if ($excels) {
	foreach ($excels as $excel) {
		echo '<h2>Filename : '.$excel.'</h2>';
		// Start Reading Excel File
		$source = 'sources/'.$excel;
		$reader = IOFactory::createReaderForFile($source);
		$reader->setReadDataOnly(true);
		$spreadsheet = $reader->load($source);
		$worksheets = $spreadsheet->getSheetNames();
		foreach ($worksheets as $sheetName) {
			echo '<h3>Worksheet : '.$sheetName.'</h3>';
			echo '<table border="1">';
			echo '<tr><th>Row</th><th>Error</th></tr>';
			$worksheet = $spreadsheet->getSheetByName($sheetName);
			$rows = $worksheet->toArray();
			if ($rows) {
				$headers = $rows[0]; // get header columns
				$rules = Helper::get_rules($headers); // get rules from header columns
				foreach ($rows as $key => $row) {
					if ($key > 0) { // start after header columns
						$errors = [];
						foreach ($row as $k => $value) {
							$header = str_replace(['#', '*'], '', $headers[$k]);
							if ($rules[$k] == 1 && is_null($value)) { // rules 1 = required
								$errors[] = 'Missing value in '.$header;
							} else if ($rules[$k] == 2 && preg_match('/ /', $value) > 0) { // rules 2 = not contain any space
								$errors[] = $header.' should not contain any space';
							} else if ($rules[$k] == 3 && (preg_match('/ /', $value) > 0 || is_null($value))) { // rules 3 = required and not contain any space
								$errors[] = $header.' cannot be null and should not contain any space';
							}
						}
						if ($errors) {
							$error = implode(', ', $errors);
							echo '<tr><td>'.$key.'</td><td>'.$error.'</td></tr>';
						}
					}
				}
			}
			echo '</table>';
		}
	}
}