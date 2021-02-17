<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> Rapoport Code Homework 2 </title>
<style> body {font-family: Helvetica;}</style>
</head>
<body>
<?php
/* Validating ISBN code
Ten digit Code
need to return substring/each digit seperately - place isbn in varible
$isbn = "0747532699"
Now create code that does arthemtic
$isbncheck =((10*substr($isbn,0,1))+(9*substr($isbn,1,1))+(8*substr($isbn,2,1))+(7*substr($isbn,3,1))+(6*substr($isbn,4,1))+
(5*substr($isbn,5,1))+(4*substr($isbn,6,1))+(3*substr($isbn,7,1))+(2*substr($isbn,8,1))+(substr($isbn,9,1)))/11
Check to see if the $isbncheck is an integer using gettype
Use conditional if $checktype == integer => ISBN is valid
else ISBN is NOT valid
Create conditional for case where isbn ends in "x" or "X"

*/



function isbnvalidator($isbn)
{
    if (strlen($isbn) != 10) //checking to make sure the isbn string has 10 digits
    {
        echo "Checking isbn: ". $isbn. " for validity...";
        echo "<br>";
        echo "This is NOT a valid ISBN!";
    }
    elseif (substr($isbn,9,1)=="x" || substr($isbn,9,1)=="X" ) // check to see if isbn ends in x or X and replace it with 10 in calculation
    {
        $isbncheck =((10*substr($isbn,0,1))+(9*substr($isbn,1,1))+(8*substr($isbn,2,1))+(7*substr($isbn,3,1))+(6*substr($isbn,4,1))+(5*substr($isbn,5,1))+(4*substr($isbn,6,1))+(3*substr($isbn,7,1))+(2*substr($isbn,8,1))+(10))/11;  
        $checktype = gettype($isbncheck); //Check to see if isbncheck is divisible by 11
        
        echo "Checking isbn: ". $isbn. " for validity...";
        echo "<br>";
        if ($checktype == "integer")
            {
            echo "This is a valid ISBN!";
            echo "<br>";
            echo "<a href=\"http://www.isbnsearch.org/isbn/$isbn\">Here</a> is a the link to the title.";
            }
        else
        {
        echo "This is NOT a valid ISBN!";
        } 
    }
    else
    {
        $isbncheck =((10*substr($isbn,0,1))+(9*substr($isbn,1,1))+(8*substr($isbn,2,1))+(7*substr($isbn,3,1))+(6*substr($isbn,4,1))+
        (5*substr($isbn,5,1))+(4*substr($isbn,6,1))+(3*substr($isbn,7,1))+(2*substr($isbn,8,1))+(substr($isbn,9,1)))/11;
        $checktype = gettype($isbncheck); //Check to see if isbncheck is divisible by 11
        
        echo "Checking isbn: ". $isbn. " for validity...";
        echo "<br>";
        if ($checktype == "integer")
            {
            echo "This is a valid ISBN!";
            echo "<br>";
            echo "<a href=\"http://www.isbnsearch.org/isbn/$isbn\">Here</a> is a the link to the title.";
            }
        else
        {
        echo "This is NOT a valid ISBN!";
        }
    } 
}
$isbn = "156881111X";
echo "<h2>Challenge: ISBN Validation</h2>";
echo isbnvalidator($isbn);




/*
Coinflipping - using mt_rand which returns a random number - pass through min and max arguments 
here 0 or 1 so mt_rand(0,1) 
0 will be heads
1 will be tails
*/

function headimage() {
    echo "<img src=\"https://upload.wikimedia.org/wikipedia/commons/2/2e/US_One_Cent_Obv.png\" alt=\"Head of Penny - United States Mint, Public domain, via Wikimedia Commons\" 
    style=\"width:75px;height:75px;\"";
    echo "<br>"; //adding this break in this function allows the images to line up next to another instead of on top of one another
}

function tailimage()
{
    echo "<img src=\"https://upload.wikimedia.org/wikipedia/commons/d/da/US_One_Cent_Rev.png\" alt=\"Tail of Penny - United States Mint, Public domain, via Wikimedia Commons\" 
    style=\"width:75px;height:75px;\"";
   echo "<br>";
}

function flipcoin()
{
    $result=mt_rand(0,1);
    if ($result==1)
    {
        echo headimage();
    }
    else
    {
        echo tailimage();
    }
}

echo "<h2> Challenge: Coin Flip A </h2>";
for ($flip=1; $flip < 10; ++$flip) //$flip=number of flips
{ 
    if ($flip%2==0) // skipping even number of flips 
    {
        continue;
    }
    if ($flip==1) // forgot that you need == not just = when making conditional
    {  
        echo "flipping a coin once: <br>";
        echo flipcoin(); //created a function because code is repeated in this if statment and else statement
    } 
    else
    {
        echo "flipping a coin $flip times: <br>";
        //Another for loop to run the function the number of times as $flip 
        for ($flipcount=1; $flipcount<=$flip; ++$flipcount) //$flipcount to seperate it from $flip - run the mt_rand the varible($flip) amount of times
        { 
            echo flipcoin();
        } 
    }
    echo "<br>";
}



/*
Flip coin until 2 heads so until mt_rand returns two 00
Use flipcoin()
How to check the result?
do coin flip while 
*/

echo "<h2> Challenge: Coin Flip B </h2>"; 
function flipcoin1()
{
    function result(){
        return mt_rand(0,1);
    }
    $result = null; //declaring the varibles
    $lastresult = null;
    static $x=0; // static varible scope allows it to increment instead of being redeclared as 0 every loop
    do { // starting the do..while loop iteratiing through flipping the coin
        if ($result !==NULL) //conditional for storing the previous loop return, so when loop has completed $result is not NULL
        {
            $lastresult = $result;// setting $lastresult to equal the output of the previous itertion
        }

        $result = result(); //
    
        if ($result==1)
        {
            echo headimage();
        }
        else
        {   
            echo tailimage();
        }
        ++$x; // acts as a counter for itering through the loop
    } while ($result + $lastresult != 2);
    echo "<br>Getting two heads in a row required flipping the coin <b>$x times</b>";
}
echo flipcoin1();


?>
</body>
</html>