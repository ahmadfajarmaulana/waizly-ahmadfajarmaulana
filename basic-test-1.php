<?php

function maxValue($array) { 
    $n = count($array);  
    $max = $array[0]; 
    for ($i = 1; $i < $n; $i++) {
        if ($max < $array[$i]) {
            $max = $array[$i]; 
        }
    }
    return $max;        
} 

function minValue($array) { 
    $n = count($array);  
    $min = $array[0]; 
    for ($i = 1; $i < $n; $i++) {
        if ($min > $array[$i]) {
            $min = $array[$i]; 
        }
    } 
    return $min;
} 

function minMaxSum($arr) {
    $min = minValue($arr);
    $max = maxValue($arr);

    $totalSum = array_sum($arr);
    $minSum = $totalSum - $max;
    $maxSum = $totalSum - $min;
    return $minSum . " ". $maxSum;
}

$arr = [1,2,3,4,5];
echo minMaxSum($arr);