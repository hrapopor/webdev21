<!DOCTYPE html>
<html>
<body>
<?php

echo "<h3> Challenge 1: Correct Change </h3>";
/*
Input is amount paid-total amount due - given in dollar and cents (floating point)
Easiest to put it in int (can divide by 100, 25, 10, 5, 1) -> multiply by 100
First divide by 100 to find dollar
if remainder is 0 - break out 
Then divide by 25 for quarters
if remainder is 0 - break out
Then divide by 10 for dimes
if remainder is 0 - break out
Then divide by 5 for nickels
if remainder is 0 - break out
then divide by 1 for cents 


*/
$paid = 25.31;
$total = 19.20;
$change = ($paid*100)-($total*100); //Have to whole each number before subtraction, otherwise PHP gets cranky when doing % later on.


echo "Your total was \$$total. <br>";
echo "You paid \$$paid. <br>";
echo "You are owed $change cents or<br>";


if ($change > 100)
{
    $dollar = $change/100;
    echo (int) $dollar." dollar(s)";
    $change = $change%100.0; 
} /* Checks for dollars
Prints number of dollars
 finds the remainder and changes the value of $change accordingly.
*/
if ($change/25>=1)
{
    $quarters = $change/25;
    echo ", ". (int) $quarters." quarter(s)";
    $change = $change%25; 
} // Checks for quarters and finds the remainder and changes the value of $change accordingly.

if ($change/10>=1)
{
    $dimes = $change/10;
    echo ", ". (int) $dimes." dimes(s)";
    $change = $change%10; 
}

if ($change/5>=1)
{
    $nickels = $change/5;
    echo ", ".(int) $nickels." nickel(s)";
    $change = $change%5;
} // Checks for nickels and finds the remainder and changes the value of $change accordingly.

if ($change/1>=1)
{
    echo ", and $change cent(s).";
} // Checks for any cents remaining and prints out the total

echo "<br>";

echo "<h1> Challenge 2: 99 Bottles of Beer </h1>";
$count = 40; //$count can be changed to any integer to change the starting number of bottles
for ($count = $count ; $count > 0 ; --$count)  
{    
    echo "$count bottles of beer on the wall, $count bottles of beer.
    <br> Take one down, pass it around, " . ($count-1) . " bottles of beer on the wall.
    <br>";
}
?>
</body>
</html>