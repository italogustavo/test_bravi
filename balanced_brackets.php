<?php  

function balanced_brackets($string, $brackets_arr = false) {

    $string = trim($string);
	$brackets_arr = $brackets_arr ? $brackets_arr : [ '[' => ']', '{' => '}', '(' => ')' ];
	$brackets_arr_flipped = array_flip($brackets_arr);
	$length = strlen($string);
	$brackets_pilha = [];

	for ($i = 0; $i < $length; $i++) {
		
		$current_char = $string[$i];

		if (isset($brackets_arr[$current_char])) {

			$brackets_pilha[] = $brackets_arr[$current_char];

		} else if (isset($brackets_arr_flipped[$current_char])) {

			$expected = array_pop($brackets_pilha);
			
			if (($expected === NULL) || ($current_char != $expected)) {
				return "FALSE";
			}
		}
	}

	return (empty($brackets_pilha) ? "TRUE" : "FALSE");
}

echo "Exemple 1: ".balanced_brackets("(){}[]")."<hr>";
echo "Exemple 2: ".balanced_brackets("[{()}](){}")."<hr>";
echo "Exemple 3: ".balanced_brackets("[]{()")."<hr>";
echo "Exemple 4: ".balanced_brackets("[{)]")."<hr>";

?>