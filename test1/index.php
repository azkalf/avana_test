<!DOCTYPE html>
<html>
<head>
	<title>Avana Test 1 - Azkal Fikri</title>
</head>
<style type="text/css">
	#container {
		width: 400px;
		margin: 0 auto;
		margin-top: 100px;
	}
	#container table, input {
		width: 100%;
		padding: 5px;
	}
	button {
		float: right;
	}
</style>
<body>
	<?php
	// $var1 = "a (b c (d e (f) g) h) i (j k)";
	// $var2 = 2;
	function test1($var1, $var2) {
		$check1 = strpos($var1, "(");
		if ($check1 != $var2) {
			return "not valid variable 2";
		} else {
			$check2 = strpos($var1, ')', (strpos($var1, ')', strpos($var1, ')') + 1)) + 1);
			if ($check2) {
				return $check2;
			} else {
				return "third character of ')' not found in Variable 1";
			}
		}
	}
	$var1 = isset($_POST['var1']) && !empty($_POST['var1']) ? $_POST['var1'] : '';
	$var2 = isset($_POST['var2']) && !empty($_POST['var2']) ? $_POST['var2'] : '';
	$result = 'not valid variables';
	if (!empty($var1) && !empty($var2)) {
		$result = test1($var1, $var2);
	}
	?>
	<div id="container">
		<form method="POST">
			<table>
				<tr>
					<td width="70">Variable 1</td>
					<td>:</td>
					<td><input type="text" name="var1" value="<?= $var1; ?>"></td>
				</tr>
				<tr>
					<td>Variable 2</td>
					<td>:</td>
					<td><input type="number" name="var2" value="<?= $var2; ?>"></td>
				</tr>
				<tr>
					<td>Result</td>
					<td>:</td>
					<td><?= $result; ?></td>
				</tr>
			</table>
			<button type="submit">Submit</button>
		</form>
	</div>
</body>
</html>