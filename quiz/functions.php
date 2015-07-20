<?php

function shuffle_assoc(&$array) {
   
        $keys = array_keys($array);//creates key array containing indices
        shuffle($keys);
        $shuffled = array();
        foreach ($keys as $key) {
            $shuffled[$key] = $array[$key];
        }
		return $shuffled;
}

function showAnswers($answers,$questions) { 
    for($x = 0; $x< count($answers); $x++) {
        if ($x % 2 == 0) { 
            $output = "<div class=\"qanda clear\">\n";
        } else { 
            $output = "<div class=\"qanda\">";
        }
        $output .= '<h4>Question' . ($x+1) . ': ' . $questions[$x] . '</h4>'; 
        $output .= "<ol>\n";
        for ($y = 0;$y< count($answers[$x]); $y++) {
            if (($answers[$x][$y] === $answers[$x][0]) && (in_array($answers[$x][$y],$_SESSION['correct']))) {
 		$output .= "<li class=\"correctuser\">{$answers[$x][$y]} (Correct!)</li>\n";
            } else if ($answers[$x][$y] === $answers[$x][0]) {
 		$output .= "<li class=\"correct\">{$answers[$x][$y]}</li>\n";
            } else if (in_array($answers[$x][$y],$_SESSION['wrong'])) {
 		$output .= "<li class=\"wrong\">{$answers[$x][$y]} (Woops!)</li>\n";
            } else { 
 	    $output .= "<li>{$answers[$x][$y]}</li>\n";
	    }
        }
	$output .= "</ol></div>\n";
	echo $output;
     }
 }

?>