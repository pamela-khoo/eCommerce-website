<?php
// PHP Code to multiply two numbers
// using Russian Peasant method

// function returns the result
function russianPeasant($a, $b)
{
    
    // initialize result
    $res = 0;
    
    // While second number
    // doesn't become 1
    while ($b > 0)
    {
        
        // If second number becomes odd,
        // add the first number to result
        if ($b & 1)
            $res = $res + $a;
            
            // Double the first number and
            // halve the second number
            $a = $a << 1;
            $b = $b >> 1;
    }
    return $res;
}

// Driver Code
echo russianPeasant(931, 88), "\n";
echo russianPeasant(20, 12), "\n";

// This code is contributed by Ajit
?>